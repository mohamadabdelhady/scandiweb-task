<?php

class book extends product
{
    private $weight = 0.0;

    public function __construct($request)
    {
        $this->setSKU($request['sku-input']);
        $this->setName($request['name-input']);
        $this->setPrice($request['price-input']);
        $this->weight = $request['weight-input'];
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function save()
    {
        try {
            $pdo = $this->get_connection();
            $sku = $this->getSKU();
            $price = $this->getPrice();
            $name = $this->getName();
            $stmt = $pdo->prepare("INSERT INTO products (SKU_id, name, price, weight) VALUES (:sku, :name, :price, :weight)");
            $stmt->execute(['sku' => $sku, 'name' => $name, 'price' => $price, 'weight' => $this->weight]);
            header("Location: /");
            die();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                header("Location: /addProduct.php");
                $_SESSION['duplicateErrorMessage'] = "Duplicate SKU code, SKU codes must be unique.";
            } else {
                header("Location: /");
                die();
            }
        }
    }

}
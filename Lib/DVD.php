<?php

class DVD extends product
{
    private $size;

    /**
     * @param any $size
     */
    public function __construct($request)
    {
        $this->setSKU($request['sku-input']);
        $this->setName($request['name-input']);
        $this->setPrice($request['price-input']);
        $this->size = $request['size-input'];
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    public function save()
    {
        try {
            $pdo = $this->get_connection();
            $sku = $this->getSKU();
            $price = $this->getPrice();
            $name = $this->getName();
            $stmt = $pdo->prepare("INSERT INTO products (SKU_id, name, price, size) VALUES (:sku, :name, :price, :size)");
            $stmt->execute(['sku' => $sku, 'name' => $name, 'price' => $price, 'size' => $this->size]);
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

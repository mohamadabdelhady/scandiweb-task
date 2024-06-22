<?php

class furniture extends product
{
    private $height;
    private $width;
    private $length;


    public function __construct($request)
    {
        $this->setSKU($request['sku-input']);
        $this->setName($request['name-input']);
        $this->setPrice($request['price-input']);
        $this->height = $request['height-input'];
        $this->width = $request['width-input'];
        $this->length = $request['length-input'];
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    public function save()
    {
        try {
            $pdo = $this->get_connection();
            $Sku = $this->getSKU();
            $Price = $this->getPrice();
            $Name = $this->getName();
            $stmt = $pdo->prepare("INSERT INTO products (SKU_id, name, price, height, width, length) VALUES (:sku, :name, :price, :height, :width, :length)");
            $stmt->execute(['sku' => $Sku, 'name' => $Name, 'price' => $Price, 'height' => $this->height, 'width' => $this->width, 'length' => $this->length]);
            header("Location: /");
            die();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                header("Location: /addProduct.php");
                $_SESSION['duplicateErrorMessage'] = "duplicate SKU code, SKU code have to be unique.";
            } else {
                header("Location: /");
                die();
            }
        }
    }


}
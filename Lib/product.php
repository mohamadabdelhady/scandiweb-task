<?php

class product
{
    private $SKU = "";
    private $name = "";
    private $price = 0.0;

    public function __construct()
    {
    }


    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->SKU;
    }

    /**
     * @param mixed $SKU
     */
    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @throws Exception
     */
    protected function get_connection()
    {
        $config = require 'config.php';

        $pdo = new PDO(
            $config['database_dsn'],
            $config['database_user'],
            $config['database_pass']
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    }

    public function getAllProducts()
    {
        $pdo = $this->get_connection();
        $query = 'SELECT * FROM products ORDER BY SKU_id';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function deleteProducts($products)
    {
        $pdo = $this->get_connection();
        $response = true;
        foreach ($products as $product) {
            $stmt = $pdo->prepare("DELETE FROM products WHERE SKU_id = :sku");
            $stmt->bindValue(':sku', $product, PDO::PARAM_STR);
            $result = $stmt->execute();
            if (!$result) {
                $response = false;
                break;
            }
        }
        echo $response ? 'All products deleted successfully' : 'Failed to delete some products';
    }

    public function checkDuplicates($sku)
    {
        $pdo = $this->get_connection();
        $stmt = $pdo->prepare("SELECT COUNT(SKU_id) FROM products WHERE SKU_id=:sku");
        $stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
        $stmt->execute();
        $response = $stmt->fetchColumn();
        echo $response;

    }
}
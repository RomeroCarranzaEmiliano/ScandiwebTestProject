<?php
namespace api\components\product;
use api\core\Response;

require_once "api\core\Response.php";
class ProductQueries
{

    public function selectAll(): string
    {
        return 'SELECT * FROM product;';

    }

    public function insert($type)
    {
        if ($type == "DVD") {
            return $this->insertDVD();
        } else if ($type == "Furniture") {
            return $this->insertFurniture();
        } else if ($type == "Book") {
            return $this->insertBook();
        } else {
            $response = new Response();
            $response->setStatusCode(500);
            return $response;
        }
    }

    private function insertDVD(): string
    {
        return "INSERT INTO product (sku, name, price, type, size) 
                VALUES (:sku, :name, :price, 'DVD', :size)";
    }
    private function insertFurniture(): string
    {
        return "INSERT INTO product (sku, name, price, type, height, width, length) 
                VALUES (:sku, :name, :price, 'Furniture', :height, :width, :length)";
    }
    private function insertBook(): string
    {
        return "INSERT INTO product (sku, name, price, type, weight) 
                VALUES (:sku, :name, :price, 'Book', :weight)";
    }

    public function delete(): string
    {
        return "DELETE FROM product WHERE id IN (:productList)";
    }

}
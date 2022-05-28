<?php
namespace components\product;
use core\Response;

require_once __DIR__."/../../core/Response.php";
class ProductQueries
{
    private readonly array $dict;

    public function __construct() {
        $aux = array(
            "DVD" => $this->insertDVD(),
            "Book" => $this->insertBook(),
            "Furniture" => $this->insertFurniture()
        );
        $this->dict = $aux;
    }

    public function selectAll(): string
    {
        return 'SELECT * FROM product;';

    }

    public function exists(): string
    {
        return 'SELECT EXISTS(SELECT * FROM product WHERE sku = (:sku));';
    }

    public function insert($type)
    {
        if (array_key_exists($type, $this->dict)) {
            return $this->dict[$type];
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
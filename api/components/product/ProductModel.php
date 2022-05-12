<?php
use components\product\Product;
use components\product\DVD;
use components\product\Furniture;
use components\product\Book;
use components\product\ProductQueries;
use components\product\ProductFactory;
use core\Database;
use core\Validator;
use core\Response;

require_once "core\Database.php";
require_once "components\product\ProductQueries.php";
require_once "components\product\ProductFactory.php";
require_once "components\product\DVD.php";
require_once "components\product\Furniture.php";
require_once "components\product\Book.php";
require_once "core\Validator.php";
require_once "core\Response.php";


class ProductModel
{
    private Database $db;
    private ProductQueries $queries;
    private Validator $validator;
    private ProductFactory $factory;

    public function __construct()
    {
        $this->db = new Database();
        $this->queries = new ProductQueries();
        $this->validator = new Validator();

        $this->factory = new ProductFactory(array(
            "DVD" => function($params) { return new DVD($params); },
            "Furniture" => function($params) { return new Furniture($params); },
            "Book" => function($params) { return new Book($params); }
        ));


    }

    public function selectAll()
    {
        $products = $this->db->execute($this->queries->selectAll())->fetchAll();

        $result = array();

        // Call factory object's method create with dict as params
        foreach ($products as $p) {
            $result[] = $this->factory->newProduct($p)->asDict();
        }

        return json_encode($result);

    }

    public function addProduct($dict): Response|string
    {

        $product = $this->validate($dict);
        $response = new Response();
        if ($product == false) {
            $response->setStatusCode(400);
            return false;
        }

        $params = $product->getParams();
        $product = $product->asDict();

        $query = $this->queries->insert($product["type"]);
        try {
            $this->db->prepareAndExecute($query, $params);
        } catch (\Throwable $t) {
            return $t->getMessage();
        }

        $response->setStatusCode(200);
        return true;

    }

    public function delete($idList)
    {

        $query = $this->queries->delete();
        $inQuery = "";
        $params = array();
        foreach ($idList as $index => $value) {
            $inQuery = $inQuery.":product".$index.", ";
            $params[":product".$index] = $value;
        }

        $inQuery = substr($inQuery, 0, -2);
        $query = str_replace(":productList", $inQuery, $query);

        try {
            $this->db->prepareAndExecute($query, $params);
        } catch (\Throwable $t) {
            return $t->getMessage();
        }

    }

    private function validate($params): bool|Product
    {
        /*
         * Returns false if the data doesn't pass the validations, or the correct object according to the
         * data received.
         */

        $product = $this->factory->newProduct($params);
        if ($product == false) {
            return false;
        }

        $valid = $this->validator->validate($params, $product->getRules());

        if ($valid == false) {
            return false;
        }

        return $product;
    }


}
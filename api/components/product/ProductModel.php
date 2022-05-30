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

require_once __DIR__."/../../core/Database.php";
require_once __DIR__."/ProductQueries.php";
require_once __DIR__."/ProductFactory.php";
require_once __DIR__."/DVD.php";
require_once __DIR__."/Furniture.php";
require_once __DIR__."/Book.php";
require_once __DIR__."/../../core/Validator.php";
require_once __DIR__."/../../core/Response.php";


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
            "DVD" => DVD::class,
            "Furniture" => Furniture::class,
            "Book" => Book::class
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

    public function addProduct($dict): bool|string
    {
        $product = $this->validate($dict);

        $response = new Response();
        if (is_bool($product)) {
            $response->setStatusCode(400);
            return json_encode(array("skuErr" => true));
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
        $rules = $this->factory->getRules($params);
        $valid = $this->validator->validate($params, $rules);

        if ($valid == false) {
            return false;
        }

        $query = $this->queries->exists();
        try {
            $result = $this->db->prepareAndExecute($query, array(":sku" => $params["sku"]));
        } catch (\Throwable $t) {
            return $t->getMessage();
        }

        if ($result->fetch(PDO::FETCH_NUM)[0] == 1) {
            return false;
        }

        return $this->factory->newProduct($params);
    }


}
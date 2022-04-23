<?php
use api\componets\product\Product;
use api\componets\product\DVD;
use api\componets\product\Furniture;
use api\componets\product\Book;
use api\components\product\ProductQueries;
use api\core\Database;
use api\core\Validator;
use api\core\Response;

require_once "api\core\Database.php";
require_once "api\components\product\ProductQueries.php";
require_once  "api\components\product\DVD.php";
require_once  "api\components\product\Furniture.php";
require_once  "api\components\product\Book.php";
require_once "api\core\Validator.php";
require_once "api\core\Response.php";


class ProductModel
{
    private Database $db;
    private ProductQueries $queries;
    private Validator $validator;
    private array $attributes;

    public function __construct()
    {
        $this->db = new Database();
        $this->queries = new ProductQueries();
        $this->validator = new Validator();

        $this->attributes = array(
            "sku" => ["required", "stringNonEmpty", "noSpacesString"],
            "name" => ["required", "stringNonEmpty"],
            "price" => ["required", "price"],

            "size" => ["integer"],

            "height" => ["measurement"],
            "width" => ["measurement"],
            "length" => ["measurement"],

            "weight" => ["measurement"]
        );
    }

    public function selectAll()
    {
        $products = $this->db->execute($this->queries->selectAll())->fetchAll();

        $result = array();

        foreach ($products as $p) {
            if ($p["type"] == "DVD") {
                // Is a DVD product
                $aux = new DVD($p["id"], $p["sku"], $p["name"], $p["price"], $p["size"]);
            } elseif ($p["type"] == "Furniture") {
                $aux = new Furniture($p["id"], $p["sku"], $p["name"], $p["price"],
                    $p["height"], $p["width"], $p["length"]);
            } elseif ($p["type"] == "Book") {
                $aux = new Book($p["id"], $p["sku"], $p["name"], $p["price"], $p["weight"]);
            }

            $result[] = $aux->asDict();
        }

        return json_encode($result);

    }

    public function addProduct($dict)
    {

        $product = $this->validate($dict);
        $response = new Response();
        if ($product == false) {
            $response->setStatusCode(400);
            return $response;
        }

        $params = $product->getParams();
        $product = $product->asDict();

        $query = $this->queries->insert($product["type"]);
        try {
            $result = $this->db->prepareAndExecute($query, $params);
        } catch (\Throwable $t) {
            return $t->getMessage();
        }

        $response->setStatusCode(200);
        return "OK";

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

    private function validate($dict)
    {
        /*
         * Returns false if the data doesn't pass the validations, or the correct object according to the
         * data received.
         */

        if ($dict["type"] == "DVD") {
            $this->attributes["size"][] = "required";
        } else if ($dict["type"] == "Furniture") {
            $this->attributes["height"][] = "required";
            $this->attributes["width"][] = "required";
            $this->attributes["length"][] = "required";
        } else if ($dict["type"] == "Book") {
            $this->attributes["weight"][] = "required";
        }

        $valid = $this->validator->validate($dict, $this->attributes);

        if ($valid == false) {
            return false;
        }

        // Select the right type of object
        $product = null;
        if ($dict["type"] == "DVD") {
            $product = new DVD(null, $dict["sku"], $dict["name"],$dict["price"], $dict["size"]);
        } else if ($dict["type"] == "Furniture") {
            $product = new Furniture(null, $dict["sku"], $dict["name"], $dict["price"],
                $dict["height"], $dict["width"], $dict["length"]);
        } else if ($dict["type"] == "Book") {
            $product = new Book(null, $dict["sku"], $dict["name"], $dict["price"], $dict["weight"]);
        }

        return $product;
    }


}
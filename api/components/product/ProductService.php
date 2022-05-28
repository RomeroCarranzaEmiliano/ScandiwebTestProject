<?php
namespace components\product;

use ProductModel;

require_once __DIR__."/ProductModel.php";
class ProductService
{
    private ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // GET
    public function listAll()
    {
        $products = $this->productModel->selectAll();
        return json_encode($products);
    }

    // PUT
    public function add($body)
    {
        $body = json_decode($body, true);

        if ($body == null) {
            http_response_code(500);
            return false;
        }

        foreach ($body as $key => $value) {
            if ($value === "") {
                unset($body[$key]);
            }
        }

        return $this->productModel->addProduct($body);

    }


    // DElETE
    public function massDelete($body) {

        $body = json_decode($body, true);
        $body = $body["productList"];
        $productList = [];
        foreach ($body as $key => $value) {
            if ($value == true) {
                $productList[] = $key;
            }
        }

        return $this->productModel->delete($productList);

    }

}
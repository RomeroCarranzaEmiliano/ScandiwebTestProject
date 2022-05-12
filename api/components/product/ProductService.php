<?php
namespace components\product;

use ProductModel;

require_once "components\product\ProductModel.php";
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
        // Remove non-used attributes
        $body = json_decode($body, true);

        if ($body == null) {
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
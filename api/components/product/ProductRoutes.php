<?php
namespace components\product;

require_once __DIR__."/ProductService.php";

class ProductRoutes
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    public function routes(): array
    {
        return array(
            "get" => array(
                "/product-list" => function () {
                    return $this->service->listAll();
                }
            ),
            "post" => array(
                "/add-product" => function() {
                    $body = file_get_contents("php://input");
                    return $this->service->add($body);
                }
            ),
            "delete" => array(
                "/mass-delete" => function() {
                    $body = file_get_contents("php://input");
                    return $this->service->massDelete($body);
                }
            )
        );
    }
}
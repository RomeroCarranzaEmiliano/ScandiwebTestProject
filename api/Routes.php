<?php
namespace api;

use api\components\product\ProductRoutes;

require_once "api\components\product\ProductRoutes.php";

class Routes
{

    public array $dict;

    private array $components;
    private ProductRoutes $product;

    public function __construct()
    {
        $this->product = new ProductRoutes();

        $this->components = array(
            "/product" => $this->product->routes(),
        );

    }

    public function getCallbackFor($path, $method)
    {
        preg_match("/^\/\w+\//", $path, $component);
        $relative_path = "/".str_replace($component, "", $path);
        $component = substr($component[0], 0, -1);
        $routes = $this->components[$component];

        return $routes[$method][$relative_path];

    }


}
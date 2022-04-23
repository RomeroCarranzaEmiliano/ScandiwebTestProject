<?php

namespace api\core;

require_once "api\core\Request.php";
require_once "api\core\Router.php";
require_once "api\core\Response.php";

class Application
{
    public static string $ROOT_DIR;
    public Request $request;
    public Response $response;
    public Router $router;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
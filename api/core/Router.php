<?php

namespace core;

use Routes;
require_once __DIR__."/../Routes.php";

class Router
{
    public Request $request;
    public Response $response;
    public Routes $routes;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->routes = new Routes();

    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes->getCallbackFor($path, $method) ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return "404 not found";
        }

        return call_user_func($callback);
    }

}
<?php

require __DIR__."/../Routes.php";

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

    public function get($path, $callback)
    {
        $this->routes->dict["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes->dict["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes->dict[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderContent("Not found");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include __DIR__."/../views/layouts/main.php";
        # include Application::$ROOT_DIR."/views/$view.php"
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include __DIR__."/../views/$view.php";
        return ob_get_clean();
    }
}
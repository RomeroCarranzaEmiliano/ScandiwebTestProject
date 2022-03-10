<?php
/*
require_once __DIR__."/core/Router.php";
require_once __DIR__."/core/Application.php";

$app = new Application();

$app->router->get("/", function(){
    return "Hello, World";
});


$app->run();
*/

require __DIR__."/core/Application.php";

$app = new Application(dirname(__DIR__));
$app->run();
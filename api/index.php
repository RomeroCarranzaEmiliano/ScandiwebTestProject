<?php

use core\Application;
require_once __DIR__."/core/Application.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
*/

$app = new Application(dirname(__DIR__));
$app->run();
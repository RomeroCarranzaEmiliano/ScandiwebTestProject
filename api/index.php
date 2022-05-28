<?php

use core\Application;
require_once __DIR__."/core/Application.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

$app = new Application(dirname(__DIR__));
$app->run();
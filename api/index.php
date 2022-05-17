<?php

use core\Application;
require_once __DIR__."/core/Application.php";

$app = new Application(dirname(__DIR__));
$app->run();
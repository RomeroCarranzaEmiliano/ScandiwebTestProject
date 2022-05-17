<?php

use core\Application;
require_once "core/Application.php";

$app = new Application(dirname(__DIR__));
$app->run();
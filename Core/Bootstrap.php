<?php

namespace App;

use Core\Route;

$route = new Route;
require_once __DIR__ . "/../App/Routes.php";

$route->action();

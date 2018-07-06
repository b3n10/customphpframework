<?php

// include composer's autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

use \Core\Router;

$url = $_SERVER['QUERY_STRING'];

Router::add('{controller}');
Router::add('{controller}/{action}');
Router::add('{controller}/{id:\d+}/{action}');


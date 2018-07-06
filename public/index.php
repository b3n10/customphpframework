<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use \Core\Router;

$url = $_SERVER['QUERY_STRING'];

Router::add($url);

<?php

namespace Core;

class Router {

	public static function add($route, $params = []) {
		$route = preg_replace("/\/$/", "", $route);
		echo $route;
	}

	public static function match($url) {
		echo $url;
	}

}

<?php

namespace Core;

class Router {

	// save all routes in an array
	private static $routes = [];

	// save all params when searching for a match (self::$match($url))
	private static $params = [];

	// add routes
	public static function add($route, $params = []) {

		// replace all / with \/
		$route = preg_replace('/\//', '\/', $route);

		// replace {word} with regex (?P<word>[a-z-]+)
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		// replace {id:\d+} with regex (?P<id>\d+)
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		// include start and end regex search
		$route = '/^' . $route . '$/i';

		self::$routes[$route] = $params;
	}

	public static function match($url) {

		// remove very last / if any from $url
		$url = preg_replace('/\/$/', '', $url);

		// look in $routes array and see if $url matches regex of $route
		foreach (self::$routes as $route => $param) {

			if (preg_match($route, $url, $matches)) {

				// if match found, save array to $params
				// e.g.
				// [controller]	=> url0
				// [action]			=> url1

				foreach ($matches as $key => $value) {
					if (is_string($key)) $param[$key] = $value;
				}

				self::$params = $param;
				return true;
			}
		}

		return false;
	}

	public static function getRoutes() {
		return self::$routes;
	}

	public static function getParams() {
		return self::$params;
	}

}

<?php

namespace Core;

use \App\Flash;

class View {

	public static function render($file, $args = []) {
		$file = '../App/Views/' . $file;

		if (is_readable($file)) {
			extract($args, EXTR_SKIP);
			$notification = [];
			foreach(Flash::getMessage() as $key => $value) { $notification[$key] = htmlspecialchars($value); }
			require_once $file;
		} else {
			throw new \Exception("File $file not found!");
		}
	}

}

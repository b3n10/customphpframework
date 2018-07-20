<?php

namespace Core;

use \App\Flash;

class View {

	public static function render($file, $args = []) {
		$file = '../App/Views/' . $file;

		if (is_readable($file)) {
			extract($args, EXTR_SKIP);
			$notification	= htmlspecialchars(Flash::getMessage());
			require_once $file;
		} else {
			throw new \Exception("File $file not found!");
		}
	}

}

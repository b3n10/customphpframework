<?php

namespace Core;

class View {

	public static function render($file, $args = []) {
		$file = '../App/Views/' . $file;

		if (is_readable($file)) {
			extract($args, EXTR_SKIP);
			require_once $file;
		} else {
			echo "File $file not found!";
		}
	}

}

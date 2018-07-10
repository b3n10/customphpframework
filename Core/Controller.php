<?php

namespace Core;

abstract class Controller {

	public function __call($name, $args) {
		$method = $name . 'Action';

		if (method_exists($this, $method)) {
			if ($this->before()) {
				call_user_func_array([$this, $method], $args);
				$this->after();
			}
		} else {
			echo "Method '$method' doesn't exists in " . get_class($this) . "!";
		}

	}

	protected function before() {}

	protected function after() {}

}

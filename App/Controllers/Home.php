<?php

namespace App\Controllers;

class Home extends \Core\Controller {

	public function indexAction() {
		echo 'this is home';
	}

	public function before() {
		return true;
	}

}

<?php

namespace App\Controllers;

use \Core\View;

class Signup extends \Core\Controller {

	public function newAction() {
		View::render("Signup/new.php", [
			"title"	=>	"Signup"
		]);
	}

	public function before() {
		return true;
	}

}

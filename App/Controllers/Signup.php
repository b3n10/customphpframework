<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Signup extends \Core\Controller {

	public function newAction() {
		View::render("Signup/new.php", [
			"title"	=>	"Signup"
		]);
	}

	public function createAction() {
		if ($_POST) {
			$user = new User($_POST);

			if ($user->save()) {
				View::render("Signup/success.php", [
					"title"	=>	"Signup Success"
				]);
			}
		} else {
			View::render("Errors/404.php", [
				"title"	=>	"404"
			]);
		}
	}

	public function before() {
		return true;
	}

}

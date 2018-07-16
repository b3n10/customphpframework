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
		if (!$_POST) {
			View::render("Errors/404.php", [
				"title"	=>	"404"
			]);
			exit;
		}

		$user = new User($_POST);

		if ($user->save()) {
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/signup/success', true, 303);
			exit;
		} else {
			View::render("Signup/new.php", [
				"title"	=>	"Signup - Error validation",
				"user"	=>	$user
			]);
		}
	}

	public function successAction() {
		View::render("Signup/success.php", [
			"title"	=>	"Signup Success"
		]);
	}

	public function before() {
		return true;
	}

}

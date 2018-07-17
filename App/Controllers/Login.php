<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Login extends \Core\Controller {

	public function indexAction() {
		View::render('Login/new.php', [
			'title'	=>	'Login'
		]);
	}

	public function createAction() {
		if (!$_POST) {
			View::render("Errors/404.php", [
				"title"	=>	"404 Not Found",
			]);
			exit;
		}

		$user = User::authenticate($_POST['email'], $_POST['password']);
		if ($user) {
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/', true, 303);
			session_start();
			$_SESSION['user'] = $user;
		} else {
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login', true, 303);
		}
	}

	protected function before() {
		return true;
	}

}

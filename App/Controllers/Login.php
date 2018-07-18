<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;

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
			Auth::login($user);
			$this->redirect('/');
		} else {
			View::render('Login/new.php', [
				'title'	=>	'Login',
				'email'	=>	$_POST['email'],
				'error'	=>	'Invalid email/password. Please try again.'
			]);
		}
	}

	public function destroyAction() {
		Auth::logout();
		$this->redirect('/');
	}

}

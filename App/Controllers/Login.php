<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

class Login extends \Core\Controller {

	public function indexAction() {
		View::render('Login/new.php', [
			'title' => 'Login'
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
			Flash::addMessage('Login successful!');
			$this->redirect(Auth::returnToPrevPage());
		} else {
			Flash::addMessage('Invalid email/password!');
			View::render('Login/new.php', [
				'title'	=>	'Login',
				'email'	=>	htmlspecialchars($_POST['email'])
			]);
		}
	}

	public function destroyAction() {
		Auth::logout();
		$this->redirect('/login/show-logout-message');
	}

	public function showLogoutMessageAction() {
		Flash::addMessage('Logout successful!');
		$this->redirect('/');
	}

}

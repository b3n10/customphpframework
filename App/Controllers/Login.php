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

			$_SESSION['user_id'] = $user->id;
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
		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		// Finally, destroy the session.
		session_destroy();

		$this->redirect('/');
	}

}

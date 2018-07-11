<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Home extends \Core\Controller {

	public function indexAction() {
		$user = User::first();

		View::render('Home/index.php', [
			'title'			=>	'HomePage',
			'username'	=>	$user['name']
		]);
	}

	public function before() {
		return true;
	}

}

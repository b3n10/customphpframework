<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {

	public function indexAction() {
		View::render('Home/index.php', [
			'title'			=>	'HomePage',
			'username'	=>	'Ben'
		]);
	}

	public function before() {
		return true;
	}

}

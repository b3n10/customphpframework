<?php

namespace App;

class Flash {

	public static function addMessage($msg) {
		$_SESSION['notification'] = $msg;
	}

	public static function getMessage() {
		if (isset($_SESSION['notification'])) {
			$notification = $_SESSION['notification'];
			unset($_SESSION['notification']);
			return $notification;
		}
	}

}

<?php

namespace App\Models;

use PDO;

class User extends \Core\Model {

	public static function getAll() {
		$pdo = self::connectDB();
		$stmt = $pdo->prepare("SELECT name FROM users");

		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public static function first() {
		return self::getAll()[0];
	}

}

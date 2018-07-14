<?php

namespace App\Models;

use PDO;

class User extends \Core\Model {

	public function __construct($data) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function save() {
		$sql = 'INSERT INTO users (name, email, password_hash)
						VALUES (:name, :email, :password_hash)';

		$pdo = self::connectDB();
		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
		$stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
		$password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

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

<?php

namespace App\Models;

use PDO;

class User extends \Core\Model {

	protected $errors = [];

	public function __construct($data) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function save() {
		if (!empty($this->validate())) {
			foreach ($this->errors as $error) {
				echo $error . '<br>';
			}
		} else {
			$sql = 'INSERT INTO users (name, email, password_hash)
				VALUES (:name, :email, :password_hash)';

			$pdo = self::connectDB();
			$stmt = $pdo->prepare($sql);

			$stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
			$stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
			$password_hash = password_hash($this->password, PASSWORD_DEFAULT);
			$stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

			return $stmt->execute();
		}
	}

	public function validate() {
		if ($this->name === '') {
			$this->errors[] = 'Name is required!';
		}

		if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
			$this->errors[] = 'Email is invalid!';
		}

		if ($this->password !== $this->confirm_password) {
			$this->errors[] = 'Password doesn\'t match confirmation!';
		}

		if (strlen($this->password) < 6) {
			$this->errors[] = 'Password must be at least 6 characters!';
		}

		if (preg_match('/.*[a-z]+.*/', $this->password) === 0) {
			$this->errors[] = 'Password must have at least one lowercase character!';
		}

		if (preg_match('/.*[A-Z]+.*/', $this->password) === 0) {
			$this->errors[] = 'Password must have at least one uppercase character!';
		}

		if (preg_match('/.*\d+.*/', $this->password) === 0) {
			$this->errors[] = 'Password must have at least one numeric character!';
		}

		if (preg_match('/.*[!-\/:-@\[-`{-~].*/', $this->password) === 0) {
			$this->errors[] = 'Password must have at least one symbol!';
		}

		return $this->errors;
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

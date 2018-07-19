<?php

namespace App\Models;

use PDO;

class User extends \Core\Model {

	public $errors = [];

	public function __construct($data = []) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function save() {
		if (!empty($this->validate())) {
			return false;
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
		// name
		if (strlen($this->name) < 2) {
			$this->errors[] = 'Name must at least have 2 characters!';
		}
		if ($this->name === '') {
			$this->errors[] = 'Name is required!';
		}

		// email
		if (self::emailExists($this->email)) {
			$this->errors[] = 'Email already exists!';
		}
		if (empty($this->email)) {
			$this->errors[] = 'Email is empty!';
		} else if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
			$this->errors[] = 'Email is invalid!';
		}

		// password
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

	public static function emailExists($email) {
		return self::findByEmail($email) !== false;
	}

	private static function findByEmail($email) {
		$pdo = self::connectDB();
		$stmt = $pdo->prepare("SELECT * from users WHERE email=:email");
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);

		// fetch data as an object of the class (User in this case)
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

		$stmt->execute();

		return $stmt->fetch();
	}

	public static function authenticate($email, $password) {
		$user = self::findByEmail($email);

		if ($user) {
			if (password_verify($password, $user->password_hash)) {
				return $user;
			}
		}

		return false;
	}

	public static function findById($id) {
		$pdo = self::connectDB();
		$stmt = $pdo->prepare('SELECT * from users WHERE id=:id');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);

		// fetch data as an object of the class (User in this case)
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

		$stmt->execute();

		return $stmt->fetch();
	}

}

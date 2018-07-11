<?php

namespace Core;

use \App\Config;

class Model {

	public function connectDB() {
		static $db = null;

		if (!$db) {
			$dsn = "mysql:host=" . Config::DBHOST . ";dbname=" . Config::DBNAME;
			$username = Config::DBUSER;
			$password = Config::DBPASS;

			try {
				$pdo = new \PDO($dsn, $username, $password);

				setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				throw new \Exception($e->getMessage());
			}
		}

		return $db;
	}

}

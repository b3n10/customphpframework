<?php

namespace Core;

use \App\Config;
use PDO;

class Model {

	public static function connectDB() {
		static $db = null;

		if (!$db) {
			$dsn = "mysql:host=" . Config::DBHOST . ";dbname=" . Config::DBNAME;
			$username = Config::DBUSER;
			$password = Config::DBPASSWORD;

			try {
				$db = new PDO($dsn, $username, $password);

				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				throw new \Exception($e->getMessage());
			}
		}

		return $db;
	}

}

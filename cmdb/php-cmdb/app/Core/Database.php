<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

class Database
{
	private static ?PDO $connection = null;

	public static function getConnection(array $config): PDO
	{
		if (self::$connection instanceof PDO) {
			return self::$connection;
		}

		$db = $config['db'];
		$dsn = sprintf(
			'mysql:host=%s;port=%s;dbname=%s;charset=%s',
			$db['host'],
			$db['port'],
			$db['name'],
			$db['charset'] ?? 'utf8mb4'
		);

		self::$connection = new PDO($dsn, $db['user'], $db['pass'], [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]);

		return self::$connection;
	}
}



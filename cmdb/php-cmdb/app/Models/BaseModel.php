<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class BaseModel
{
	protected PDO $db;

	public function __construct(array $config)
	{
		$this->db = Database::getConnection($config);
	}
}



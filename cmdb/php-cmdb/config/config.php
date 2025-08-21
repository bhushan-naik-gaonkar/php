<?php
declare(strict_types=1);

return [
	'db' => [
		'host' => getenv('CMDB_DB_HOST') ?: '127.0.0.1',
		'port' => getenv('CMDB_DB_PORT') ?: '3306',
		'name' => getenv('CMDB_DB_NAME') ?: 'cmdb',
		'user' => getenv('CMDB_DB_USER') ?: 'cmdb_user',
		'pass' => getenv('CMDB_DB_PASS') ?: 'cmdb_pass',
		'charset' => 'utf8mb4',
	],
];



<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
	$prefix = 'App\\';
	$baseDir = __DIR__ . '/../app/';
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		return;
	}
	$relativeClass = substr($class, $len);
	$file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
	if (file_exists($file)) {
		require $file;
	}
});

$config = require __DIR__ . '/../config/config.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');
if ($path === '') {
	$path = '/';
}

use App\Controllers\HomeController;
use App\Controllers\DepartmentController;
use App\Controllers\TeamController;
use App\Controllers\ResourceController;
use App\Controllers\LinkController;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routes = [
	'GET /' => [HomeController::class, 'index'],
	'GET /departments' => [DepartmentController::class, 'index'],
	'POST /departments/create' => [DepartmentController::class, 'create'],
	'GET /departments/delete' => [DepartmentController::class, 'delete'],
	'GET /teams' => [TeamController::class, 'index'],
	'POST /teams/create' => [TeamController::class, 'create'],
	'GET /teams/delete' => [TeamController::class, 'delete'],
	'GET /resources' => [ResourceController::class, 'index'],
	'POST /resources/create' => [ResourceController::class, 'create'],
	'GET /resources/delete' => [ResourceController::class, 'delete'],
	'GET /links' => [LinkController::class, 'index'],
	'POST /links/create' => [LinkController::class, 'create'],
	'GET /links/delete' => [LinkController::class, 'delete'],
];

$routeKey = $method . ' ' . $path;
if (isset($routes[$routeKey])) {
	[$class, $methodName] = $routes[$routeKey];
	$controller = new $class($config);
	echo $controller->$methodName();
} else {
	http_response_code(404);
	echo 'Not Found';
}



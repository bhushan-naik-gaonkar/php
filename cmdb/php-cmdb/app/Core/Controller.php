<?php
declare(strict_types=1);

namespace App\Core;

class Controller
{
	protected array $config;

	public function __construct(array $config)
	{
		$this->config = $config;
	}

	protected function render(string $viewPath, array $params = []): string
	{
		extract($params);
		ob_start();
		require __DIR__ . '/../Views/' . $viewPath . '.php';
		$content = ob_get_clean();

		ob_start();
		require __DIR__ . '/../Views/layout.php';
		return ob_get_clean();
	}
}



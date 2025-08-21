<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ResourceModel;

class ResourceController extends Controller
{
	public function index(): string
	{
		$model = new ResourceModel($this->config);
		$resources = $model->all();
		return $this->render('resources/index', compact('resources'));
	}

	public function create(): string
	{
		$name = trim($_POST['name'] ?? '');
		$type = trim($_POST['type'] ?? '');
		$owner = trim($_POST['owner'] ?? '');
		if ($name !== '' && $type !== '') {
			$model = new ResourceModel($this->config);
			$model->create($name, $type, $owner);
		}
		header('Location: /resources');
		exit;
	}

	public function delete(): string
	{
		$id = (int)($_GET['id'] ?? 0);
		if ($id > 0) {
			$model = new ResourceModel($this->config);
			$model->delete($id);
		}
		header('Location: /resources');
		exit;
	}
}



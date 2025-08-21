<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\DepartmentModel;

class DepartmentController extends Controller
{
	public function index(): string
	{
		$model = new DepartmentModel($this->config);
		$departments = $model->all();
		return $this->render('departments/index', compact('departments'));
	}

	public function create(): string
	{
		$name = trim($_POST['name'] ?? '');
		$description = trim($_POST['description'] ?? '');
		if ($name !== '') {
			$model = new DepartmentModel($this->config);
			$model->create($name, $description);
		}
		header('Location: /departments');
		exit;
	}

	public function delete(): string
	{
		$id = (int)($_GET['id'] ?? 0);
		if ($id > 0) {
			$model = new DepartmentModel($this->config);
			$model->delete($id);
		}
		header('Location: /departments');
		exit;
	}
}



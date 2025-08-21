<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\TeamModel;
use App\Models\DepartmentModel;

class TeamController extends Controller
{
	public function index(): string
	{
		$teamModel = new TeamModel($this->config);
		$teams = $teamModel->all();

		$deptModel = new DepartmentModel($this->config);
		$departments = $deptModel->all();

		return $this->render('teams/index', compact('teams', 'departments'));
	}

	public function create(): string
	{
		$name = trim($_POST['name'] ?? '');
		$description = trim($_POST['description'] ?? '');
		$departmentId = $_POST['department_id'] ?? null;
		$departmentId = $departmentId !== '' ? (int)$departmentId : null;
		if ($name !== '') {
			$model = new TeamModel($this->config);
			$model->create($name, $departmentId, $description);
		}
		header('Location: /teams');
		exit;
	}

	public function delete(): string
	{
		$id = (int)($_GET['id'] ?? 0);
		if ($id > 0) {
			$model = new TeamModel($this->config);
			$model->delete($id);
		}
		header('Location: /teams');
		exit;
	}
}



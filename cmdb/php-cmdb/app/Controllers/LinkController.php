<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LinkModel;
use App\Models\ResourceModel;
use App\Models\DepartmentModel;
use App\Models\TeamModel;

class LinkController extends Controller
{
	public function index(): string
	{
		$linkModel = new LinkModel($this->config);
		$links = $linkModel->allWithDetails();

		$resourceModel = new ResourceModel($this->config);
		$resources = $resourceModel->all();
		$deptModel = new DepartmentModel($this->config);
		$departments = $deptModel->all();
		$teamModel = new TeamModel($this->config);
		$teams = $teamModel->all();

		return $this->render('links/index', compact('links', 'resources', 'departments', 'teams'));
	}

	public function create(): string
	{
		$resourceId = (int)($_POST['resource_id'] ?? 0);
		$linkType = $_POST['link_type'] ?? 'related';
		$targetType = $_POST['target_type'] ?? '';
		$departmentId = null;
		$teamId = null;
		if ($targetType === 'department') {
			$departmentId = (int)($_POST['department_id'] ?? 0) ?: null;
		} elseif ($targetType === 'team') {
			$teamId = (int)($_POST['team_id'] ?? 0) ?: null;
		}
		if ($resourceId > 0 && (($departmentId && !$teamId) || ($teamId && !$departmentId))) {
			$model = new LinkModel($this->config);
			$model->create($resourceId, $departmentId, $teamId, $linkType);
		}
		header('Location: /links');
		exit;
	}

	public function delete(): string
	{
		$id = (int)($_GET['id'] ?? 0);
		if ($id > 0) {
			$model = new LinkModel($this->config);
			$model->delete($id);
		}
		header('Location: /links');
		exit;
	}
}



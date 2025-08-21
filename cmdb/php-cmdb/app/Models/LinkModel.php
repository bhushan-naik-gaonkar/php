<?php
declare(strict_types=1);

namespace App\Models;

class LinkModel extends BaseModel
{
	public function allWithDetails(): array
	{
		$sql = 'SELECT rl.id,
				r.name AS resource_name,
				COALESCE(d.name, t.name) AS linked_name,
				rl.link_type,
				rl.created_at
			FROM resource_links rl
			LEFT JOIN resources r ON r.id = rl.resource_id
			LEFT JOIN departments d ON d.id = rl.department_id
			LEFT JOIN teams t ON t.id = rl.team_id
			ORDER BY rl.created_at DESC';
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll();
	}

	public function create(int $resourceId, ?int $departmentId, ?int $teamId, string $linkType): void
	{
		$sql = 'INSERT INTO resource_links (resource_id, department_id, team_id, link_type)
			VALUES (:resource_id, :department_id, :team_id, :link_type)';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			':resource_id' => $resourceId,
			':department_id' => $departmentId,
			':team_id' => $teamId,
			':link_type' => $linkType,
		]);
	}

	public function delete(int $id): void
	{
		$stmt = $this->db->prepare('DELETE FROM resource_links WHERE id = :id');
		$stmt->execute([':id' => $id]);
	}
}



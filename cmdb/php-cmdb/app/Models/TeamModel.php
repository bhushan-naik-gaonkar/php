<?php
declare(strict_types=1);

namespace App\Models;

class TeamModel extends BaseModel
{
	public function all(): array
	{
		$sql = 'SELECT t.id, t.name, t.description, t.created_at, d.name AS department_name
			FROM teams t LEFT JOIN departments d ON d.id = t.department_id
			ORDER BY t.name';
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll();
	}

	public function create(string $name, ?int $departmentId, ?string $description): void
	{
		$sql = 'INSERT INTO teams (department_id, name, description) VALUES (:department_id, :name, :description)';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			':department_id' => $departmentId,
			':name' => $name,
			':description' => $description,
		]);
	}

	public function delete(int $id): void
	{
		$stmt = $this->db->prepare('DELETE FROM teams WHERE id = :id');
		$stmt->execute([':id' => $id]);
	}
}



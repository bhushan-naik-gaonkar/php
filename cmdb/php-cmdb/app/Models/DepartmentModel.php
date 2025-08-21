<?php
declare(strict_types=1);

namespace App\Models;

class DepartmentModel extends BaseModel
{
	public function all(): array
	{
		$stmt = $this->db->query('SELECT id, name, description, created_at FROM departments ORDER BY name');
		return $stmt->fetchAll();
	}

	public function create(string $name, ?string $description): void
	{
		$sql = 'INSERT INTO departments (name, description) VALUES (:name, :description)';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([':name' => $name, ':description' => $description]);
	}

	public function delete(int $id): void
	{
		$stmt = $this->db->prepare('DELETE FROM departments WHERE id = :id');
		$stmt->execute([':id' => $id]);
	}
}



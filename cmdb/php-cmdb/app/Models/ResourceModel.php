<?php
declare(strict_types=1);

namespace App\Models;

class ResourceModel extends BaseModel
{
	public function all(): array
	{
		$stmt = $this->db->query('SELECT id, name, type, owner, created_at FROM resources ORDER BY name');
		return $stmt->fetchAll();
	}

	public function create(string $name, string $type, ?string $owner): void
	{
		$sql = 'INSERT INTO resources (name, type, owner) VALUES (:name, :type, :owner)';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([':name' => $name, ':type' => $type, ':owner' => $owner]);
	}

	public function delete(int $id): void
	{
		$stmt = $this->db->prepare('DELETE FROM resources WHERE id = :id');
		$stmt->execute([':id' => $id]);
	}
}



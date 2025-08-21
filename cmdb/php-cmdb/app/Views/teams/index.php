<h2>Teams</h2>
<form method="post" action="/teams/create">
	<fieldset role="group">
		<input type="text" name="name" placeholder="Name" required />
		<select name="department_id">
			<option value="">No department</option>
			<?php foreach ($departments as $d): ?>
				<option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
			<?php endforeach; ?>
		</select>
		<input type="text" name="description" placeholder="Description" />
		<button type="submit">Add</button>
	</fieldset>
</form>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Department</th>
			<th>Description</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($teams as $t): ?>
		<tr>
			<td><?= htmlspecialchars($t['name']) ?></td>
			<td><?= htmlspecialchars($t['department_name'] ?? '') ?></td>
			<td><?= htmlspecialchars($t['description']) ?></td>
			<td><?= htmlspecialchars($t['created_at']) ?></td>
			<td><a href="/teams/delete?id=<?= (int)$t['id'] ?>" onclick="return confirm('Delete team?')">Delete</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>



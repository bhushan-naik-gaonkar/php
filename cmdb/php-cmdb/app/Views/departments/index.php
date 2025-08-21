<h2>Departments</h2>
<form method="post" action="/departments/create">
	<fieldset role="group">
		<input type="text" name="name" placeholder="Name" required />
		<input type="text" name="description" placeholder="Description" />
		<button type="submit">Add</button>
	</fieldset>
</form>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($departments as $d): ?>
		<tr>
			<td><?= htmlspecialchars($d['name']) ?></td>
			<td><?= htmlspecialchars($d['description']) ?></td>
			<td><?= htmlspecialchars($d['created_at']) ?></td>
			<td><a href="/departments/delete?id=<?= (int)$d['id'] ?>" onclick="return confirm('Delete department?')">Delete</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>



<h2>Resources</h2>
<form method="post" action="/resources/create">
	<fieldset role="group">
		<input type="text" name="name" placeholder="Name" required />
		<input type="text" name="type" placeholder="Type (server, app, db, etc)" required />
		<input type="text" name="owner" placeholder="Owner" />
		<button type="submit">Add</button>
	</fieldset>
</form>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Owner</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($resources as $r): ?>
		<tr>
			<td><?= htmlspecialchars($r['name']) ?></td>
			<td><?= htmlspecialchars($r['type']) ?></td>
			<td><?= htmlspecialchars($r['owner']) ?></td>
			<td><?= htmlspecialchars($r['created_at']) ?></td>
			<td><a href="/resources/delete?id=<?= (int)$r['id'] ?>" onclick="return confirm('Delete resource?')">Delete</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>



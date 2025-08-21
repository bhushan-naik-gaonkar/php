<h2>Resource Links</h2>
<form method="post" action="/links/create">
	<fieldset role="group">
		<select name="resource_id" required>
			<option value="">Select resource</option>
			<?php foreach ($resources as $r): ?>
				<option value="<?= (int)$r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
			<?php endforeach; ?>
		</select>
		<select name="target_type" required>
			<option value="department">Department</option>
			<option value="team">Team</option>
		</select>
		<select name="department_id">
			<option value="">Select department</option>
			<?php foreach ($departments as $d): ?>
				<option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
			<?php endforeach; ?>
		</select>
		<select name="team_id">
			<option value="">Select team</option>
			<?php foreach ($teams as $t): ?>
				<option value="<?= (int)$t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
			<?php endforeach; ?>
		</select>
		<select name="link_type">
			<option value="ownership">ownership</option>
			<option value="uses">uses</option>
			<option value="supports">supports</option>
			<option value="related" selected>related</option>
		</select>
		<button type="submit">Add Link</button>
	</fieldset>
</form>
<table>
	<thead>
		<tr>
			<th>Resource</th>
			<th>Linked To</th>
			<th>Type</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($links as $l): ?>
		<tr>
			<td><?= htmlspecialchars($l['resource_name']) ?></td>
			<td><?= htmlspecialchars($l['linked_name']) ?></td>
			<td><?= htmlspecialchars($l['link_type']) ?></td>
			<td><?= htmlspecialchars($l['created_at']) ?></td>
			<td><a href="/links/delete?id=<?= (int)$l['id'] ?>" onclick="return confirm('Delete link?')">Delete</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>



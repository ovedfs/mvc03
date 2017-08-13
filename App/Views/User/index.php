<h1>USERS</h1>

<ul>
	<?php foreach($users as $user): ?>
		<li>
			<b><?php echo $user->name . " " . $user->last_name ?></b>
		</li>
	<?php endforeach; ?>
</ul>

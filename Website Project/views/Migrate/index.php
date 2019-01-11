<link rel="stylesheet" href="" type="text/css">

<?php if (isset($sessionID)): ?>
	<p> You're logged in, <?=$username ?> </p>
	<br></br>
	<br></br>
	<p>Migrations status: <?=$migrate_status ?></p>
	<br>
	<div id= 'createtablestatement'>
		<p>Table of migrations:</p>
		<br>
		<table align = "center">
		<tr>
			<th>Version</th>
			<th>Description</th>
			<th>Has it been run?</th>
			<?php if($admin == true) :?>
			<th>Actions</th>
			<?php endif; ?>
		</tr>
		<tr>
			<td>Migrate A</td>
			<td>Create Table Test</td>
			<td><?= $A_Been_Run ?></td>
			<?php if($admin == true) :?>
			<form method = 'POST', action = 'migrateA'>
			<td><input type = 'submit', value = 'Migrate to version A'></td>
			</form>
			<?php endif; ?>
		</tr>
		<tr>
			<td>Migrate B</td>
			<td>Remove column 'Body 2' in test</td>
			<td><?= $B_Been_Run ?></td>
			<?php if($admin == true) :?>
			<form method = 'POST', action = 'migrateB'>
			<td><input type = 'submit', value = 'Migrate to version B'></td>
			</form>
			<?php endif; ?>
		</tr>
		<tr>
			<td>Migrate C</td>
			<td>Change type of column 'Body 3'</td>
			<td><?= $C_Been_Run ?></td>
			<?php if($admin == true) :?>
			<form method = 'POST', action = 'migrateC'>
			<td><input type = 'submit', value = 'Migrate to version C'></td>
			</form>
			<?php endif; ?>
		</tr>
		</table>
		<br>
	</div>
	
	<?php if($admin == true): ?>
		<br>
		<form method = 'post', action= 'migrate_current'?>
		<input type = 'submit', value = 'Migrate to Current Version'>
		</form>
		<br>
		<br>
	<?php endif; ?>
	<p>DB Table Test Changes (Shows Nothing on Current Version):</p>
	<?php if(DB::list_tables('test') != null) : ?>
	<table align = "center">
	<?php $raw_array = (DB::list_columns('test'));
		foreach ($raw_array as $id): ?>
		<tr>
		<?php foreach ($id as $id2): ?>
		<td><?=$id2; ?></td>
		<?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</table>
	
	 
	<?php endif; ?>
<?php else: ?>
	<p> You must be logged in to view migration content!</p>
	<div class="login">
		<a href="http://www.cs.colostate.edu/~lvreed/ct310/index.php/idaho/loginForm" ><h2>Login</h2></a>
	</div>
<?php endif; ?>

	

	


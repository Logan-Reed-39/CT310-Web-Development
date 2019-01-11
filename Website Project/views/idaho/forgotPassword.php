<?php if ($status == 'success'): ?>
	<p>Password reset link sent successfully</p>
<?php elseif ($status == 'failure'): ?>
	<p>Email does not match a registered user's. Please try again.</p>
<?php endif; ?>

<form method="post">
	<label>Email:<br>
		<input required type="email" name="forgotEmail" placeholder="example@xyz.com">
	</label>
	<br>
	<br>
	<input type="submit" value="Submit">
</form>

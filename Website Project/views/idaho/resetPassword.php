<?php if (!isset($token)): ?>
	<p>Nice try guy/girl/whatever you identify as</p>
	<p>Where's your password reset token?</p>
<?php else: ?>
	<div class="resetPassword">
		<form method="post">
			New password:<br>
			<input type="password" name="newPassword"><br>
			<input type="submit" value="Submit">
		</form>
	</div>
<?php endif; ?>

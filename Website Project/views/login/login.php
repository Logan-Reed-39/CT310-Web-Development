<html>
<body>
	<?php if($status === 'error') {?>
		<p>Incorrect details entered. Please try again.</p>
	<?php } ?>
	<form action="checkLogin" method="POST">
		<input type="text" name="username" placeholder="Please enter username"/>
		<input type="password" name="password" placeholder="Please enter password"/>
		<input type="submit" value="submit">
	</form>

	
</body>
</html>
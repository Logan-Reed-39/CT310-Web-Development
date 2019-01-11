<html>
<head>
	<title> Reset Password </title>

</head>
<body>

	<div class="container text-center">
	  <h3> Password Reset</h3>
		<p>
			Wrong Token
		<p>
		<br>	
<?php
		session_start();
		$username = Session::get('username');
		if(!isset($username)){
			$username = "guest";
		}
?>

	<br>	

</div>
</body>
</html>

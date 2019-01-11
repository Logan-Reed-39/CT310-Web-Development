<html>
<head>
	<title> Reset Password </title>

</head>
<body>

	<div class="container text-center">
	  <h3> Password Reset</h3>
		<p>
			Please enter new password:
		<br>	
<?php
		session_start();
		$username = Session::get('username');
		if(!isset($username)){
			$username = "guest";
		}
?>
		<script>
			function clickAlert(){
				alert("Password has been reset.");
			}			
		</script>

	   <form method="post" >
		New Password: 	<input type="text" name="newPW"><br>
		Confirm Email: 	<input type="text" name="email"><br>
		<input type="submit" value="Reset Password" onclick="clickAlert()" >

		</form>

	<br>	

</div>
</body>
</html>

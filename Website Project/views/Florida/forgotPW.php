<html>
<head>
	<title> Forgot Password </title>

</head>
<body>

	<div class="container text-center">
	  <h3> Password Reset</h3>
		<p>
			Please fill out information below:
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
				alert("Email has been sent. Please get token from email and input it in the field below.");
			}			
		</script>

	   <form method="post" >
		Name: 	<input type="text" name="name"><br>
		Email:	<input required type="text" name="email"><br>
				<input type="submit" value="Reset Password" onclick="clickAlert()" >

		</form>

	<br>	
	<h4> Enter Token to reset password </h4>

	<form method="post" action="<?=Uri::create("Florida/resetPWPage");?> " >
		Token:	<input required type="text" name="token"><br>
		Email:	<input required type="text" name="email"><br>
				<input type="submit" value="Enter Token" >

	</form>


</div>
</body>
</html>

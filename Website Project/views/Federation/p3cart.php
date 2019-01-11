<html>
<head>
	<title> Shopping Cart </title>

</head>
<body>

	<div class="container text-center">
	  <h3> Shopping Cart</h3>
		<p>
			Items in cart:
		<br>	
<?php
		session_start();
		$username = Session::get('username');
		$message = "You have ordered brochures on the following list:";
		if(!isset($username)){
			$username = "guest";
		}
?>
		<?php
			foreach($p3cart as $item){
					echo $item['name']; 
		?>
					<a  href="<?php echo Uri::create('Federation/deleteItem/'.$item['name']); ?>"><input type="button" name="deleteComment" value="delete" id="deleteComment"></a> 								<br>
		<?php		}	?>
	   </p>


		<script>
			function clickAlert(){
				alert("Email has been sent.");
			}			
		</script>

	   <form method="post" >
		Name: 	<input type="text" name="name"><br>
		Email:	<input required type="text" name="email"><br>
				<input type="submit" value="Request Brochure" onclick="clickAlert()" >

		</form>

		
</div>
</body>
</html>



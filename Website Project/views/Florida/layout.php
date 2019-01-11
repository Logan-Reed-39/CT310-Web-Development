<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php echo Asset::css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
		<?php echo Asset::css('https://fonts.googleapis.com/css?family=Lato'); ?>
		<?php echo Asset::css('https://fonts.googleapis.com/css?family=Montserrat'); ?>
		<?php echo Asset::js("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js");?>
		<?php echo Asset::js("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");?>
		<?php echo Asset::css('Florida-style.css'); ?>
	</head>
	<body>



	<nav class="navbar navbar-fixed-top">
		<div class="container-fluid"> 
			<ul class="nav navbar-nav navbar-justified">
				<li> <a href=<?=Uri::create("Florida/welcome.php"); ?> >Home</a></li>
				<li><a href=<?=Uri::create("federation/allListing.php"); ?>>Federation Attraction Listing</a></li>

				<?php
					$session = Session::instance();
					if($session->get('admin') == 1){
				?>
					<li><a href=<?=Uri::create("Florida/addAttraction.php"); ?>> +Add Attraction</a></li>
				<?php } ?>
				
				<li><a href=<?=Uri::create("Florida/aboutus.php"); ?>>About Us</a></li>

				<?php $session = Session::instance();
					  $username=Session::get('username');
						if(!isset($username)){
							$username = "guest";
				}?>
				<li> <a href=<?=Uri::create("Florida/cart/".$username); ?> >Cart</a></li>
				<ul class="nav navbar-nav navbar-justified">
				
				<li class="dropdown" id="menuLogin">
					<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
					<div class="dropdown-menu" style="padding:17px;">
				<?php 
				$session = Session::instance();
				if(strcmp("",$session->get('username'))==0){ ?>
						<form action=<?=Uri::create("florida/login"); ?> method="POST"> 
							<input name="username" id="username" type="text" placeholder="Username"> 
							<input name="password" id="password" type="password" placeholder="Password"><br>	
							<input type="submit" value="login">
						</form>

				<?php } else { ?>
					<form action=<?=Uri::create("florida/logout"); ?> method="POST"> 
					<input type="submit" value="logout">
					</form>

				<?php } ?>
					<a href=<?=Uri::create("Florida/forgotPW.php"); ?> >Forgot Password?</a>
					</div>
				</li>
			</ul>
			
		</div>
	</nav>

		<div id="mainContent" >
			<?=$content; ?>
		</div>
		<div id="footer" align="center">
			Part of a <a href="https://www.cs.colostate.edu/~ct310/">CT310</a> Course Project
		</div>
	</body>
</html>

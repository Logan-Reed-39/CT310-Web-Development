<html>
<head>
	<title> Universal Studios </title>

</head>
<body>
	<nav class="navbar navbar-fixed-top">
		<div class="container-fluid">
			<ul class="nav navbar-nav navbar-justified">
	 			<li><a href="Welcome.php">Home</a></li>
	 			<li><a href="kss.php">Kennedy Space Station</a></li>
	  			<li class="active"><a href="universal.php">Universal Studios</a></li>
	  			<li><a href="buschgardens.php">Busch Gardens</a></li>
				<li><a href="aboutus.php">About Us</a></li>
				<li><a href="comment.php">Comment</a></li>
				<li><a href="addAttraction.php">+Add Attraction</a></li>	

			</ul>
			<ul class="nav navbar-nav navbar-justified">
          			<li class="dropdown" id="menuLogin">
            			<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
                        <div class="dropdown-menu" style="padding:17px;">
<?php 
				$session = Session::instance();
				if(strcmp("",$session->get('username'))==0){ ?>
                                <form action="login" method="POST"> 
                                    <input name="username" id="username" type="text" placeholder="Username"> 
                                    <input name="password" id="password" type="password" placeholder="Password"><br>
                                    <input type="submit" value="login">
				</form>
				<?php } else { ?>
				<form action="logout" method="POST"> 
                                    <input name="username" id="username" type="text" placeholder="Username"> 
                                    <input name="password" id="password" type="password" placeholder="Password"><br>
                                    <input type="submit" value="logout">
				</form>
<?php } ?>
				
            		</div>
                    		</li>
          	 	 </ul>
		</div>
</nav>
	<br>
	<br>
	<br>

	<!-- Indicators -->
	<div id="Carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#Carousel" data-slide-to="0" class="active"></li>
			<li data-target="#Carousel" data-slide-to="1"></li>
			<li data-target="#Carousel" data-slide-to="2"></li>
			<li data-target="#Carousel" data-slide-to="3"></li>
		</ol>

		<!-- Wrapper -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
                <?php echo Asset::img('UniversalAtNight.jpg');?>
			</div>
		
			<div class="item">
				<?php echo Asset::img('universalPond.jpg');?>
			</div>
			
			<div class="item">
				<?php echo Asset::img('parade.jpg');?>
			</div>
			
			<div class="item">
				<?php echo Asset::img('diagonally.jpg');?>
			</div>
		</div>
		
		 <!-- Left and right controls -->
  		<a class="left carousel-control" href="#Carousel" role="button" data-slide="prev">
   			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    			<span class="sr-only">Previous</span>
 		</a>
		
  		<a class="right carousel-control" href="#Carousel" role="button" data-slide="next">
    			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    			<span class="sr-only">Next</span>
  		</a>
	</div>
	<div class="container text-center">
	  <h3> Universal Studios </h3>
        <p>
            <a href="https://www.universalorlando.com/web/en/us/index.html"><strong>Universal Studios Florida</strong></a>&nbsp;is a theme park located in Orlando Florida. Opened on June 7, 1990, the park's theme is the entertainment industry, in particular movies and television. Universal Studios Florida inspires its guests to "ride the movies", and it features numerous attractions and live shows. The park is one component of the larger Universal Orlando Resort.
        </p>
        <p>
            In 2016, the park hosted an estimated 9,998,000 visitors, ranking as the sixth most attended theme park in the United States, as well as the ninth most attended theme park worldwide.
        </p>
        <p>
            Information from <a href="https://en.wikipedia.org/wiki/Universal_Studios_Florida">wikipedia.</a>
        </p>
	</div>

</body>
</html>

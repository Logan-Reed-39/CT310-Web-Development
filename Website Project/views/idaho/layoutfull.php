<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>U.S.Attractions</title>
		<link href="https://fonts.googleapis.com/css?family=Lato|Oswald|Cabin" rel="stylesheet">
		<?php echo Asset::css('idaho.css'); ?>
	</head>
	
	
	<body>
		<div id="head">
			<div class="stateBanner">
				<h1><a href="<?=Uri::create('idaho/index'); ?>"><p>U.S.Attractions</a></h1>
			</div>
			<div class="login">
				<?=$login; ?>
			</div>
		</div>
		<div id="mainContent">
			<?=$content; ?>
		</div>
		<div id="footer">
			This site is part of a CSU <a href="https://www.cs.colostate.edu/~ct310/">CT310</a> Course Project.
		</div>
	</body>
</html>

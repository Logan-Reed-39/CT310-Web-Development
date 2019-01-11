<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>CT310 Examples</title>
		<?php echo Asset::css('bootstrap.min.css'); ?>
		<?php echo Asset::css('bootstrap.css'); ?>
		<?php echo Asset::css('bootstrap-theme.min.css'); ?>
		<?php echo Asset::css('bootstrap-theme.css'); ?>
	</head>
	<body>
		<div class="container">
			<div id="head">
				<h1>CT310 Examples</h1>
			</div>
			<div id="mainContent">
				<?=$content; ?>
			</div>
			<div id="footer">
				Part of a <a href="https://www.cs.colostate.edu/~ct310/">CT310</a> Course Project
			</div>
		</div>
	</body>
</html>

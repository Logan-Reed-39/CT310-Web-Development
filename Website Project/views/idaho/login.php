<!-- 76 is the guest ID for when people visit the site and are not logged in -->
<?php if ($id == 76): ?>
	<div class="loggedOut">
		<p><?= "Welcome"?></p>
		<a href="<?=Uri::create('idaho/loginForm'); ?>">Login</a>
		<p><a href="<?=Uri::create('idaho/shoppingCart'); ?>">Brochure basket</a></p>
	</div>
<?php else: ?>
	<div class="loggedIn">
		<p><?= "Welcome, ".$username; ?></p>
		<p><a href="<?=Uri::create('idaho/shoppingCart'); ?>">Brochure basket</a></p>
		<p><a href="<?=Uri::create('idaho/logout'); ?>">Logout</a></p>
	</div>
<?php endif; ?>

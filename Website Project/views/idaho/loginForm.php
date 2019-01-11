<?php if($status === 'error') {?>
	<p>Incorrect username / password entered. Please try again.</p>
<?php } ?>
<form action="checkLogin" method="POST">
	
	<label>Username:
        <br>
        <input type="text" name="username" placeholder="Please enter username"/>
    </label>
	<br>
	<br>
	<label>Password:
        <br>
        <input type="password" name="password" placeholder="Please enter password"/>
    </label>
	<br>
	<br>
	<a href="<?=Uri::create('idaho/forgotPassword'); ?>">Forgot password?</a> 
	<br>
	<br>
	<input type="submit" value="submit">
</form>

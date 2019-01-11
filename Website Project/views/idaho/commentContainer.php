<div class="comments">
    <h3>
        <u>Comments</u>
    </h3>
	<?php if (isset($comments)): ?>
		<p><?=$comments; ?></p>
	<?php endif; ?>
</div>
<div class="commentBox">	
	<?php if (isset($id)): ?>
		<form method="post" >
			<input name="comment" placeholder="Enter comment here..."></input>
			<br>
			<input type="submit" value="submit" />
		</form>
	<?php else: ?>
		<a href="<?=Uri::create('idaho/loginForm'); ?>"> Please login to comment </a>
	<?php endif; ?>
</div>

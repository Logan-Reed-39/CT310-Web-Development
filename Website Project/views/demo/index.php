<h2>
	Index of Demos
	<span class="floatRight">
		<a href="<?=Uri::create('index.php/demo/addEdit'); ?>">+ Add Demo</a>
	</span>
	<span class="floatClear"></span>
</h2>
<div class="h2Content">
	<?php foreach($demos as $demo): ?>
		<a href="<?=Uri::create('index.php/demo/view/'.$demo->id); ?>">
			<?=$demo; ?>
		</a><br />
	<?php endforeach; ?>
</div>

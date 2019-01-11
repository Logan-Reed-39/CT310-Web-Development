<h2>
	<a href="<?=Uri::create('index.php/demo/index'); ?>">Demos</a>
	&raquo; View Demo Object
	<span class="floatRight">
		<a href="<?=Uri::create('index.php/demo/delete/'.$demo->id); ?>">&#x1f5d1; Delete</a>
	</span>
	<span class="floatRight">&nbsp;&nbsp;&nbsp;</span>
	<span class="floatRight">
		<a href="<?=Uri::create('index.php/demo/addEdit/'.$demo->id); ?>">&#x270E; Edit</a>
	</span>
	<span class="floatClear"></span>
</h2>
<div class="h2Content">
	ID: <?=$demo->id; ?><br />
	Name: <?=$demo->name; ?>
</div>

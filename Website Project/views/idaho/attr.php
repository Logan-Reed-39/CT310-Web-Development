<h2>
	<a href="<?=Uri::create('idaho/index'); ?>">Back to home</a>
	&raquo; <?=$attr_name; ?>
</h2>

<div class="atrContent">
	<div class="pic">
		<img src="<?=$attr_img; ?>" alt="<?=$attr_name; ?>">
			<figcaption>
				<a href="<?=$attr_img; ?>">Source</a>
			</figcaption>
	</div>
	
    <div class="atrDescription">
        <p>
			<?=$attr_descrip; ?>
        </p>
    </div>
	<div id="addToCart">
		<a href="<?=$addToCart; ?>">Add a brochure for this attraction to your cart!</a>
	</div>
	<div class="commentContainer">
		<?=$commentContainer; ?>
	</div>
</div>

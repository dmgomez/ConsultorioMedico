<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-6">
		<p>
			<h2>Sidebar</h2>
			Sidebar content here
		</p>

	</div>
	<div id="content" class="span-16">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="span9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span3">
	<div id="sidebar">
		<div class="well">
		<?php
		if(isset($this->menu)){
			$this->widget('bootstrap.widgets.BootMenu', array(
				'type'=>'list',
				'items'=>$this->menu,
				//'htmlOptions'=>array('class'=>'operations'),
			));
		}
		?>
		</div>
		<div class="well">
		<?php
		$this->widget('application.widgets.category.CategoryList');
		?>
		</div>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
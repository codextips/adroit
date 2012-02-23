<?php $this->beginContent('//layouts/main'); ?>
<div class="span12" id="content">
	<?php
	if(isset($this->menu)){
		$this->widget('bootstrap.widgets.BootMenu', array(
			'type'=>'tabs',
			'items'=>$this->menu,
			//'htmlOptions'=>array('class'=>'operations'),
		));
	}
	?>

	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
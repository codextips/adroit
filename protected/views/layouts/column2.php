<?php $this->beginContent('//layouts/main'); ?>
<div class="span9">
	<div id="content">
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('info')): ?>
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert">×</a>
                <?php echo Yii::app()->user->getFlash('info'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert">×</a>
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php endif; ?>
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
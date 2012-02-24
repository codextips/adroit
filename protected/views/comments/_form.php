<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
    'action' => array('comments/create'),
	'id' =>'comments-form',
	'enableAjaxValidation' => true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'body'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <?php echo CHtml::activeHiddenField($model, 'event_id'); ?>
    <?php echo CHtml::activeHiddenField($model, 'talk_id'); ?>
    <?php echo CHtml::activeHiddenField($model, 'user_id'); ?>
    <?php echo CHtml::activeHiddenField($model, 'rating'); ?>
    <?php echo CHtml::activeHiddenField($model, 'is_private'); ?>
	<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="actions">
        <?php echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Post comment' : 'Save', array('comments/create'), array('success' => "function(){jQuery('#comment-list').yiiListView.update('comment-list');jQuery('#Comments_body').val('')}"), array('class' => 'btn small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'talks-form',
	'enableAjaxValidation' => true,
        'enableClientValidation'=> true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	 <?php echo CHtml::activeHiddenField($model, 'event_id'); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'summary',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'speaker',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'slide_link',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="actions">
            <?php echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Post talk' : 'Save', array('talks/create'), array('success' => "function(){jQuery('#talk-list').yiiListView.update('talk-list');jQuery(':input','#talks-form').not(':button, :submit, :reset, :hidden') .val('').removeAttr('checked') .removeAttr('selected');}"), array('class' => 'btn small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

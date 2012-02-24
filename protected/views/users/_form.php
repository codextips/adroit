<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>25)); ?>
	
	<?php echo $form->passwordFieldRow($model,'new_password',array('class'=>'span5','maxlength'=>25)); ?>
	
	<?php echo $form->passwordFieldRow($model,'confirm_password',array('class'=>'span5','maxlength'=>25)); ?>

	<?php //echo $form->textFieldRow($model,'create_date',array('class'=>'span5')); ?>

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

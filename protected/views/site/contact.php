<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
    'type'=>'horizontal',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
	<?php //echo CHtml::link("Refresh Captcha",array('site/captcha','refresh'=>1)); ?>
	<?php echo $form->captchaRow($model,'verifyCode',array('class'=>'span5')); ?>
	<?php endif; ?>

	<div class="actions offset6">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn-large btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<?php endif; ?>
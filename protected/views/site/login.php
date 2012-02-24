<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
    'type'=>'horizontal',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'password',array('class'=>'span5')); ?>	

	<div class="actions">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<div class="alert alert-success">
    <h4>You can also login using:</h4>
    <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/google_signin.png'), Yii::app()->createUrl('site/login?type=google'), array('calss' => 'thumbnail')); ?>
    <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/yahoo_signin.png'), Yii::app()->createUrl('site/login?type=yahoo'), array('calss' => 'thumbnail')); ?>
</div>
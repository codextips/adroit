<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'events-form',
	//'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo CHtml::activeHiddenField($model, 'user_id'); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'summary',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->FileFieldRow($model,'logo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'location',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'href',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="control-group <?php echo ($model->hasErrors('start_date'))? 'error' : '' ?>">
		<?php echo $form->labelEx($model,'start_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Events[start_date]',
				'value'=> $model->start_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'start_date'); ?>
		</div>
	</div>
	
	<div class="control-group <?php echo ($model->hasErrors('end_date'))? 'error' : '' ?>">
		<?php echo $form->labelEx($model,'end_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Events[end_date]',
				'value'=> $model->end_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'end_date'); ?>
		</div>
	</div>

	<?php echo $form->radioButtonListInlineRow($model,'is_active', $model->aliasIsActive, array('class'=>'span5')); ?>

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class'=>'btn-large btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

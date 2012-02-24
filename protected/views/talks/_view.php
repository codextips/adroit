<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('talk_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->talk_id),array('view','id'=>$data->talk_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('speaker')); ?>:</b>
	<?php echo CHtml::encode($data->speaker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slide_link')); ?>:</b>
	<?php echo CHtml::encode($data->slide_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_comments')); ?>:</b>
	<?php echo CHtml::encode($data->total_comments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_count')); ?>:</b>
	<?php echo CHtml::encode($data->rate_count); ?>
	<br />

	*/ ?>

</div>
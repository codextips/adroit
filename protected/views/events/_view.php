<div class="view event">
	<div class="span2">
		<?php if (!empty($data->logo)): ?>
			<a href="#" class="thumbnail">
				<?php echo CHtml::image($data->logo) ?>
			</a>
		<?php else: ?>
			<a href="#" class="thumbnail">
				<?php echo CHtml::image('http://placehold.it/160x120') ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="span6">
		<h3>
			<?php echo CHtml::link(CHtml::encode($data->title), array('events/view', 'id' => $data->event_id)); ?>
		</h3>

		<b>
			<?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:
		</b>
		
		<?php echo CHtml::encode($data->location); ?>
		<br />

		<b>
			<?php echo CHtml::encode($data->getAttributeLabel('href')); ?>:
		</b>
		<a href='<?php echo CHtml::encode($data->href); ?>'>
			<?php echo CHtml::encode($data->href); ?>
		</a>
		<br />
		
		<p>
			<?php echo CHtml::encode($data->summary); ?>
		</p>
	</div>

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	  <?php echo CHtml::encode($data->start_date); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	  <?php echo CHtml::encode($data->end_date); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	  <?php echo CHtml::encode($data->is_active); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('total_attending')); ?>:</b>
	  <?php echo CHtml::encode($data->total_attending); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	  <?php echo CHtml::encode($data->create_date); ?>
	  <br />

	 */ ?>

</div>
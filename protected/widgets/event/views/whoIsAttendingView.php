<div class="alert alert-info"><b>Who is attending!</b></div>
<ul class="thumbnails">
<?php foreach ($attendees as $attendee){ ?>
	<li class="thumbnails-mini">
		<?php echo CHtml::link(CHtml::image($attendee->getGravatar()),
				array('user/view', 'id'=>$attendee->user_id), array(
					'class'=>'thumbnail',
					'data-title'=>'Attendee',
					'data-content'=> ((!empty ($attendee->name)) ? 'Name: '.$attendee->name.'<br />' : '').'Email: '. $attendee->email,
					'rel'=>'popover',
					)
				); ?>
	</li>
<?php } ?>
</ul>

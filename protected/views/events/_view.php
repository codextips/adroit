<div class="view event" id="<?php echo $data->event_id; ?>">
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
        <p>
            <a href="<?php echo Yii::app()->createUrl('events/view', array('id' => $data->event_id)); ?>"><i class="icon-comment"></i>&nbsp;<?php echo $data->comments_count; ?> comments</a> &nbsp;
            <span id="attendance-text">
                <?php
                if(isset (Yii::app()->user->id)){
                    $attendees = $data->attendees(array('condition' => 'attendees.user_id = ' . Yii::app()->user->id));
                    if(empty($attendees)){
                ?>
                    <i class="icon-user"></i>&nbsp;<strong><?php echo $data->total_attending; ?> people</strong> attending so far! &nbsp;
                    <a id="i-am-attending" href="#" class="btn small">I'm attending</a>
                <?php }else{?>
                    <i class="icon-user"></i>&nbsp;<strong>You</strong> and <strong><?php echo (int)$data->total_attending > 0 ? ($data->total_attending - 1) : $data->total_attending; ?> other people</strong> attending so far!
                <?php }
                    
                }else{
                    echo "<i class='icon-user'></i>&nbsp;<strong>$data->total_attending people</strong> attending so far! &nbsp;";
                    echo CHtml::link("Login to attend!", array('site/login'), array('class' => 'btn small btn-primary'));
                }
                ?>
            </span>
        </p>
	</div>
</div>
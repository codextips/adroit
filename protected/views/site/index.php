<?php $this->pageTitle = Yii::app()->name; ?>
<?php if (Yii::app()->user->isGuest): ?>
	<div class="alert alert-info message">
		<h4>Welcome to Tech Adda!</h4>
		<p>This is the site where event attendees can leave feedback on a tech event and its sessions. 
			Do you have an opinion? Then <strong><?php echo CHtml::link('login', 'site/login'); ?></strong> and share it!</p>
	</div>
<?php endif; ?>
<h2>Upcoming Events</h2>
<?php
$this->widget('ext.bootstrap.widgets.BootListView', array(
	'dataProvider' => $events,
	'itemView' => '//events/_view',
));
?>
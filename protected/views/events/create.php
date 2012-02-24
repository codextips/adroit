<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Events','url'=>array('index')),
	array('label'=>'Manage Events','url'=>array('admin')),
);
?>

<h1>Submit an event!</h1>
<p>Submit your event here to be included on Tech Adda. 
	The site is aimed at events with sessions, where organisers are looking to 
	use this as a tool to gather feedback.
</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
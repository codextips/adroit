<?php
$this->breadcrumbs=array(
	'Talks'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Talks','url'=>array('index')),
	array('label'=>'Create Talks','url'=>array('create')),
	array('label'=>'Update Talks','url'=>array('update','id'=>$model->talk_id)),
	array('label'=>'Delete Talks','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->talk_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Talks','url'=>array('admin')),
);
?>

<h1>View Talks #<?php echo $model->talk_id; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'talk_id',
		'event_id',
		'title',
		'summary',
		'speaker',
		'slide_link',
		'total_comments',
		'rating',
		'rate_count',
	),
)); ?>

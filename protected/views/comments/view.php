<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->comment_id,
);

$this->menu=array(
	array('label'=>'List Comments','url'=>array('index')),
	array('label'=>'Create Comments','url'=>array('create')),
	array('label'=>'Update Comments','url'=>array('update','id'=>$model->comment_id)),
	array('label'=>'Delete Comments','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->comment_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comments','url'=>array('admin')),
);
?>

<h1>View Comments #<?php echo $model->comment_id; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'comment_id',
		'event_id',
		'talk_id',
		'user_id',
		'body',
		'rating',
		'is_private',
		'create_date',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Events','url'=>array('index')),
	array('label'=>'Create Events','url'=>array('create')),
	array('label'=>'Update Events','url'=>array('update','id'=>$model->event_id)),
	array('label'=>'Delete Events','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->event_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Events','url'=>array('admin')),
);
?>

<h1>View Events #<?php echo $model->event_id; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'event_id',
		'user_id',
		'title',
		'summary',
		'logo',
		'location',
		'href',
		'start_date',
		'end_date',
		'is_active',
		'total_attending',
		'create_date',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Users','url'=>array('index')),
	array('label'=>'Create Users','url'=>array('create')),
	array('label'=>'View Users','url'=>array('view','id'=>$model->user_id)),
	array('label'=>'Manage Users','url'=>array('admin')),
);
?>
<div class="alert alert-info"><h3>Profile Info</h2></div>
<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		'name',
		'api_key',
	),
)); ?>
<div class="alert alert-info"><h3>Update Profile</h3></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
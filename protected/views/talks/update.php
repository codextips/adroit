<?php
$this->breadcrumbs=array(
	'Talks'=>array('index'),
	$model->title=>array('view','id'=>$model->talk_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Talks','url'=>array('index')),
	array('label'=>'Create Talks','url'=>array('create')),
	array('label'=>'View Talks','url'=>array('view','id'=>$model->talk_id)),
	array('label'=>'Manage Talks','url'=>array('admin')),
);
?>

<h1>Update Talks <?php echo $model->talk_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
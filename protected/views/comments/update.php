<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->comment_id=>array('view','id'=>$model->comment_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comments','url'=>array('index')),
	array('label'=>'Create Comments','url'=>array('create')),
	array('label'=>'View Comments','url'=>array('view','id'=>$model->comment_id)),
	array('label'=>'Manage Comments','url'=>array('admin')),
);
?>

<h1>Update Comments <?php echo $model->comment_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Talks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Talks','url'=>array('index')),
	array('label'=>'Manage Talks','url'=>array('admin')),
);
?>

<h1>Create Talks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
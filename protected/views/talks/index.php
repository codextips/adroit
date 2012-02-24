<?php
$this->breadcrumbs=array(
	'Talks',
);

$this->menu=array(
	array('label'=>'Create Talks','url'=>array('create')),
	array('label'=>'Manage Talks','url'=>array('admin')),
);
?>

<h1>Talks</h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'//talks/_view',
)); ?>

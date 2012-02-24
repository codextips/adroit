<?php
$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=>'Create Events','url'=>array('create')),
	array('label'=>'Manage Events','url'=>array('admin')),
);
?>
<?php
if($this->uniqueId == 'site'){
    $this->renderPartial('//site/index');
}else{
    echo "<h1>Events</h1>";
}
?>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'//events/_view',
)); ?>


<script type="text/javascript">
    attendance_url = '<?php echo Yii::app()->createUrl('events/attending') ?>';
</script>
<script src="<?php echo Yii::app()->baseUrl . "/js/i-am-attending.js"; ?>" type="text/javascript"></script>

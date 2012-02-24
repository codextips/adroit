<?php
$this->widget('ext.bootstrap.widgets.BootListView', array(
    'id' => 'talk-list',
    'dataProvider' => $dataProvider,
    'itemView' => '_view_talk',
));
?>
<br />
<?php if(!Yii::app()->user->isGuest): ?>
<div class="well" style="clear: both;">
    <h4>Post your talk</h4>
    <?php echo $this->renderPartial('//talks/_form', array('model' => $talk)); ?>
</div>
<?php endif; ?>
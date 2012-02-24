<div class="comments">
    <?php
    $this->widget('ext.bootstrap.widgets.BootListView', array(
        'id' => 'comment-list',
        'dataProvider' => $dataProvider,
        'itemView' => '_view_comment',
    ));
    ?>
</div>
<br />
<?php if(!Yii::app()->user->isGuest): ?>
<div class="well" style="clear: both;">
    <h4>Post your comment</h4>
    <?php echo $this->renderPartial('//comments/_form', array('model' => $comment)); ?>
</div>
<?php endif; ?>
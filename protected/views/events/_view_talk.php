<div class="view">

    <?php echo CHtml::link(CHtml::encode($data->title), array('talks/view', 'id' => $data->talk_id)); ?>
    <i class="icon-comment"></i> <?php echo $data->comments_count ;?> comments
  
</div>
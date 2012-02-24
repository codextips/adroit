<?php
$this->breadcrumbs = array(
    'Events' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Events', 'url' => array('index')),
    array('label' => 'Create Events', 'url' => array('create')),
    array('label' => 'Update Events', 'url' => array('update', 'id' => $model->event_id)),
    array('label' => 'Delete Events', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->event_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Events', 'url' => array('admin')),
);
?>

<div id="<?php echo $model->event_id; ?>" class="single-event">
    <div class="row">
        <div class="span2">
            <?php if (!empty($model->logo)): ?>
                <a href="#" class="thumbnail">
                    <?php echo CHtml::image($model->logo) ?>
                </a>
            <?php else: ?>
                <a href="#" class="thumbnail">
                    <?php echo CHtml::image('http://placehold.it/160x120') ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="span6">
            <h2><?php echo $model->title; ?></h2>
            <div class="meta">
                <?php echo $model->start_date; ?> - <?php echo $model->end_date; ?> <br />
                <?php echo "Show categories here"; ?><br />
                <?php echo $model->location; ?><br />
            </div>
            <p>
                <a href="#">0 comments</a> &nbsp;
                <span id="attendance-text">
                    <?php
                    if(isset (Yii::app()->user->id)){
                        $attendees = $model->attendees(array('condition' => 'attendees.user_id = ' . Yii::app()->user->id));
                        if(empty($attendees)){
                    ?>
                        <strong><?php echo $model->total_attending; ?> people</strong> attending so far! &nbsp;
                        <a id="i-am-attending" href="#" class="btn small">I'm attending</a>
                    <?php }else{?>
                        <strong>You</strong> and <strong><?php echo (int)$model->total_attending > 0 ? ($model->total_attending - 1) : $model->total_attending; ?> other people</strong> attending so far!
                    <?php }

                    }else{
                        echo "<strong>$model->total_attending people</strong> attending so far! &nbsp;";
                        echo CHtml::link("Login to attend!", array('site/login'), array('class' => 'btn small btn-primary'));
                    }
                    ?>
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="span8">
            <p><?php echo nl2br($model->summary); ?></p>
            <p><strong>Event Link:</strong> <br /><a target="_blank" href="<?php echo$model->href; ?>"><?php echo $model->href; ?></a></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    attendance_url = '<?php echo Yii::app()->createUrl('events/attending') ?>';
</script>
<script src="<?php echo Yii::app()->baseUrl . "/js/i-am-attending.js"; ?>" type="text/javascript"></script>
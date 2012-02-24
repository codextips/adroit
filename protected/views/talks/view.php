<?php
$this->breadcrumbs = array(
    'Talks' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Talks', 'url' => array('index')),
    array('label' => 'Create Talks', 'url' => array('create')),
    array('label' => 'Update Talks', 'url' => array('update', 'id' => $model->talk_id)),
    array('label' => 'Delete Talks', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->talk_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Talks', 'url' => array('admin')),
);
?>
<div id="<?php echo $model->talk_id; ?>" class="single-talk">
    <div class="row">
        <div class="span9">
            <h2><?php echo $model->title; ?></h2>
            <div class="meta">
                by <strong><?php echo $model->speaker; ?></strong> <br>
                Talk at <?php echo CHtml::link($model->event->title, array('events/view', 'id' => $model->event->event_id)) ?>
                <?php $model->rating_stars_on = round((90 * $model->rating) / 5, 1); ?>
                <div id="1" class="stat">
                    <div class="statVal">
                        <span class="ui-rater">
                            <span class="ui-rater-starsOff" style="width:90px;"><span class="ui-rater-starsOn" style="width:<?php echo $model->rating_stars_on;?>px"></span></span>
                            <span class="ui-rater-rating"><?php echo $model->rating; ?></span>&#160;(<span class="ui-rater-rateCount"><?php echo $model->rate_count; ?></span>)
                        </span>
                    </div>
                </div>
            </div>
            <p>
                <?php echo CHtml::encode($model->summary); ?>
            </p>
            <script src="<?php echo Yii::app()->baseUrl . "/js/jquery.rater.js"; ?>" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $('div#<?php echo $model->talk_id; ?>').rater({ postHref: '<?php echo Yii::app()->createUrl('talks/rate', array('id' => $model->talk_id));?>' });
                });
            </script>
        </div>
    </div>
    <div class="row">
        <div class="span9">
            <h2>Post your comment</h2>
            <?php $this->renderPartial('_comments', array('dataProvider' => $commentsDataProvider, 'comment' => $comment)); ?>
        </div>
    </div>
</div>

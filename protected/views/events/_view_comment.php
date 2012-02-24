<div class="comment" id="<?php echo $data->comment_id; ?>">
    <div class="meta"><strong><?php echo $data->commentor->email; ?></strong> on <em>23 Jan 2012</em> said:</div>
    <?php echo CHtml::encode($data->body); ?>
</div>
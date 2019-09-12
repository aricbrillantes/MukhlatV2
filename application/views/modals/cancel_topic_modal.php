<?php $topic = $_SESSION['current_topic']; ?>
<div id="cancel-topic-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "post-confirm-topic" class="modal-title"><strong>Cancel <?php echo utf8_decode($topic->topic_name); ?>?</strong></h4>
            </div>
            <div class="modal-body">
                <span class = "text-warning"><i class = "fa fa-warning"></i> <strong>WARNING: Cancelling <?php echo utf8_decode($topic->topic_name); ?> will make it unaccessible to everyone! Once cancelled, you cannot undo your action. Proceed with cancelling <?php echo utf8_decode($topic->topic_name); ?>?</strong></span>
                <form action = "<?php echo base_url('topic/cancel_topic/' . $topic->topic_id); ?>" id = "delete-post-form" method = "POST">
                    <button id = "delete-post-proceed" type = "submit" class = "btn btn-danger">Proceed</button>
                    <button class = "btn" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
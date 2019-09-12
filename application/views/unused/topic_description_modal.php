<?php
$topic = $_SESSION['current_topic'];
?>
<!-- Topic Modal -->
<div id="topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Topic Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
            </div>
            <div class="modal-body">
                <?php if ($is_moderated): ?>
                    <div class = "col-md-12" style = "margin-bottom: 5px;">
                        <?php if ($topic->creator_id === $logged_user->user_id): ?>
                            <button type = "button" id = "cancel-topic-btn" class = "pull-right btn btn-xs btn-danger" style = "margin-left: 5px;"><i class = "fa fa-trash"></i> Cancel Topic</button>
                        <?php endif; ?>
                        <button id = "edit-topic-btn" class = "pull-right btn btn-gray btn-xs"><i class = "fa fa-pencil"></i> Edit Description</button>
                    </div>

                    <div id = "desc-edit" class = "col-md-12 hidden">
                        <div class = "form-group" style = "margin-bottom: 5px;">
                            <textarea id = "edit-topic-text" class = "form-control"><?php echo utf8_decode($topic->topic_description); ?></textarea>
                        </div>
                        <div class = "form-group pull-right" style = "margin-top: 0px;">
                            <button value = "<?php echo $topic->topic_id ?>" id = "edit-topic-save" class = "btn btn-primary btn-sm">Save</button>
                            <button id = "edit-topic-cancel" type = "button" class = "btn btn-gray btn-sm">Cancel</button>
                        </div>
                    </div>
                <?php endif; ?>
                <p id = "desc-container" class = "wrap text-center">
                    <?php echo utf8_decode($topic->topic_description); ?>
                </p>
                <p class = "text-muted" align = "center">
                    <small><i>Created by <a class = "btn btn-link btn-xs no-padding no-margin" href = "<?php echo base_url('user/profile/' . $topic->user->user_id); ?>"><?php echo $topic->user->first_name . " " . $topic->user->last_name; ?></a> on <?php echo date("M-d-y", strtotime($topic->date_created)); ?></i></small>
                </p>
            </div>
        </div>
    </div>
</div>
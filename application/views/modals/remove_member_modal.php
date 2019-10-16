<?php
$topic = $_SESSION['current_topic'];
if ($type === '1'):
    $btn_id = 'remove-follower-proceed';
    $type = 'Remove ' . $user->first_name . ' from being a follower?';
elseif ($type === '2'):
    $btn_id = 'remove-moderator-proceed';
    $type = 'Remove ' . $user->first_name . ' from being a moderator?';
elseif ($type === '3'):
    $btn_id = 'remove-creator-proceed';
    $type = 'WARNING: Removing yourself, the creator of ' . utf8_decode($topic->topic_name) . ', would also cancel the topic! Proceed?';
endif;
?>

<div id="remove-member-confirm" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "remove-member-header" class="modal-title"><strong><?php echo $type; ?></strong></h4>
            </div>
            <div class="modal-body">
                <form id = "delete-post-form" method = "POST">
                    <button value = "<?php echo $user->user_id; ?>" id = "<?php echo $btn_id; ?>" type = "submit" class = "btn btn-danger">Proceed</button>
                    <button class = "btn" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
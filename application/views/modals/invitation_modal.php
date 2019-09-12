<?php
$topic = $_SESSION['current_topic'];
?>
<!-- Invitation Modal -->
<div id="invitation-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Invitation Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Invite others to moderate <?php echo utf8_decode($topic->topic_name); ?>!</h4>
            </div>
            <div class="modal-body">
                <h5 class ="text-muted text-right no-margin no-padding" style = "margin-bottom: 10px;">Users selected: 
                    <span id = "user-invite-count">0</span>
                </h5>
                <form id = "invite-form" action = "<?php echo base_url('invite'); ?>" method = "POST" style = "height: 400px; overflow-y: auto">
                    <ul class = "list-group">
                        <?php foreach ($topic->nonmoderators as $nonmoderator): ?>
                            <li class = "list-group-item no-padding no-margin" style = "padding-left: 10px; font-size: 12px;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class = "name-invite"  name = "invite-checkbox[]" value="<?php echo $nonmoderator->user_id ?>">
                                        <img src = "<?php echo $nonmoderator->profile_url ? base_url($nonmoderator->profile_url) : base_url('images/default.jpg') ?>" class = "img-circle" style = "width: 25px;"/>
                                        <?php echo $nonmoderator->first_name . " " . $nonmoderator->last_name ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </form>
                <button id = "invite-btn" class = "btn btn-primary">Invite Selected Users</button>
            </div>
        </div>
    </div>
</div>
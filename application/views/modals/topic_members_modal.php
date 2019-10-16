<?php
$topic = $_SESSION['current_topic'];
?>
<!-- Topic Modal -->
<div id="topic-members-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Topic Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Members of <?php echo utf8_decode($topic->topic_name); ?></h4>
            </div>
            <div class="modal-body" style = "height: 400px;">
                <!-- followers -->
                <div class = "col-sm-12 no-padding">
                    <div class = "col-xs-12 no-padding">
                        <h4 class = "text-center text-info text1color"><strong>Followers</strong></h4>
                        <div class = "col-xs-12 list-group topic-members-container">
                            <ul class = "list-group">
                                <?php foreach ($topic->followers as $follower): ?>
                                    <li class = "no-up-down-pad list-group-item">
                                        <img src = "<?php echo $follower->profile_url ? base_url($follower->profile_url) : base_url('images/default.jpg'); ?>" width = "30px" height = "30px" class = "img-circle pull-left" style = "margin-top: 5px; margin-right: 5px;">
                                        <h5 style = "display: inline-block;">
                                            <a class = "btn btn-link btn-sm no-padding no-margin ellipsis topic-member-name text1color" href = "<?php echo base_url('user/profile/' . $follower->user_id); ?>">
                                                <strong><?php echo $follower->first_name . " " . $follower->last_name ?></strong>
                                            </a>
                                        </h5>

                                        <?php if ($is_moderated || $follower->user_id === $logged_user->user_id): ?>
                                            <button value = "<?php echo $follower->user_id; ?>" class = "remove-follower-btn pull-right btn btn-danger btn-xs" style = "margin-top: 10px;">
                                                <i class = "fa fa-close"></i>
                                            </button>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class = "col-xs-12" style = "padding: 0px 10px;">
                            <button id = "topic-share-btn" class = "btn btn-primary btn-block buttonsbgcolor" value = "<?php echo $topic->topic_id ?>">Share Topic to Others!</button>
                        </div>
                    </div>
                </div>

                <!-- moderators -->
                
                    </div>
                </div>
            </div>
        </div>


<?php
include(APPPATH . "views/modals/share_modal.php");
include(APPPATH . "views/modals/invitation_modal.php");
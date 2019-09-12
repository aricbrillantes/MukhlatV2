<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Notification Modal -->
<div id="notif-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Notification Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Notifications</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row">
                    <div class = "col-md-12">
                        <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
                            <li class = "active"><a data-toggle="pill" href="#notifs-div"><strong>Notifications</strong></a></li>
                            <li><a data-toggle="pill" href="#shared-div"><strong>Shared Topics</strong></a></li>
                        </ul>
                    </div>
                    <div class = "col-md-12">
                        <div class="tab-content">
                            <div id="notifs-div" class="tab-pane fade in active">
                                <?php if (!empty($logged_user->notifications)): ?>
                                    <ul class = "list-group notif-modal-overflow">
                                        <?php foreach ($logged_user->notifications as $notif): ?> 
                                            <li class = "list-group-item" style = "text-align: left;">
                                                <img src = "<?php echo $notif->profile_url ? base_url($notif->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding no-margin pull-left img-circle notif-pic"/>
                                                <div class = "wrap"style = "margin-top: 6px; margin-bottom: 6px;">
                                                    <span class = "text-muted" style = "font-size: 12px;">
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('user/profile/' . $notif->doer_id); ?>"><strong><?php echo $notif->first_name . " " . $notif->last_name; ?></strong></a>
                                                        <?php if ($notif->notification_type_id === '1'): ?>
                                                            replied to your <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/thread/' . $notif->post->post_id); ?>">
                                                                <strong>post</strong>
                                                            </a> 
                                                            in <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $notif->post->topic->topic_id); ?>">
                                                                <strong>
                                                                    <?php echo utf8_decode($notif->post->topic->topic_name); ?>
                                                                </strong>
                                                            </a>
                                                        <?php elseif ($notif->notification_type_id === '2'): ?>
                                                            followed your topic <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $notif->topic->topic_id); ?>">
                                                                <strong><?php echo utf8_decode($notif->topic->topic_name); ?></strong>
                                                            </a>
                                                        <?php elseif ($notif->notification_type_id === '3'): ?>
                                                            upvoted your <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/thread/' . $notif->post->post_id); ?>">
                                                                <strong>post</strong>
                                                            </a> in 
                                                            <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $notif->post->topic->topic_id); ?>">
                                                                <strong><?php echo utf8_decode($notif->post->topic->topic_name); ?></strong>
                                                            </a>
                                                        <?php elseif ($notif->notification_type_id === '5'): ?>
                                                            <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/thread/' . $notif->post->post_id); ?>">
                                                                <strong>posted</strong></a> in 
                                                            <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $notif->post->topic->topic_id); ?>">
                                                                <strong><?php echo utf8_decode($notif->post->topic->topic_name); ?></strong>
                                                            </a>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                <?php else: ?>
                                    <div class = "content-container"><h4 class = "text-center text-warning">You don't have any notifications!</h4></div>
                                <?php endif; ?>
                            </div>
                            <div id="shared-div" class="tab-pane fade in">
                                <?php if (!empty($logged_user->shared_topics)): ?>
                                    <ul class = "list-group notif-modal-overflow">
                                        <?php foreach ($logged_user->shared_topics as $notif): ?> 
                                            <li class = "list-group-item" style = "height: 60px; text-align: left;">
                                                <img src = "<?php echo $notif->profile_url ? base_url($notif->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding no-margin pull-left img-circle notif-pic"/>
                                                <div class = "wrap"style = "margin-top: 6px; margin-bottom: 6px;">
                                                    <span class = "text-muted" style = "font-size: 12px;">
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('user/profile/' . $notif->doer_id);?>"><strong><?php echo $notif->first_name . " " . $notif->last_name ?></strong></a>
                                                        shared the topic 
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $notif->topic->topic_id); ?>"><strong><?php echo utf8_decode($notif->topic->topic_name); ?></strong></a> 
                                                        to you! Check it out!
                                                    </span>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class = "content-container"><h4 class = "text-center">You don't have any topic shares!</h4></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
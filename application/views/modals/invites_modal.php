<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Notification Modal -->
<div id="invites-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Notification Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Invites</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row">
                    <div class = "col-md-12">
                        <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
                            <li class = "active"><a data-toggle="pill" href="#requests-div"><strong>Moderator Requests</strong></a></li>
                            <li><a data-toggle="pill" href="#invites-div"><strong>Moderator Invites</strong></a></li>
                        </ul>
                    </div>
                    <div class = "col-md-12">
                        <div class="tab-content">
                            <div id="requests-div" class="tab-pane fade in active">
                                <?php if (!empty($logged_user->moderator_requests)): ?>
                                    <ul class = "list-group notif-modal-overflow">
                                        <?php foreach ($logged_user->moderator_requests as $request): ?>
                                            <li class = "list-group-item notif-item" value = "<?php echo $request->request_id ?>">
                                                <div class = "col-xs-1 no-padding no-margin">
                                                    <img src = "<?php echo $request->profile_url ? base_url($request->profile_url) : base_url("images/default.jpg"); ?>" class = "no-padding no-margin pull-left img-circle" width = "40px" height = "40px" style = "margin-right: 10px;"/>
                                                </div>
                                                <div class = "col-xs-9 wrap no-margin" style = "padding: 10px;">
                                                    <span class = "text-muted" style = "font-size: 12px;">
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('user/profile/' . $request->user_id); ?>">
                                                            <strong><?php echo $request->first_name . " " . $request->last_name ?></strong>
                                                        </a>
                                                        wants to apply as a moderator in 
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $request->topic_id); ?>">
                                                            <strong><?php echo utf8_decode($request->topic_name); ?></strong>
                                                        </a>
                                                        !
                                                    </span>
                                                </div>
                                                <div class = "col-xs-2 no-padding no-margin">
                                                    <button value = "<?php echo $request->request_id ?>" class = "request-accept btn btn-success btn-xs btn-block" style = "margin-bottom: 2px;"><i class = "fa fa-check"></i> Accept</button>
                                                    <button value = "<?php echo $request->request_id ?>" class = "request-decline btn btn-danger btn-xs btn-block"><i class = "fa fa-close"></i> Decline</button>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class = "content-container"><h4 class = "text-center text-warning">Your topics don't have any moderator requests!</h4></div>
                                <?php endif; ?>
                            </div>

                            <div id="invites-div" class="tab-pane fade in">
                                <?php if (!empty($logged_user->moderator_invites)): ?>
                                    <ul class = "list-group notif-modal-overflow">
                                        <?php foreach ($logged_user->moderator_invites as $invite): ?> 
                                            <li class = "list-group-item notif-item" value = "<?php echo $invite->invite_id ?>">
                                                <div class = "col-xs-1 no-padding no-margin">
                                                    <img src = "<?php echo $invite->profile_url ? base_url($invite->profile_url) : base_url("images/default.jpg"); ?>" class = "no-padding no-margin pull-left img-circle" width = "40px" height = "40px" style = "margin-right: 10px;"/>
                                                </div>
                                                <div class = "col-xs-9 wrap no-margin" style = "padding: 10px;">
                                                    <span class = "text-muted" style = "font-size: 12px;">
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('user/profile/' . $invite->user_id); ?>"><strong><?php echo $invite->first_name . " " . $invite->last_name ?></strong></a>
                                                        invited you to be a moderator of the topic 
                                                        <a class = "btn btn-link no-padding no-margin notif-btn" href = "<?php echo base_url('topic/view/' . $invite->topic_id); ?>"><strong><?php echo utf8_decode($invite->topic_name); ?></strong></a> 
                                                    </span>
                                                </div>
                                                <div class = "col-xs-2 no-padding no-margin">
                                                    <button value = "<?php echo $invite->invite_id ?>" class = "invite-accept btn btn-success btn-xs btn-block" style = "margin-bottom: 2px;"><i class = "fa fa-check"></i> Accept</button>
                                                    <button value = "<?php echo $invite->invite_id ?>" class = "invite-decline btn btn-danger btn-xs btn-block"><i class = "fa fa-close"></i> Decline</button>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class = "content-container"><h4 class = "text-center">You don't have any invites to be a moderator!</h4></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
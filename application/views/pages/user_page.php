<?php
include(APPPATH . 'views/header.php');
?>
<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
    $logged_user = $_SESSION['logged_user'];
    ?>
   
    <div class = "container page">
        <div class = "row">
            <div class = "col-md-12 content-container" style = "padding-top: 20px;">
                <div class = "col-md-6">
                    <!-- User Info -->
                    <div class = "col-md-12" style = "height: 160px;">
                        <div class = "user-profile-info">
                            <div class = "col-xs-3 no-padding" style = "margin-top: 20px;">
                                <img class = "pull-left img-circle user-profile-img" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>" width = "100px" height = "100px"/>
                            </div>
                            <div class = "col-xs-6 no-padding no-margin">
                                <p class = "no-padding text-info" style = "margin-bottom: 0px;margin-top: 20px;"><strong><?php echo $user->first_name . " " . $user->last_name ?></strong></p>
                                <small class = "no-padding no-margin"><?php echo $user->email ?></small>
                                <p class = "wrap text-muted" style = "font-size: 12px;"><i><?php echo $user->description ? $user->description : 'Hello World!'; ?></i></p>
                                <?php //feature unavailable - hide buttons 
                                //echo '<button class = "btn btn-success btn-sm"><i class = "fa fa-phone"></i></button>
                                //<button class = "btn btn-success btn-sm"><i class = "fa fa-comment"></i></button>' ?>
                            </div>
                            <?php if ($logged_user->user_id === $user->user_id): ?>
                                <div class = "col-xs-2 no-padding" style = "margin-top: 20px;">
                                    <a class = "pull-right btn btn-gray btn-sm" href = "#edit-profile-modal" data-toggle = "modal"><i class = "fa fa-pencil"></i> Edit Profile</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- User Topics -->
                    <div class = "col-md-12 user-topic-container">
                        <h3 class = "text-info text-center user-topic-header modalbg" style="margin-bottom: 2px;"><strong class="textoutliner">Topics of <?php echo $user->first_name ?></strong></h3>
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a data-toggle="pill" href="#user-topic-created">Created Topics</a></li>
                            <li><a data-toggle="pill" href="#user-topic-followed">Followed Topics</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div id="user-topic-created" class="tab-pane fade in active">
                                <div class = "col-sm-12 no-padding">
                                    <div class = "user-header">
                                        <h4 class = "text-center"><strong>Topics Created by <?php echo $user->first_name; ?></strong></h4>
                                    </div>
                                    <div class = "user-topic-div">
                                        <ul class="nav">
                                            <?php foreach ($user->topics as $topic): ?>
                                                <li>
                                                    <a class = "user-topic-item" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style = "padding: 5px 30px;">
                                                        <h4 class = "no-padding no-margin text1color" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                        <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="user-topic-followed" class="tab-pane fade">
                                <div class = "col-sm-12 no-padding">
                                    <div class = "user-header">
                                        <h4 class = "text-center"><strong>Topics Followed by <?php echo $user->first_name; ?></strong></h4>
                                    </div>
                                    <div class = "user-topic-div">
                                        <ul class="nav">
                                            <?php foreach ($user->followed_topics as $topic): ?>
                                                <li>
                                                    <a class = "user-topic-item" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style = "padding: 5px 30px;">
                                                        <h4 class = "no-padding no-margin text1color" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                        <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col-md-6">
                    <!-- User Stats -->
                    <div class = "col-md-12" style = "padding: 40px 30px; height: 160px;">
                        <div class = "col-sm-4 no-left-right-pad">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo count($user->topics); ?></strong></h2>
                                <p>Topics</p>
                            </div>
                        </div>
                        <div class = "col-sm-4 no-left-right-pad"style = "border-right: 1px solid #E0E0E0; border-left: 1px solid #E0E0E0;">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo $user->vote_points; ?></strong></h2>
                                <p>Points</p>
                            </div>
                        </div>
                        <div class = "col-sm-4 no-left-right-pad">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo $user->post_count; ?></strong></h2>
                                <p>Posts</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Activities -->
                    <div class = "col-md-12 user-topic-container">
                        <h3 class = "text-info text-center user-activities-header modalbg"><strong class="textoutliner">Activities of <?php echo $user->first_name; ?></strong></h3>
                        <div class = "col-sm-12 user-activities-div">
                            <!-- POST PREVIEW -->
                            <?php foreach ($user->activities as $post): ?> 
                                <div class = "col-xs-12 no-padding post-container" style = "margin-bottom: 10px;">
                                    <div class = "user-post-heading no-margin">
                                        <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                            <strong style = "font-size: 21px"><?php echo $post->first_name . " " . $post->last_name; ?></strong>
                                        </a> 
                                        <?php if (empty($post->parent)): ?>
                                            <span>posted in</span> 
                                        <?php else: ?>
                                            <span>commented in</span> 
                                        <?php endif; ?>
                                        <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                            <strong style = "font-size: 22px"><?php echo utf8_decode($post->topic_name); ?></strong>
                                        </a>
                                        <?php if (!empty($post->parent)): ?>
                                            <span class = "text-muted" style = "font-size: 18px;">( <i class = "fa fa-reply"></i> <i>in reply to <a class = "btn btn-link btn-xs no-padding no-margin text1color" href = "<?php echo base_url('user/profile/' . $post->parent->user->user_id); ?>"><?php echo $post->parent->user->first_name . " " . $post->parent->user->last_name; ?></a> )</i></span>
                                        <?php endif; ?>
                                        :
                                    </div>
                                    <div class = "col-xs-12 user-post-content no-padding">
                                        <div class = "col-xs-2 text-center no-padding" style = "padding-left: 10px;">
                                            <img width = "60px" height = "60px" class = "img-circle" style = "margin: 10px 5px;" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                        </div>
                                        <div class = "col-xs-10 no-padding" style = "margin-top: 5px;">
                                            <?php if (!empty($post->post_title)): ?>
                                                <!--<h5 class = "no-padding no-margin text-muted wrap"><strong style = "font-size: 21px"><?php echo utf8_decode($post->post_title); ?></strong></h5>-->
                                                <i class = "text-muted">
                                                    <small>
                                                        <a class = "btn btn-link btn-xs no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                            <?php echo $post->first_name . " " . $post->last_name ?>
                                                        </a>
                                                    </small>
                                                </i>
                                            <?php else: ?>
                                            <strong style = "font-size: 21px" class="text1color"><?php echo $post->first_name . " " . $post->last_name; ?></strong>

                                            <?php endif; ?>
                                            <span class = "text-muted pull-right"> <i style = "font-size: 18px;padding-right: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                            <p class = "home-content-body" style = "border-right: none;white-space: pre-wrap;"><?php echo utf8_decode($post->post_content); ?></p>

                                        </div>
                                    </div>
                                    <div class = "user-post-footer no-margin text-right">
                                        <a class = "btn btn-user-post-footer no-up-down-pad" href = "<?php echo base_url('topic/thread/' . $post->root_id); ?>">View Post <i class = "fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>
    <?php
  //  include(APPPATH . 'views/chat/chat.php');
    include(APPPATH . 'views/side_navbar.php');
    include(APPPATH . 'views/modals/edit_profile_modal.php');
    
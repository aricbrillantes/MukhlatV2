<?php
include(APPPATH . 'views/header.php');
$c_topic = $_SESSION['current_topic'];
?>
<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
    ?>

    <div id = "topic-page" class = "container page" style = "min-height: 100%; height: 100%;">
        <!-- Topic Page Header -->
        <div class = "row">
            <div id = "topic-heading" class = "col-md-12 content-container no-padding">
                <a class = "btn btn-topic-header" href="<?php echo base_url('topic'); ?>">
                    <h4 class = "pull-left topic-header-title no-padding" style = "margin-top: 3px; margin-bottom: 0px;">
                        <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                            Change Topic
                        </strong>
                    </h4>
                </a>
                <?php if (!$is_followed): ?>
                    <button id = "topic-follow-btn" class = "btn btn-md pull-right btn-primary" style = "margin: 5px; margin-right: 20px; width: 20%" value = "<?php echo $c_topic->topic_id ?>">
                        <i class = "fa fa-plus-circle"></i> Follow Topic
                    <?php else: ?>
                        <button id = "topic-follow-btn" class = "btn btn-md pull-right btn-danger" style = "margin: 5px; margin-right: 20px; width: 20%" value = "<?php echo $c_topic->topic_id ?>">
                            <i class = "fa fa-minus-circle"></i> Unfollow Topic
                        <?php endif; ?>
                    </button>
                    <a class = "btn btn-success pull-right btn-md" style = "margin: 5px; width: 20%" href = "#topic-members-modal" data-toggle = "modal">
                        <i class = "fa fa-user"></i> Members
                    </a>
            </div>
        </div>
        <div class = "row">
            <!-- Topic Page Content -->
            <div class = "col-md-12 content-container">
                <!-- Topic Post Preview -->
                <div class = "col-sm-6">
                    <div class = "col-sm-12 topic-description-div no-padding">
                        <h4 class = "no-margin text-center user-topic-header topic-intro-header">
                            <strong><?php echo utf8_decode($c_topic->topic_name); ?></strong>
                            
                            <?php if ($is_moderated): ?>
                            <br>
                            <button id = "edit-topic-btn" class = "btn btn-default btn-xs"><i class = "fa fa-pencil"></i> Edit Description</button>

                            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                                <button type = "button" id = "cancel-topic-btn" class = "btn btn-xs btn-danger" style = "margin-left: 5px;"><i class = "fa fa-trash"></i> Cancel Topic</button>
                            <?php endif; 
                            endif;?>
                        </h4>
                        <div class = "content-container topic-intro-content">
                            <p id = "desc-creator" class = "no-margin text-muted" align = "center">
                                <small><i>by <a class = "btn btn-link btn-xs no-padding no-margin" href = "<?php echo base_url('user/profile/' . $c_topic->user->user_id); ?>"><?php echo $c_topic->user->first_name . " " . $c_topic->user->last_name; ?></a></i></small>
                            </p>
                            <?php if ($is_moderated): ?>
                                <div id = "desc-edit" class = "col-md-12 hidden">
                                    <div class = "form-group" style = "margin-bottom: 5px;">
                                        <textarea id = "edit-topic-text" maxlength = "256" class = "form-control"><?php echo $c_topic->topic_description ?></textarea>
                                    </div>
                                    <div class = "form-group pull-right" style = "margin-top: 0px;">
                                        <button value = "<?php echo $c_topic->topic_id ?>" id = "edit-topic-save" class = "btn btn-primary btn-sm">Save</button>
                                        <button id = "edit-topic-cancel" type = "button" class = "btn btn-gray btn-sm">Cancel</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <p id = "desc-container" class = "no-margin wrap text-center">
                                <?php echo utf8_decode($c_topic->topic_description); ?>
                            </p>
                        </div>
                    </div>
                    <div id = "preview-div" class = "col-sm-12 well topic-preview-div">
                        <div id = "no-preview"class = "topic-no-preview text-center">
                            <span><h3>Click a post to preview</h3></span>
                        </div>
                    </div>
                </div>
                <!-- Topic Post List -->
                <div class = "col-sm-6 topic-preview-div">
                    <div class = "col-xs-12">
                        <button class = "btn btn-primary btn-block" href="#create-post-modal" data-toggle = "modal">Post to <?php echo utf8_decode($c_topic->topic_name); ?></button>
                    </div>
                    <div class = "col-xs-12 topic-post-list">
                        <div class = "list-group" style = "padding-top: 15px;">
                            <!-- List Entry -->
                            <?php
                            foreach ($c_topic->posts as $post):
                                $text_class = '';
                                if ($post->vote_count > 0) {
                                    $text_class = 'text-success';
                                } else if ($post->vote_count < 0) {
                                    $text_class = 'text-danger';
                                }
                                ?>
                                <a href = "javascript: void(0);" class = "btn btn-link list-group-item list-entry no-up-down-pad topic-post-entry" data-value = "<?php echo $post->post_id; ?>">
                                    <div class = "row">
                                        <div class = "col-xs-10">
                                            <h4 class = "ellipsis"><strong><?php echo utf8_decode($post->post_title); ?></strong> <small><i><?php echo $post->user->first_name . " " . $post->user->last_name; ?></i></small></h4>
                                            <p class = "ellipsis"><?php echo utf8_decode($post->post_content); ?></p>
                                        </div>
                                        <div class = "col-xs-2 text-center" style = "padding: 0px;">
                                            <p style = "padding-top: 10px; font-size: 11px;"><i><?php echo date("M-d-y", strtotime($post->date_posted)); ?></i></p>
                                            <span class = "vote-count <?php echo $text_class ?>"><?php echo $post->vote_count ? $post->vote_count : '0'; ?> <i class = "fa fa-trophy"></i></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include(APPPATH . 'views/modals/create_post_modal.php');
    include(APPPATH . 'views/modals/topic_members_modal.php');
    include(APPPATH . 'views/modals/cancel_topic_modal.php');
 //   include(APPPATH . 'views/chat/chat.php');
    
<?php
include(APPPATH . 'views/header.php');
$topic = $post->topic;
$user = $post->user;
?>
<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
    ?>

    <div id = "thread-page" class = "container page">
        <div class = "row">
            <div class = "col-md-12 content-container no-padding" style = "height: 100%;">
                <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px;" href="<?php echo base_url('topic/view/' . $topic->topic_id) ?>">
                    <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                        <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                            Back
                        </strong>
                    </h3>
                </a>
                <h3 class = "wrap post-header-title"><strong><?php echo utf8_decode($post->topic->topic_name); ?>: </strong> 
                    <small>
                        <i>Thread by 
                            <a class = "btn btn-link btn-md no-padding no-margin" href = "<?php echo base_url("user/profile/" . $user->user_id); ?>" style = "margin-bottom: 5px;">
                                <?php echo $user->first_name; ?></a>
                        </i>
                    </small>
                </h3>
                <?php if (!empty($post->thread_attachments)): ?>
                    <button value = "<?php echo $post->post_id ?>" id = "thread-attachment-btn" class = "pull-right btn btn-primary">
                        <strong><i class = "fa fa-paperclip" style = "font-size: 16px;"></i> View Thread Attachments</strong>
                    </button>
                <?php endif; ?>
            </div>
            <div class = "col-md-12 content-container">
                <!-- POST -->
                <div class = "col-md-12">
                    <div class="media">
                        <div class="media-left text-center">
                            <?php if (!$post->is_deleted): ?>
                                <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>" class="media-object img-circle post-pic"/>
                                <button class = "upvote-btn btn btn-link btn-xs" style = "margin-left: 3px;" value = "<?php echo $post->post_id; ?>">
                                    <span class = "<?php echo $post->vote_type === '1' ? 'upvote-text' : '' ?> fa fa-chevron-up vote-text"></span>
                                </button>
                                <br/>
                                <span class = "vote-count text-muted" style = "margin-left: 3px;"><?php echo $post->vote_count ? $post->vote_count : '0'; ?></span>
                                <br/>
                                <button class = "downvote-btn btn btn-link btn-xs" value = "<?php echo $post->post_id; ?>">
                                    <span class = "<?php echo $post->vote_type === '-1' ? 'downvote-text' : '' ?> fa fa-chevron-down vote-text"></span>
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="media-body">
                            <?php if (!$post->is_deleted): ?>
                                <?php if ($user->user_id === $logged_user->user_id || $is_moderated): ?>
                                    <!-- Delete Button -->
                                    <button value = "<?php echo $post->post_id ?>" class = "delete-btn pull-right btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                <?php endif; ?>

                                <!-- Reply Button -->
                                <button class = "reply-btn pull-right btn btn-sm btn-gray" style = "margin-right: 5px;" value = "<?php echo $post->post_id; ?>"><i class = "fa fa-reply"></i></button>

                                <?php if ($user->user_id === $logged_user->user_id): ?>
                                    <!-- Edit Button -->
                                    <button value = "<?php echo $post->post_id ?>" class = "edit-btn pull-right btn btn-sm btn-gray" style = "margin-right: 5px;"><i class = "fa fa-pencil"></i></button>
                                <?php endif; ?>

                                <!-- Post Heading -->
                                <div class="media-heading">
                                    <?php if ($post->post_title): ?>
                                    <h4 class = "no-padding no-margin text-muted"><strong><?php echo utf8_decode($post->post_title); ?></strong></h4>
                                        <small>
                                            <i>by <a class = "btn btn-link btn-xs no-padding no-margin"  href = "<?php echo base_url("user/profile/" . $user->user_id); ?>"><?php echo $user->first_name . " " . $user->last_name ?></a></i>
                                            <span class = "text-muted"><i style = "font-size: 11px;"><?php echo date("M-d-y", strtotime($post->date_posted)); ?></i></span>
                                        </small>
                                    <?php else: ?>
                                        <a class = "btn btn-link no-padding btn-lg" href = "<?php echo base_url('user/profile/' . $user->user_id); ?>"><strong><?php echo $user->first_name . " " . $user->last_name; ?></strong></a>
                                        <br><span class = "text-muted"><i style = "font-size: 11px;"><?php echo date("M-d-y", strtotime($post->date_posted)); ?></i></span>
                                    <?php endif; ?>
                                </div>
                                <!-- Attachment -->
                                <?php if (!empty($post->attachments)): ?>
                                    <?php
                                    foreach ($post->attachments as $attachment):
                                        if ($attachment->attachment_type_id === '1'):
                                            ?>
                                            <img src = "<?= base_url($attachment->file_url); ?>" width = "300px"/>
                                        <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                            <audio src = "<?= base_url($attachment->file_url); ?>" controls></audio>
                                        <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                            <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>
                                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                            <?php
                                        endif;
                                    endforeach;
                                    if ($attachment->attachment_type_id !== '4'):
                                        ?>
                                        <p><i class = "text-muted bg-info"><?= utf8_decode($attachment->caption); ?></i></p>
                                    <?php
                                    endif;
                                endif;
                                ?>
                                <p class = "post-content" style = "margin-top: 15px;"><?php echo utf8_decode($post->post_content) ?></p>
<?php else: ?>
                                <div class="media-heading">
                                    <h4 class = "no-padding no-margin text-danger">Deleted Post</h4>
                                </div>
                                <p class = "post-content" style = "margin-top: 15px"><i>This post has been deleted.</i></p>
<?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- COMMENTS -->
                <div class = "col-md-12 reply-header">
                    Replies:
                </div>
                <div class = "col-md-12 content-container reply-container">
                    <?php
                    if (!empty($replies)):
                        echo $replies;
                    else:
                        ?>
                        <h4 class = "text-center text-warning no-padding no-margin"><strong>This post has no replies yet!</strong></h4>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url("/js/post.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>

    <?php
//    include(APPPATH . 'views/chat/chat.php');
    include(APPPATH . 'views/modals/create_reply_modal.php');
    include(APPPATH . 'views/modals/edit_post_modal.php');
    include(APPPATH . 'views/modals/delete_post_modal.php');
    
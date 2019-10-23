<?php
$logged_user = $_SESSION['logged_user'];
    
?>
    
<!-- Sidebar -->
<div style = "margin-left: 3.5%;float: right;right: 1%;position: fixed;top:9%;">
    <!--<div class = "home-sidebar content-container" style="background:darkgray;">-->
        <!--Header-->

                        <!-- Topic Post List -->
                    
                    <div class = "col-xs-12 col-md-4 pull-right topic-post-list">
                        <div class = "list-group" style = "padding-top: 15px;">
                             <!--List Entry--> 
                            <?php
                            foreach ($c_topic->posts as $post):
                                $text_class = '';
                                if ($post->vote_count > 0) {
                                    $text_class = 'text-success';
                                } else if ($post->vote_count < 0) {
                                    $text_class = 'text-danger';
                                }
                                ?>
                                <!--<a href = "javascript: void(0);" class = "btn btn-link list-group-item list-entry no-up-down-pad topic-post-entry" data-value = "<?php echo $post->post_id; ?>">-->
                        <div>
                            

                                <div class = "row">
                                    <div class = "col-xs-9">
                                        <h4 class = "ellipsis"><strong><?php echo utf8_decode($post->post_title); ?></strong> <small><i><?php echo $post->user->first_name . " " . $post->user->last_name; ?></i></small></h4>
                                        <p class = "ellipsis" style="white-space: pre-wrap;"><?php echo utf8_decode($post->post_content); ?></p>
                                    </div>
                                    <div class = "col-xs-3 text-center" style = "padding: 0px;">
                                        <p style = "padding-top: 10px; font-size: 18px !important;color: #78909C;"><i><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></p>
                                    </div>
                                </div>

                                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);

                                                // print_r($attachments);

                                                foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <img src = "<?= base_url($attachment->file_url); ?>"/>

                                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                        <audio src = "<?= base_url($attachment->file_url); ?>" controls></audio>

                                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>

                                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                        <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>

                                                <?php 

                                                    endif;
                                                endforeach;

                                                ?> 
                        </div>
<!--                                </a>-->
                            <?php endforeach; ?>
                        </div>
                    </div>
                        <div>
                            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                        <button onmouseenter="playclip()" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px">Say something</button>
                    <?php endif;?>
                        </div>
    
</div>

<!-- SCRIPTS -->
<!-- END SCRIPTS -->
<!-- End Sidebar -->
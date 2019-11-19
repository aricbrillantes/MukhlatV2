<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Play Modal -->
<head>

</head>

<div id="room_media_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <!-- Play Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <h4 class="modal-title text-center textoutliner"><strong>My Stuff</strong></h4>
                <?php else: ?>
                <h4 class="modal-title text-center textoutliner"><strong><?php echo utf8_decode($c_topic->user->first_name); ?>'s Stuff</strong></h4>
                <?php endif; ?>
            </div>
            
            <div class="modal-body content-container container-fluid">
                <div class = "row col-md-12">
                         <?php
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <div class="col-md-3 <?php echo $theme?> polaroiditem polaroid homepostsborder" style="margin-right:1%;margin-bottom:1%">
                                                            <div class="whitebg">
                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>
                                                            <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                            <hr>
                                                            <div class=" polaroidwrapper">
                                                                <p><?php echo utf8_decode($post->post_content); ?></p>
                                                                <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />
                                                            </div>
                                                            </div>
                                                        </div>
                                                <?php elseif ($attachment->attachment_type_id === '2'):?>
                                                        <div class="col-md-3 <?php echo $theme?> polaroiditem polaroid homepostsborder" style="margin-right:1%;margin-bottom:1%">
                                                            <div class="whitebg">
                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>
                                                            <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                            <hr>
                                                            <div class=" polaroidwrapper">
                                                                <p><?php echo utf8_decode($post->post_content); ?></p>
                                                                <audio src = "<?= base_url($attachment->file_url); ?>" controls></audio>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php elseif ($attachment->attachment_type_id === '3'):?>
                                                        <div class="col-md-3 <?php echo $theme?> polaroiditem polaroid homepostsborder" style="margin-right:1%;margin-bottom:1%">
                                                            <div class="whitebg">
                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>
                                                            <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                            <hr>
                                                            <div class=" polaroidwrapper">
                                                                <p><?php echo utf8_decode($post->post_content); ?></p>
                                                                <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>
                                                            </div>
                                                            </div>
                                                        </div>
                    
                    
                                                <?php 

                                                    endif;
                                                endforeach;

                                                ?>
                        
                        <?php endif; endforeach; ?>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
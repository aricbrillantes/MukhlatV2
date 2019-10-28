<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Play Modal -->
<head>

</head>

<div id="room_videos_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:800px;">
        <!-- Play Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong><i class="fa fa-gamepad"></i> Videos</strong></h4>
            </div>
            
            <div class="modal-body">
                <div class = "row col-md-12"><center>
                         <?php
                            foreach ($c_topic->posts as $post):
                                ?>
                        <div class="col-md-3">
                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '3'):?>
                                                        <p><?php echo utf8_decode($post->post_content); ?></p>
                                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>

                                                <?php 

                                                    endif;
                                                endforeach;

                                                ?>
                        </div>
                        <?php endforeach; ?>
                    
                    
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
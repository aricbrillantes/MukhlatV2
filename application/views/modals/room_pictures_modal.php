<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Play Modal -->
<head>

</head>

<div id="room_pictures_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:800px;">
        <!-- Play Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong><i class="fa fa-gamepad"></i> Pictures</strong></h4>
            </div>
            
            <div class="modal-body">
                <div class = "row col-md-12">
                         <?php
                            foreach ($c_topic->posts as $post):
                                ?>
                        <div class="col-md-3">
                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <p><?php echo utf8_decode($post->post_content); ?></p>
                                                        <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />

                                                <?php 

                                                    endif;
                                                endforeach;

                                                ?>
                        </div>
                        <?php endforeach; ?>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
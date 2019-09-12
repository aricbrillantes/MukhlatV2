<div id = "attachment-modal-container">
    <div id="attachment-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Attachment Modal Content-->
            <div class="modal-content">
                <div class="modal-header modal-heading">
                    <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                    <h4 class="text-center modal-title">Attachments</h4>
                </div>
                <div class="modal-body">
                    <div id = "attachment-content">
                        <div class = "list-group">
                            <?php
                            foreach ($attachments as $attachment):
                                if ($attachment->attachment_type_id === '1'):
                                    ?>
                                    <button value = "<?php echo $attachment->attachment_id; ?>" class = "image-attach-view list-group-item">
                                        <i class = "fa fa-file-image-o"></i> <?= $attachment->caption === '' ? 'Untitled Image' : utf8_decode($attachment->caption); ?>
                                    </button>
                                <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                    <button value = "<?php echo $attachment->attachment_id; ?>" class = "audio-attach-view list-group-item">
                                        <i class = "fa fa-file-audio-o"></i> <?= $attachment->caption === '' ? 'Untitled Audio' : utf8_decode($attachment->caption); ?>
                                    </button>
                                <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                    <button value = "<?php echo $attachment->attachment_id; ?>" class = "video-attach-view list-group-item">
                                        <i class = "fa fa-file-video-o"></i> <?= $attachment->caption === '' ? 'Untitled Video' : utf8_decode($attachment->caption); ?>
                                    </button>
                                <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                    <a class = "list-group-item" href = "<?php echo base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> 
                                    <?= $attachment->caption === '' ? 'Untitled File' : utf8_decode($attachment->caption); ?></a>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--IMAGE-->
    <div id="image-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header modal-heading">
                    <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                    <h4 id = "send-reply-user" class="modal-title"><strong>Photo</strong></h4>
                </div>
                <div class="modal-body image-display-container">
                    <img id = "image-attachment" class = "image-attach-display" src = "<?php echo base_url('test/8e67eeec2b76c1425bf1639f3439e7ed.jpg'); ?>"/>
                </div>
            </div>
        </div>
    </div>

    <!--AUDIO-->
    <div id="audio-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header modal-heading">
                    <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                    <h4 id = "send-reply-user" class="modal-title"><strong>Audio</strong></h4>
                </div>
                <div class="modal-body">
                    <audio id = "audio-attachment" controls>
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <!--VIDEO-->
    <div id="video-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header modal-heading">
                    <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                    <h4 id = "send-reply-user" class="modal-title"><strong>Video</strong></h4>
                </div>
                <div class="modal-body">
                    <video id = "video-attachment" controls>
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
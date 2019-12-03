<div id="child-activity-modal-parents" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <!-- Play Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <h4 class="modal-title text-center textoutliner"><strong><?php echo $child->first_name; ?>'s Pictures</strong></h4>
            </div>

            <div class="modal-body content-container container-fluid tab-content">
                <ul class="nav nav-pills nav-justified">
                    <!-- <li class=" "><a data-toggle="modal" href="#child-activity-modal-parents">Activity</a></li> -->
                    <li class="active"><a data-toggle="pill" href="#pictures">Pictures</a></li>
                    <li class=""><a data-toggle="pill" href="#sounds">Audio</a></li>
                    <li class=""><a data-toggle="pill" href="#videos">Videos</a></li>
                </ul>
                <br>
                <div class="tab-content">
                        
                    <div id="pictures" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; height:290px; overflow-x: hidden; overflow-y: scroll">
                        <?php foreach ($activities as $post): ?> 
                
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                            <?php foreach ($attachments as $attachment):?>
                           
                                <div class = "col-xs-10 no-padding" style = "">
                                    <?php if ($attachment->attachment_type_id === '1'):?>
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                        <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 150px; max-width: 250px;" />
                                            

                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio> -->
                                        

                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video> -->
                                    

                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a> -->
                                    
                                    <?php endif; ?>

                                </div>
                                
                            <?php endforeach; ?>

                        <?php endforeach; ?>
                    </div>

                    
                    <div id="sounds" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px; height:290px; overflow-x: hidden; overflow-y: scroll">
                        <?php foreach ($activities as $post): ?> 
                
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                            <?php foreach ($attachments as $attachment):?>
                           
                                <div class = "col-xs-10 no-padding" style = "">
                                    <?php if ($attachment->attachment_type_id === '1'):?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 150px; max-width: 250px;" /> -->
                                            

                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                        <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                        

                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video> -->
                                    

                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a> -->
                                    
                                    <?php endif; ?>

                                </div>
                                
                            <?php endforeach; ?>

                        <?php endforeach; ?>
                    </div>

                    
                    <div id="videos" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px; height:290px; overflow-x: hidden; overflow-y: scroll">
                        <?php foreach ($activities as $post): ?> 
                
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                            <?php foreach ($attachments as $attachment):?>
                           
                                <div class = "col-xs-10 no-padding" style = "">
                                    <?php if ($attachment->attachment_type_id === '1'):?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 150px; max-width: 250px;" /> -->
                                            

                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio> -->
                                        

                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video>
                                    

                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                        <!-- <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span> -->
                                        <!-- <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a> -->
                                    
                                    <?php endif; ?>

                                </div>
                                
                            <?php endforeach; ?>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
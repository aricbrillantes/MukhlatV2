<?php
$topic = $_SESSION['current_topic'];
?>
<!-- Create Post Modal -->
<div id="edit-post-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" id="close-edit-post" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Edit your post in <?php echo utf8_decode($topic->topic_name); ?></strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/edit_post'); ?>" id = "edit-post-form" method = "POST">
                <div class="col-md-12 modal-body">
                    <div class="form-group"><!-- check if title is already taken -->
                        <label for = "title">Enter a title for your post:</label>
                        <input type="text" required maxlength = "100" class="form-control" name = "post_title" id = "post-title" placeholder = "Title of your Post"/>
                    </div>
                    <div class="form-group"><!-- check if description exceeds n words-->
                        <label for = "content">Enter the content of your post:</label>
                        <textarea class = "form-control" required name = "post_content" maxlength = "16000" id = "post-content" placeholder = "Tell something in your post!"></textarea>
                    </div>
                    <div id = "edit-attachment-buttons" class = "form-group">
                        Attach a file:
                        <!--IMAGE-->
                        <label id = "edit-img-label" class="btn btn-primary">
                            <input id = "edit-attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;">
                            <p id = "edit-image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Image</p>
                        </label>

                        <!--AUDIO-->
                        <label id = "edit-audio-label" class="btn btn-primary">
                            <input id = "edit-attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;">
                            <p id = "edit-audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Audio</p>
                        </label>

                        <!--VIDEO-->
                        <label id = "edit-video-label" class="btn btn-primary">
                            <input id = "edit-attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;">
                            <p id = "edit-video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        <!--FILE-->
                        <label id = "edit-file-label" class="btn btn-primary">
                            <input id = "edit-attach-file" type="file" name = "post_file" style = "display: none;">
                            <p id = "edit-file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label>
                    </div>
                    <div id = "edit-attachment-preview" class = "content-container">
                        <h5 id = "edit-attachment-message" class = "text-warning text-center">No attachment yet.</h5>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "edit-post-btn" class ="btn btn-primary" data-toggle = "modal">Save Changes</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="post-edit-confirm" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Save changes to your post in topic?</strong></h4>
            </div>
            <div class="modal-body">
                <button id = "edit-post-proceed" type = "submit" class = "btn btn-success">Proceed</button>
                <button class = "btn btn-Danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
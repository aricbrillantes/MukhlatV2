<?php
    $topic = $_SESSION['current_topic'];
?>
<!-- Create Post Modal -->
<div id="create-reply-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create reply Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "reply-user" class="modal-title"></h4>
            </div>
            <form enctype = "multipart/form-data" id = "create-reply-form" action = "<?php echo base_url('topic/reply');?>" method = "POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for = "title">Enter a title for your reply (Optional):</label>
                        <input type="text" class="form-control" maxlength = "100" name = "reply_title" id = "reply-title" placeholder = "Title of your post"/>
                    </div>
                    <div class="form-group"><!-- check if description exceeds n words-->
                        <label for = "content">Enter the content of your reply:</label>
                        <textarea class = "form-control" maxlength = "16000" required name = "reply_content" id = "reply-content" placeholder = "Tell something in your post!"></textarea>
                    </div>
                    <div id = "attachment-buttons" class = "form-group">
                        Attach a file:
                        <!--IMAGE-->
                        <label id = "img-label" class="btn btn-primary">
                            <input id = "attach-img" accept = "image/*" type="file" name = "reply_image" style = "display: none;">
                            <p id = "image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Image</p>
                        </label>

                        <!--AUDIO-->
                        <label id = "audio-label" class="btn btn-primary">
                            <input id = "attach-audio" accept = "audio/*" type="file" name = "reply_audio" style = "display: none;">
                            <p id = "audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Audio</p>
                        </label>

                        <!--VIDEO-->
                        <label id = "video-label" class="btn btn-primary">
                            <input id = "attach-video" accept = "video/*" type="file" name = "reply_video" style = "display: none;">
                            <p id = "video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        <!--FILE-->
                        <label id = "file-label" class="btn btn-primary">
                            <input id = "attach-file" type="file" name = "reply_file" style = "display: none;">
                            <p id = "file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label>
                    </div>
                    <div id = "attachment-preview" class = "content-container">
                        <h5 id = "attachment-message" class = "text-warning text-center">No attachment yet.</h5>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "create-reply-btn" class ="btn btn-primary" data-toggle = "modal">Reply</a>
                </div>
            </form>
        </div>
    </div>
</div>

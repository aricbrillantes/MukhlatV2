<?php
$topic = $_SESSION['current_topic'];
?>
<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">
<!-- Create Post Modal -->
<div id="edit-post-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" id="close-edit-post" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Edit your post in <?php echo utf8_decode($topic->topic_name); ?></strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/edit_post'); ?>" id = "edit-post-form" method = "POST">
                <div class="col-md-12 modal-body">
                    <div class="form-group"><!-- check if title is already taken -->
                        <div style="display: none">
                        <label for = "title">Enter a title for your post:</label>
                        <p class="lead emoji-picker-container">
                        <input type="text" required maxlength = "100" class="form-control" name = "post_title" id = "post-title" placeholder = "Title of your Post" data-emojiable="true"/>
                        </p>
                    </div>
                    </div>
                    <div class="form-group"><!-- check if description exceeds n words-->
                        <label for = "content">Enter the content of your post:</label>
                        <p class="lead emoji-picker-container">
                        <textarea class = "form-control" style="height: 100px;" required name = "post_content" maxlength = "16000" id = "post-content" placeholder = "Tell something in your post!" data-emojiable="true"></textarea>
                        </p>
                    </div>
                    <div id = "edit-attachment-buttons" class = "form-group">
                        Attach a file:
                        <!--IMAGE-->
                        <label id = "edit-img-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "edit-attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;">
                            <p id = "edit-image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Image</p>
                        </label>

                        <!--AUDIO-->
                        <label id = "edit-audio-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "edit-attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;">
                            <p id = "edit-audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Audio</p>
                        </label>

                        <!--VIDEO-->
                        <label id = "edit-video-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "edit-attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;">
                            <p id = "edit-video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        <!--FILE-->
                        <label id = "edit-file-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "edit-attach-file" type="file" name = "post_file" style = "display: none;">
                            <p id = "edit-file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label>
                    </div>
                    <div id = "edit-attachment-preview" class = "content-container">
                        <h5 id = "edit-attachment-message" class = "text-warning text-center">No attachment yet.</h5>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "edit-post-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal">Save Changes</a>
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
    <!-- Begin emoji-picker JavaScript -->
    <script src="<?php echo base_url('lib/js/config.js');?>"></script>
    <script src="<?php echo base_url('lib/js/util.js');?>"></script>
    <script src="<?php echo base_url('lib/js/jquery.emojiarea.js');?>"></script>
    <script src="<?php echo base_url('lib/js/emoji-picker.js');?>"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '<?php echo base_url('lib/img/');?>',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>
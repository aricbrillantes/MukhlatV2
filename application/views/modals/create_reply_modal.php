<?php
    $topic = $_SESSION['current_topic'];
?>

<!--<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">-->
<!-- Create Post Modal -->
<div id="create-reply-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create reply Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading  modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "reply-user" class="modal-title"></h4>
            </div>
            <form enctype = "multipart/form-data" id = "create-reply-form" action = "<?php echo base_url('topic/reply');?>" method = "POST">
                <div class="modal-body">
<!--                    <div class="form-group">
                        <label for = "title">Make a title for your reply (Optional):</label>
                        <p class="lead emoji-picker-container">
                        <input type="text" style="height: 50px;" class="form-control" maxlength = "100" name = "reply_title" id = "reply-title" placeholder = "Title of your post" data-emojiable="true"/>
                        </p>
                    </div>-->
                    <div class="form-group"><!-- check if description exceeds n words-->
                        <label for = "content">Make the content of your reply:</label>
                        <!--<p class="lead emoji-picker-container">-->
                        <textarea class = "form-control" style="height: 100px;" maxlength = "16000" required name = "reply_content" id = "reply-content" placeholder = "Tell something in your post!"></textarea>
<!--                        </p>-->
                        <p id="charsRemaining5">Characters Left: 16000</p>
                        <div class="charLimitMessage" id="charLimitMessage5"><center>Oops! You've used up all the letters and numbers for your post!</center></div>
                    </div>
                    <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div>
                    <div id = "attachment-buttons" class = "form-group">
                        Attach a file:
                        <!--IMAGE-->
                        <label id = "img-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-img" accept = "image/*" type="file" name = "reply_image" style = "display: none;">
                            <p id = "image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Image</p>
                        </label>

                        <!--AUDIO-->
                        <label id = "audio-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-audio" accept = "audio/*" type="file" name = "reply_audio" style = "display: none;">
                            <p id = "audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Audio</p>
                        </label>

                        <!--VIDEO-->
                        <label id = "video-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-video" accept = "video/*" type="file" name = "reply_video" style = "display: none;">
                            <p id = "video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        <!--FILE-->
                        <label id = "file-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-file" type="file" name = "reply_file" style = "display: none;">
                            <p id = "file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label>
                    </div>
                    <div id = "attachment-preview" class = "content-container">
                        <h5 id = "attachment-message" class = "text-warning text-center">No attachment yet.</h5>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "create-reply-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal">Reply</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--     Begin emoji-picker JavaScript 
    <script src="<?php echo base_url('lib/js/config.js');?>"></script>
    <script src="<?php echo base_url('lib/js/util.js');?>"></script>
    <script src="<?php echo base_url('lib/js/jquery.emojiarea.js');?>"></script>
    <script src="<?php echo base_url('lib/js/emoji-picker.js');?>"></script>
     End emoji-picker JavaScript 

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
    </script>-->
    <!--Profanity Filter and character limit counter-->
<script type="text/javascript">
    var warningCount=0, count=0;
    var x = document.getElementById("profanityWarning");
    var charCount1=100, charCount2=16000;
    
    $('.form-control').keyup(function(event) 
    {
        document.getElementById('charsRemaining5').innerHTML='Characters Left: '+(charCount2-document.getElementById('reply-content').value.length);

        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("❤","❤");
        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("😞","☹");
        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("🙂","🙂");
        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("😀","😀");
        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("XD","🤣");
        document.getElementById('reply-content').value=document.getElementById('reply-content').value.replace("😐","😐");

            if(
                document.getElementById('reply-content').value.includes("fuck")||
                document.getElementById('reply-content').value.includes("shit")
            )
            {  
//                  responsiveVoice.speak("Hey there! That's a bad word!","UK English Male",{rate: 1, pitch: 1.2});
//                  document.getElementById("profanityWarning").innerHTML = 'NO SWEARING!';
                x.style.display = "block";
                document.getElementById('create-reply-btn').style.background="red";
                document.getElementById('create-reply-btn').innerHTML="You should remove bad words from your reply!";
                document.getElementById('create-reply-btn').style.pointerEvents="none";
            }  

            else
            {
//                    document.getElementById("profanityWarning").innerHTML = '';
                x.style.display = "none";
                document.getElementById('create-reply-btn').style.background=getCookie("ButtonColor");
                document.getElementById('create-reply-btn').innerHTML="Reply";
                document.getElementById('create-reply-btn').style.pointerEvents="auto";
            }


            if(document.getElementById('reply-content').value.length>=16000)
            {  
                document.getElementById('charLimitMessage5').style.display = "block";
            }  
                
            else
                document.getElementById('charLimitMessage5').style.display = "none";

    });  
</script>
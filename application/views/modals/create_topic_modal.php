<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">

<!-- Create Topic Modal -->
<div id="create-topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Create Topic</strong></h4>
            </div>
            <form enctype = "multipart/form-data" id = "create-topic-form" action = "topic/create" method = "POST">
                <div class="modal-body">
                    <div class="form-group"><!-- check if title is already taken -->
                        <label for = "title">Make a title for your topic:</label>
                        <p class="lead emoji-picker-container">
                            <input type="text" style="height: 50px;" required class="form-control" name = "topic_name" maxlength="35" id = "topic-title" placeholder = "Title of your topic" data-emojiable="true"/></p>
                        <p id="charsRemaining1">Characters Left: 35</p>
                        <div class="charLimitMessage" id="charLimitMessage1"><center>Oops! You've used up all the letters and numbers for your title!</center></div>
                    </div>
                    <div class="form-group"><!-- check if description exceeds n words-->
                        <label for = "description">Make a description for your topic:</label>
                        <p class="lead emoji-picker-container">
                            <textarea class = "form-control" style="height: 100px;" required name = "topic_description" maxlength="180" id = "topic-description" placeholder = "Tell something about your topic!" data-emojiable="true"></textarea></p>
                        <p id="charsRemaining2">Characters Left: 180</p>    
                        <div class="charLimitMessage" id="charLimitMessage2"><center>Oops! You've used up all the letters and numbers for your topic!</center></div>
                    </p>
                    </div>
                    <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div>
                    <br>
                     <div id = "attachment-buttons" class = "form-group">
                    <label id = "img-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-img" accept = "image/*" type="file" name = "topic_image" style = "display: none;">
                            <p id = "image-text2" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Cover Image</p>
                        </label>
                     </div>

                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "create-topic-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal">Create Topic</a>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!--Confirmation of topic creation modal-->

<div id="create-confirmation-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Confirm Topic Creation?</strong></h4>
            </div>
            <div class="modal-body">
                <button id = "create-topic-proceed" type = "submit" class = "btn btn-success">Proceed</button>
                <button class = "btn btn-Danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPTS -->    <!-- Begin emoji-picker JavaScript -->
<!--    <script src="<?php echo base_url('lib/js/config.js');?>"></script>
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
//        window.emojiPicker.freeze();
      });
    </script>-->
    <!--Profanity Filter and character limit counter-->
    <script type="text/javascript">
    var warningCount=0, count=0;
    var x = document.getElementById("profanityWarning");
    var charCount1=35, charCount2=180;
    
    $('.modal-body').keyup(function(event) 
    {
        document.getElementById('charsRemaining1').innerHTML='Characters Left: '+(charCount1-document.getElementById('topic-title').value.length);
        document.getElementById('charsRemaining2').innerHTML='Characters Left: '+(charCount2-document.getElementById('topic-description').value.length);
        
        if(
            document.getElementById('topic-title').value.includes("fuck")||
            document.getElementById('topic-title').value.includes("shit")||
            document.getElementById('topic-description').value.includes("fuck")||
            document.getElementById('topic-description').value.includes("shit")
        )
        {   
            x.style.display = "block";
            document.getElementById('create-topic-btn').style.background="red";
            document.getElementById('create-topic-btn').innerHTML="You should remove bad words from your topic!";
            document.getElementById('create-topic-btn').style.pointerEvents="none";
        }  

        else
        {
            x.style.display = "none";
            document.getElementById('create-topic-btn').style.background=getCookie("ButtonColor");
            document.getElementById('create-topic-btn').innerHTML="Post";
            document.getElementById('create-topic-btn').style.pointerEvents="auto";
        }

        if(document.getElementById('topic-title').value.length>=35)
        {  
            document.getElementById('charLimitMessage1').style.display = "block";
        }
        
        else
            document.getElementById('charLimitMessage1').style.display = "none";
        
        if(document.getElementById('topic-description').value.length>=180)
        {  
            document.getElementById('charLimitMessage2').style.display = "block";
        }  
        
        else
            document.getElementById('charLimitMessage2').style.display = "none";
//              
    });  
</script>
    
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>

    
<!-- END SCRIPTS -->
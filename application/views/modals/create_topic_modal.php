<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">

<!-- Create Topic Modal -->
<div id="create-topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title textoutliner"><strong>Choosing your room style</strong></h4>
            </div>
            <form enctype = "multipart/form-data" id = "create-topic-form" action = "topic/create" method = "POST">
                <div class="modal-body">
                    <div class="form-group" style="display:none;"><!-- check if title is already taken -->
                        <label for = "title">Make a title for your topic:</label>
                        <p class="lead emoji-picker-container">
                            <input type="text" style="height: 50px;" required class="form-control" name = "topic_name" maxlength="35" id = "topic-title" placeholder = "Title of your topic"  value="<?php echo $logged_user->first_name?>"/></p>
                        <p id="charsRemaining1">Characters Left: 35</p>
                        <div class="charLimitMessage" id="charLimitMessage1"><center>Oops! You've used up all the letters and numbers for your title!</center></div>
                    </div>
                    <div class="form-group" style="display:none;"><!-- check if description exceeds n words-->
                        <label for = "description">Make a description for your topic:</label>
                        <p class="lead emoji-picker-container">
                            <textarea class = "form-control" style="height: 100px;" required name = "topic_description" maxlength="180" id = "topic-description" placeholder = "Tell something about your topic!"  value=" "> </textarea></p>
                        <p id="charsRemaining2">Characters Left: 180</p>    
                        <div class="charLimitMessage" id="charLimitMessage2"><center>Oops! You've used up all the letters and numbers for your topic!</center></div>
                    </p>
                    </div>
                    <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div>
                    <br>
<!--                     <div id = "attachment-buttons" class = "form-group">
                    <label id = "img-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-img" accept = "image/*" type="file" name = "topic_image" style = "display: none;">
                            <p id = "image-text2" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Cover Image</p>
                        </label>
                     </div>-->
<strong style="font-size: 24px;">Choose what you like.
You can change it later.</strong>
<strong style="font-size: 24px;background-color: white !important;border: 4px solid black;border-radius: 15px;padding-left: 5px">Choose a wallpaper:</strong><br>
<div class="themesmodal">
    <table>
        <tr>
            <td><div  class="editroomthemes roomtheme-arrow blocks2" style="" onclick="roomtheme(1)"></div></td>
            <td><div  class="editroomthemes roomtheme-zigzag blocks2" style="" onclick="roomtheme(2)"></div></td>
            <td><div  class="editroomthemes roomtheme-scales blocks2" style="" onclick="roomtheme(3)"></div></td>
            <td><div  class="editroomthemes roomtheme-halfrhombe blocks2" style="" onclick="roomtheme(4)"></div></td>
        </tr>
        <tr>
            <td><div  class="editroomthemes roomtheme-marrakesh blocks2" style="" onclick="roomtheme(5)"></div></td>
            <td><div  class="editroomthemes roomtheme-hearts blocks2" style="" onclick="roomtheme(6)"></div></td>
            <td><div  class="editroomthemes roomtheme-stars blocks2" style="" onclick="roomtheme(7)"></div></td>
            <td><div  class="editroomthemes roomtheme-seigaiha blocks2" style="" onclick="roomtheme(8)"></div></td>
        </tr>
        <tr>
            <td><div  class="editroomthemes roomtheme-bricks blocks2" style="" onclick="roomtheme(9)"></div></td>
            <td><div  class="editroomthemes roomtheme-diacheckerboard blocks2" style="" onclick="roomtheme(10)"></div></td>
            <td><div  class="editroomthemes roomtheme-tablecloth blocks2" style="" onclick="roomtheme(11)"></div></td>
            <td><div  class="editroomthemes roomtheme-brady blocks2" style="" onclick="roomtheme(12)"></div></td>
        </tr>
        <tr>
            <td><div  class="editroomthemes roomtheme-argyle blocks2" style="" onclick="roomtheme(13)"></div></td>
            <td><div  class="editroomthemes roomtheme-shippo blocks2" style="" onclick="roomtheme(14)"></div></td>
            <td><div  class="editroomthemes roomtheme-waves blocks2" style="" onclick="roomtheme(15)"></div></td>
            <td><div  class="editroomthemes roomtheme-polkadot blocks2" style="" onclick="roomtheme(16)"></div></td>
        </tr>
        <tr>
            <td><div  class="editroomthemes roomtheme-honeycomb blocks2" style="" onclick="roomtheme(17)"></div></td>
            <td><div  class="editroomthemes roomtheme-chocolateweave blocks2" style="" onclick="roomtheme(18)"></div></td>
            <td><div  class="editroomthemes roomtheme-crosseddot blocks2" style="" onclick="roomtheme(19)"></div></td>
            <td><strong style="position: absolute;top:1080px;left:82%;transform: scale(2);z-index: 10000;text-shadow:-1px -1px 0 #FFF,1px -1px 0 #FFF,-1px 1px 0 #FFF,1px 1px 0 #FFF;color: black">More...</strong><input type="text" style="width:110px; height:110px;font-size: 0px !important;position: absolute;top:1177px;left:82%;transform: scale(2);"  class="form-control jscolor editroomthemes" name="topic_theme" id="topic-theme" onclick="" value="1" readonly/></td>
        </tr>
    </table>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                
                <strong id="nameframeinput" class="nameframe" style="font-size: 24px;">Choose a color you like.</strong>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_nameframe" maxlength="35" id = "topic-nameframe" value="EEEEEE" readonly/> <div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <strong id="chboardinput" class="chalkboard cursornone" style="font-size: 24px;">Choose a color for your chalkboard.</strong>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_board" maxlength="35" id = "topic-board" value="B78240" readonly/><div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <strong id="bulboardinput" class="whiteboard2 cursornone" style="font-size: 24px;">Choose a color for your bulletin board.</strong>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_bulletin" maxlength="35" id = "topic-bulletin" value="ADB2BD" readonly/><div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <center><strong id="stickyinput" class="stickynote stickytext stickyact cursornone" style="font-size: 24px;">Choose a color for your memo.</strong></center>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_shoutout" maxlength="35" id = "topic-shoutout" value="FFFFCC" readonly/><div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <center><strong id="mediainput" class="mediabox cursornone" style="font-size: 24px;">Choose a color for your album.</strong></center>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_media" maxlength="35" id = "topic-media" value="33CC54" readonly/><div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <br>
                <div id="chatinput" class="commentsectionbg"><br><div class="messagereceiver cursornone" style="font-size: 24px;">Choose another color you like.</div></div>
                <input type="text" style="height: 50px;font-size: 0px !important;" required class="form-control jscolor" name = "topic_chatbox" maxlength="35" id = "topic-chatbox"  value="ECEFF1" readonly/><div class="clicker" style="pointer-events:none;margin-top: -40px;margin-left: 10px;font-weight: bold;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;color: white;">Click here</div>
                <br>
                
                <div class = "" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;text-align: center;transform: scale(2);">
                    <a id = "create-topic-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal">Make your room</a>
                    <!--<a class = "btn btn-primary btn-sm buttonsbgcolor" onclick="defaultcolor()">Default</a>-->
                </div>
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
<script>
        function roomtheme(v){
            $('[id$=topic-theme]').val(v);
        }
        function defaultcolor(){
            $('[id$=topic-nameframe]').val("EEEEEE");
            $('[id$=topic-board]').val("B78240");
            $('[id$=topic-bulletin]').val("ADB2BD");
            $('[id$=topic-media]').val("33CC54");
            $('[id$=topic-shoutout]').val("FFFFCC");
            $('[id$=topic-chatbox]').val("ECEFF1");
        }
        
        
    </script>
    
<!-- END SCRIPTS -->
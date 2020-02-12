<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">

<!-- Create Topic Modal -->
<div id="edit-topic-modal" class="modal fade" role="dialog">
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
<strong style="font-size: 24px;">Change up your room style</strong>
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
        </tr>
    </table>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>  
    <div class="hider"><br><br></div>
                <input type="text" style="width:110px; height:40px;"  class="form-control jscolor" name="change_topic_theme" id="change-topic-theme" onclick="" value="<?php echo $c_topic->theme?>"/>

                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_nameframe" maxlength="35" id = "change-topic-nameframe" value="<?php echo $c_topic->nameframe?>"/>

                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_board" maxlength="35" id = "change-topic-board" value="<?php echo $c_topic->board?>"/>

                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_bulletin" maxlength="35" id = "change-topic-bulletin" value="<?php echo $c_topic->bulletin?>"/>

                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_shoutout" maxlength="35" id = "change-topic-shoutout" value="<?php echo $c_topic->shoutout?>"/>
                
                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_media" maxlength="35" id = "change-topic-media" value="<?php echo $c_topic->media?>"/>

                <input type="text" style="height: 50px;" required class="form-control jscolor" name = "change_topic_chatbox" maxlength="35" id = "change-topic-chatbox"  value="<?php echo $c_topic->chatbox?>"/>
                <br>

                <div class = "" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;text-align: center;transform: scale(2);">
                    <button onmouseenter="playclip()" value = "<?php echo $c_topic->topic_id ?>" id = "edit-topic-save" class = "btn btn-primary btn-sm buttonsbgcolor">Done!</button>
                    <a class = "btn btn-primary btn-sm buttonsbgcolor" onclick="defaultcolor()">Default</a>
                </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
    
    <script>
        function roomtheme(v){
            $('[id$=change-topic-theme]').val(v);
        }
        function defaultcolor(){
            $('[id$=change-topic-nameframe]').val("EEEEEE");
            $('[id$=change-topic-board]').val("B78240");
            $('[id$=change-topic-bulletin]').val("ADB2BD");
            $('[id$=change-topic-media]').val("33CC54");
            $('[id$=change-topic-shoutout]').val("FFFFCC");
            $('[id$=change-topic-chatbox]').val("ECEFF1");
        }
    </script>
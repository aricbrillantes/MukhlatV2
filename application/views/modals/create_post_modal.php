<?php
$topic = $_SESSION['current_topic'];
?>
<!--<script src="/intl/en/chrome/assets/common/js/chrome.min.js"></script>-->     
    <!--Voice Search Script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
<!--<script type="text/javascript">
        var recognition2 = new webkitSpeechRecognition();
        recognition2.lang = 'fil-PH';
        recognition2.continuous = true;
        recognition2.interimResults = true;

        recognition2.onstart = function() {
            recognizing = true;
//            document.getElementById("recording").innerText = 'RECORDING';
          };

          recognition2.onerror = function(event) {
            console.log(event.error);
          };

          recognition2.onend = function() {
            recognizing = false;
            document.getElementById("post-title").value=final_span2.innerHTML;
        };
//
        recognition2.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                  
                if(interim_span2.innerHTML.includes("stop"))
                {  
                    recognition2.stop();
//                    document.getElementById("post-title").value=final_span2.innerHTML;
                    return;
                    
                }  
                
                if(interim_span2.innerHTML.includes("go to topics"))
                {  
                    location.href = 'http://localhost/MukhlatV2/topic';
                }  
                interim_transcript += event.results[i][0].transcript;
              }
            }
            final_span2.innerHTML = linebreak(final_transcript);
            interim_span2.innerHTML = linebreak(interim_transcript);
            document.getElementById("post-title").value=interim_span2.innerHTML;
            
            
          };

        function startDictation2(event) {
            recognition2.lang = 'en-US';
            final_transcript = '';
            final_span2.innerHTML = '';
            interim_span2.innerHTML = '';
            recognition2.start();
        }
                                
    </script>-->
  <style>
  i.down {
  border: solid red;
  border-width: 0 5px 5px 0;
  display: inline-block;
  padding: 5px;
  }
  i.up {
  border: solid red;
  border-width: 0 5px 5px 0;
  display: inline-block;
  padding: 5px;
  }
  .up {
  transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  }

  .down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  }

  
#scissors {
        height: 43px; /* image height */
        width: 90%;
        margin: auto auto;
        background-image: url('http://i.stack.imgur.com/cXciH.png');
        background-repeat: no-repeat;
        background-position: right;
        position: relative;
        overflow: hidden;
    }
    #scissors:after {
        content: "";
        position: relative;
        top: 50%;
        display: block;
        border-top: 2px dashed black;
        margin-top: -2px;
    }
    #scissors-mid {
        height: 43px; /* image height */
        width: 90%;
        margin: auto auto;
        background-image: url('http://i.stack.imgur.com/cXciH.png');
        background-repeat: no-repeat;
        background-position: center;
        position: relative;
        overflow: hidden;
    }
    #scissors-mid:after {
        content: "";
        position: relative;
        top: 50%;
        display: block;
        border-top: 2px dashed black;
        margin-top: -2px;
    }

    .drawnbutton{
     
      background:transparent;
      
      
      transition:all .5s ease;
      color:#41403E;
      font-size:2rem;
      letter-spacing:1px;
      outline:none;
      box-shadow: 20px 38px 34px -26px hsla(0,0%,0%,.2);
      border-radius: 255px 15px 225px 15px/15px 225px 15px 255px;
    }
      .drawnbutton:hover{
         box-shadow:2px 8px 4px -6px hsla(0,0%,0%,.4);
      } 
      .drawnbutton.lined.thick{
         border:solid 4px #009900;
         width:100%;
      }
      .drawnbutton.lined.thick.gray{
         border:solid 4px #a9a9a9;
         width:100%;
      }
      .drawnbutton.dotted.thick{
         border:dotted 5px #41403E;
         width:30%;
      }
      .drawnbutton.dashed.thick{
        border:dashed 5px #41403E;
        text-align:center;
        
  
      }
      .drawnbutton.lined.thin{
         border:solid 2px #41403E;
         width:70%;
         
      }
      .drawnbutton.dotted.thin{
         border:dotted 2px #41403E;
         width:70%;
         
      }
      .drawnbutton.dashed.thin{
        border:dashed 2px #41403E;

      }
    
    @media (max-width:620px){
      .drawnbutton{
        margin-bottom:2rem;
      }
    }

  </style>
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">
<!-- Create Post Modal -->
<div id="create-post-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Share to <?php echo utf8_decode($topic->topic_name); ?></strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/post'); ?>" id = "create-post-form" method = "POST">
                <div class="modal-body">
                    
                    
                    
                    <div class="form-group" id="post-title-container"><!-- check if title is already taken -->
                        <!--<label for = "title">Make a title for your post:</label>-->
                        <!--<p class="lead emoji-picker-container">-->
                        <h3 id="titlewarning" style="display: none;color:red;"><i class="arrow down"></i> Add a title here! <i class="arrow down"></i></h3>
                        <p class="emoji-picker-container"><input class="title-text" type="text" style="height: 50px;background:transparent;outline:none;border:none;" maxlength = "10"  required class="form-control" name = "post_title" id = "post-title"  placeholder = "My title"  data-emojiable="true" value="" required /></p>
                        <!--<p id="charsRemaining3">Characters Left: 100</p>-->
                        <div class="charLimitMessage" id="charLimitMessage3"><center>Oops! You've used up all the letters and numbers for your title!</center></div>
                        <!--<span id="start_button" onclick="startDictation2(event)" style="display: inline-block;"><img border="0" alt="Start" id="start_img" src="https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif"></span>-->
                            <!--<a href="#" class="voicesearch" id="voicesearch" onclick="stopDictation2(event)"><img border="0" id="voicesearchicon" class="voicesearchicon" alt="START" src="images/microphone_start.png" height="50" width="50"></a>-->
                            <!--<button onclick="startDictation2(event)">Try it</button>-->
                    </div>
                    
                    <div style="display: none">
                        <input maxlength = "1"  required class="form-control" name = "reply" id = "reply"  value="0"/>
                        <input maxlength = "1"  required class="form-control" name = "shout" id = "shout"  value="0"/>
                    </div>
                    
                    
                    <div id="results" style="display: none" border="1px">
                        <span id="final_span2" class="final"></span>
                        <span id="interim_span2" class="interim"></span>
                    </div>
                    
                    <div class="form-group" ><!-- check if description exceeds n words-->
                        <!--<label for = "content">Make the content of your post:</label>-->
                        <!--<p class="lead emoji-picker-container">-->
                        <h3 id="contentwarning" style="display: none;color:red;"><i class="arrow down"></i> Write your thoughts here! <i class="arrow down"></i></h3>
                        <p id="dobback" class="emoji-picker-container"><textarea class = "form-control" style="height: 100px;background:transparent;outline:none;border:none;" maxlength = "500" required name = "post_content" id = "post-content" placeholder = "My thoughts" data-emojiable="true" required></textarea></p>
                        <textarea id="postester" style="display: none"></textarea>
                        <!--<p id="charsRemaining4">Characters Left: 16000</p>-->
                        <div class="charLimitMessage" id="charLimitMessage4"><center>Oops! You've used up all the letters and numbers for your message!</center></div>
                    </div>
                    
                    
            <div id="stickerchoices" style="margin-bottom: 30px;">        
                <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
                    <li class = "active"><a data-toggle="pill" href="#emoticats"><strong style="cursor: pointer"><img width="50%" height="auto" src="<?php echo base_url('images/stickers/happy.png'); ?>"/> EmotiCats</strong></a></li>
                                <li><a data-toggle="pill" href="#textiful"><strong style="cursor: pointer"><img width="80%" height="auto" src="<?php echo base_url('images/stickers/amazing.png'); ?>"/> Textiful</strong></a></li>

                                      <li><a data-toggle="pill" href="#wenk"><strong style="cursor: pointer"><img width="90%" height="auto" src="<?php echo base_url('images/stickers/wenk haha.png'); ?>"/> Wenk</strong></a></li> 
                                    <li><a data-toggle="pill" href="#buggy"><strong style="cursor: pointer"><img width="80%" height="auto" src="<?php echo base_url('images/stickers/spidab.png'); ?>"/> Buggy</strong></a></li>

                </ul>
                <div class="tab-content">
                    <div id="emoticats" class="tab-pane fade in active">
                        <img class="stickerhov iconin" width="20%" height="auto" src="<?php echo base_url('images/stickers/happy.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';happy;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto" src="<?php echo base_url('images/stickers/sad.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';sad;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto" src="<?php echo base_url('images/stickers/angry.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';angry;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto" src="<?php echo base_url('images/stickers/love.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';love;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/love 2.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';love 2;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/laughing crying.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';laughing crying;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/yum.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';yum;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/yuck.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';yuck;');"/>
                    </div>

                    <div id="textiful" class="tab-pane fade in">
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/amazing.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';amazing;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/woohoo.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';woohoo;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/what.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';what;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/eww.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';eww;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/cool.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';cool;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/joke.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';joke;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/haha.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';haha;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/zzz.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';zzz;');"/>
                        <img class="stickerhov iconin" width="20%" height="auto"src="<?php echo base_url('images/stickers/pretty.gif'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';pretty;');"/>
                    </div>
                    <div id="wenk" class="tab-pane fade in">
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/wenk hi.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';wenk hi;');"/>
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/wenk facepalm.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';wenk facepalm;');"/>
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/wenk haha.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';wenk haha;');"/>
                    </div>
                    <div id="buggy" class="tab-pane fade in">
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/spidab.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';spidab;');"/>
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/busy.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';busy;');"/>
                        <img class="stickerhov iconin" width="30%" height="auto"src="<?php echo base_url('images/stickers/sweet.png'); ?>" onclick="var keep= $('[id$=post-content]').val();doBack();emojisICON();keeper(keep, ';sweet;');"/>
                    </div>
                </div>
            </div>
                    
                   <!-- <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div> -->

<!--                    <div data-toggle="collapse" data-target="#camera" class="dropbtn" style = "background: #D7eadd; cursor: pointer;"><center><div>Take Picture</div>
                            <div id="camera" class="collapse">
                                <div class="camera">
                                <video id="video" style="width:95%;height:90%;"></video>
                                </div>
                                <canvas id="canvas"></canvas>
                                <div class="output"></div>
                                <div id = "img-label" class="btn btn-primary">
                                    <input id = "attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;">
                                    <p id="startbutton" class = "attach-btn-text"><i class = "fa fa-file-image-o" onclick="takepicture();"></i> Take Photo</p>
                                </div>
                            </div></center>
                        </div>-->
                        <h2 id="addwarning" style="display:none;color:red;" ><i class="arrow up"></i> add something to share! </h2>
                        <h4 id="startrec" style="display: none;text-align:center;">You are now recording!</h4>
                  <div id="uploadmedia">
                    <ul class="nav nav-pills nav-justified" style = "margin-bottom: 30px;">
                      <li class = "active"><button type="button" data-toggle="pill" href="#picturetab" id="choosepic" class="drawnbutton lined thick gray" onclick="chosepic()"><img src="<?php echo base_url('icons/pic.png'); ?>" style="display:block;margin: 0 auto;width:100%"> Pix </button></li>
                      <li><button type="button" id="choosenote" data-toggle="pill" href="#audiotab" class="drawnbutton lined thick" onclick="chosenote()"><img src="<?php echo base_url('icons/note.png'); ?>" style="display:block;margin: 0 auto;width:100%"> Sound </button></li>
                      <li><button type="button" id="choosevid" data-toggle="pill" href="#videotab" class="drawnbutton lined thick" onclick="chosevid()"><img src="<?php echo base_url('icons/video.png'); ?>" style="display:block;margin: 0 auto;width:100%"> Vids </button></li>

                    </ul>
                    <div class="tab-content">
                      <div id="picturetab" class="tab-pane fade in active">
                          <div style="text-align:center">
                          <button type="button" id="btnpic" class="drawnbutton lined thin" onclick="cameraclick();"><img src="<?php echo base_url('icons/Camera.png'); ?>" style="display:block;margin: 0 auto;margin-bottom: 15px;margin-top: 10px;max-width: 150px;"></img>Take a Pic!</button>
                          </div>
                            <div id="takepic" style="display: none">
                              <video id="camera" width="640" height="480" autoplay></video>
                              <button id="snap">Say cheese</button>
                              <canvas id="canvas" width="640" height="480"></canvas>
                              <button id="dlpicbutton" class="drawnbutton dashed thick"  style="display: none;"><a id="dlpic"  download="Mypic" style="text-decoration: none;">Save my pic</a></button>
                            </div>
                          <div id = "attachment-buttons" class = "form-group"style="text-align:center">
                          <!--<img id="target"/>-->
                            <!-- Attach a file: -->
                            <!--IMAGE-->

                            

                            <label id = "img-label" class="drawnbutton dotted thin" >
                                <input id = "attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;" onchange="fileAdded();readURL(this);">
                                <p id = "image-text" class = "attach-btn-text" style="text-align: center;"><img src="<?php echo base_url('icons/pic.png'); ?>" style="display:block;margin: 0 auto;"> Choose Pix </p>
                            </label>
                          </div>
                          <img id="pic" src="#"  width="100%" />
                          <h2 id="pic_h" style="display: none">The picture you used is too big, sorry!</h2>

                      </div>

                      <div id="audiotab" class="tab-pane fade in">
                          <div style="text-align:center">
                          <button type="button" id="btnStart" class="drawnbutton lined thin" onclick="recordaudio();"><img src="<?php echo base_url('icons/mic.png'); ?>" style="display:block;margin: 0 auto;margin-bottom: 15px;margin-top: 10px"></img>Tick Talk!</button>
                          </div>
                          <div id="recaud" style="display: none">

                          <audio id="aud1" controls></audio><br>
                            <div style="text-align: center;">
                            <button type="button" id="btnStop" class="drawnbutton dashed thick">Im done recording!</button>
                            <button id="dlbutton" class="drawnbutton dashed thick"  style="display: none;"><a id="dl" download="My Voice">Save my Voice</a></button>
                            </div>
                          </div>
                          <div id = "attachment-buttons" class = "form-group"style="text-align:center">

                            <label id = "audio-label" class="drawnbutton dotted thin">
                              <input id = "attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;" onchange="fileAdded();readAud(this);">
                              <p id = "audio-text" class = "attach-btn-text" style="text-align: center;"><img src="<?php echo base_url('icons/note.png'); ?>" style="display:block;margin: 0 auto;"> Choose Sounds </p>
  
                            </label>
                          </div>
                          <audio id="aud" width="100%" controls>
                          <source src="#" id="audio_here">
                          </audio>
                          <h2 id="snd_h" style="display: none">The audio you used is too big, sorry!</h2>

                      </div>

                      <div id="videotab" class="tab-pane fade in">
                          <div style="text-align:center">
                          <button type="button" id="btnStart2" class="drawnbutton lined thin" onclick="recordvideo();"><img src="<?php echo base_url('icons/Recordvid.png'); ?>"></img>Video Time!</button>
                          </div>
                          <div id="recvid" style="display: none">
                          <video width="400" id="vidprev"  controls muted></video><br>
                          <video width="400" id="vid1" style="display: none" controls></video><br>
                            <div style="text-align: center;">
                            <button type="button" id="btnStop2" class="drawnbutton dashed thick">Im done recording!</button>
                            <button id="dl2button" class="drawnbutton dashed thick"  style="display: none;"><a id="dl2"  download="My Video" style="text-decoration: none;">Save my Video</a></button>
                            </div>

                          </div>
                          <div id = "attachment-buttons" class = "form-group"style="text-align:center">
                      
                            <label id = "video-label" class="drawnbutton dotted thin">
                                <input id = "attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;" onchange="fileAdded();readVid(this);">
                                <p id = "video-text" class = "attach-btn-text" style="text-align: center;"><img src="<?php echo base_url('icons/video.png'); ?>" style="display:block;margin: 0 auto;"> Choose Vids </p>
                            </label>
                          </div>
                          <video id="vid" width="100%" controls>
                              <source src="#" id="video_here">
                              
                          </video> 
                          <h2 id="vid_h" style="display: none">The video you used is too big, sorry!</h2>

                      </div>
                    </div>
                  </div>

               
            
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <button class="drawnbutton lined thick"><a id = "create-post-btn" style="font-size: 30px;text-decoration: none;" data-toggle = "modal" onclick="shareclick()" >Share</a></button>
                </div>
                
            </div>
            </form>
            
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<!--PROFANITY FILTER and character limit counter-->
 <!--<script src="https://code.responsivevoice.org/responsivevoice.js"></script>-->


<script>
    
var hasfile=0;
var toggle;
function fileAdded()
{
  if(document.getElementById('post-content').value=="")
            {
              
              $('[id$=contentwarning]').show();
            }
            else{
              
              $('[id$=contentwarning]').hide();
            }
  hasfile=1;
  $('[id$=addwarning]').hide();
}

function recordaudio()
{
  $('[id$=recaud]').show();
  $('[id$=startrec]').show();
  $('[id$=btnStart]').hide();
  $('[id$=btnStop]').show();
  $('[id$=dlbutton]').hide();
  $('[id$=btnStart2]').hide();
}
function recordvideo()
{
  $('[id$=recvid]').show();
  $('[id$=startrec]').show();
  $('[id$=btnStart2]').hide();
  $('[id$=btnStop2]').show();
  $('[id$=vidprev]').show();
  $('[id$=dl2button]').hide();
  $('[id$=btnStart]').hide();
}
function cameraclick()
{
  $('[id$=takepic]').show();
}

// close()
// {
//   document.getElementById('').value=""
// }

function chosepic()
{
 
  document.getElementById("choosepic").className = "drawnbutton lined thick gray";
  document.getElementById("choosenote").className = "drawnbutton lined thick";
  document.getElementById("choosevid").className = "drawnbutton lined thick";
  
}
function chosenote()
{
  
  document.getElementById("choosenote").className = "drawnbutton lined thick gray";
  document.getElementById("choosepic").className = "drawnbutton lined thick";
  document.getElementById("choosevid").className = "drawnbutton lined thick";
}
function chosevid()
{
  
  document.getElementById("choosevid").className = "drawnbutton lined thick gray";
  document.getElementById("choosenote").className = "drawnbutton lined thick";
  document.getElementById("choosepic").className = "drawnbutton lined thick";
}




///////////////
let constraintObj = { 
            audio: true, 
            video: false
        }; 
      
        if (navigator.mediaDevices === undefined) {
            navigator.mediaDevices = {};
            navigator.mediaDevices.getUserMedia = function(constraintObj) {
                let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                if (!getUserMedia) {
                    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                }
                return new Promise(function(resolve, reject) {
                    getUserMedia.call(navigator, constraintObj, resolve, reject);
                });
            }
        }else{
            navigator.mediaDevices.enumerateDevices()
            .then(devices => {
                devices.forEach(device=>{
                    console.log(device.kind.toUpperCase(), device.label);
                    //, device.deviceId
                })
            })
            .catch(err=>{
                console.log(err.name, err.message);
            })
        }
        navigator.mediaDevices.getUserMedia(constraintObj)
        .then(function(mediaStreamObj) {
            //connect the media stream to the first audio element
            // let audio = document.querySelector('audio');
            // if ("srcObject" in audio) {
            //     audio.srcObject = mediaStreamObj;
            // } else {
            //     //old version
            //     audio.src = window.URL.createObjectURL(mediaStreamObj);
            // }
            
            // audio.onloadedmetadata = function(ev) {
            //     //show in the audio element what is being captured by the webcam
            //     audio.play();
            // };
            
            //add listeners for saving audio/audio
            let dl = document.getElementById('dl');
            let start = document.getElementById('btnStart');
            let stop = document.getElementById('btnStop');
            let vidSave = document.getElementById('aud1');
            let mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = [];
            
            start.addEventListener('click', (ev)=>{
                
                mediaRecorder.start();
                console.log(mediaRecorder.state);
                
            })
            stop.addEventListener('click', (ev)=>{
              $('[id$=startrec]').hide();
              $('[id$=btnStart]').show();
              $('[id$=btnStop]').hide();
              $('[id$=dlbutton]').show();
             
                mediaRecorder.stop();
                console.log(mediaRecorder.state);
               
            });
            mediaRecorder.ondataavailable = function(ev) {
                chunks.push(ev.data);
            }
            mediaRecorder.onstop = (ev)=>{
                let blob = new Blob(chunks, { 'type' : 'audio/mp3;' });
                chunks = [];
                let audioURL = window.URL.createObjectURL(blob);
                vidSave.src = audioURL;
                dl.href=audioURL;
                stop.href = audioURL;
                

            }
        })
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });
        
///////////////


function readURL(input) {
  $('[id$=attach-audio]').val("");
  $('[id$=attach-video]').val("");
  
  
  $('[id$=pic_h]').hide();
  $('[id$=vid_h]').hide();
  $('[id$=snd_h]').hide();
  document.getElementById("video-label").className = "drawnbutton dotted thin";
  document.getElementById("audio-label").className = "drawnbutton dotted thin";
  document.getElementById("img-label").className = "drawnbutton dotted thick";
  if (input.files && input.files[0]) {
    
    
    if(input.files[0] && input.files[0].size < 256000000) { 
        //Submit form   
        $('[id$=pic_h]').hide();    
        if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
        $('#pic').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
        }
    } else {
      $('[id$=pic_h]').show();

      
    }
  }
  
 
  
}

function readVid(input){
  $('[id$=attach-audio]').val("");
  $('[id$=attach-img]').val("");
  $('[id$=video-text]').text('Change Video');
  

  $('[id$=pic_h]').hide();
  $('[id$=vid_h]').hide();
  $('[id$=snd_h]').hide();
  document.getElementById("img-label").className = "drawnbutton dotted thin";
  document.getElementById("audio-label").className = "drawnbutton dotted thin";
  document.getElementById("video-label").className = "drawnbutton dotted thick";
  if(input.files[0] && input.files[0].size < 256000000) { 
        //Submit form
        $('[id$=vid_h]').hide();  
        var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(input.files[0]);
  $source.parent()[0].load();
        
    } else {
      $('[id$=vid_h]').show();
 
      
    }

    $('[id$=recvid]').hide();
}

function readAud(input){
  $('[id$=attach-video]').val("");
  $('[id$=attach-img]').val("");
  $('[id$=audio-text]').text('Change Sound');
 
  
  $('[id$=pic_h]').hide();
  $('[id$=vid_h]').hide();
  $('[id$=snd_h]').hide();
  document.getElementById("video-label").className = "drawnbutton dotted thin";
  document.getElementById("img-label").className = "drawnbutton dotted thin";
  document.getElementById("audio-label").className = "drawnbutton dotted thick";
  if(input.files[0] && input.files[0].size < 256000000) { 
        //Submit form    
        $('[id$=snd_h]').hide();   
        var $source = $('#audio_here');
  $source[0].src = URL.createObjectURL(input.files[0]);
  $source.parent()[0].load();
    } else {
      $('[id$=snd_h]').show();

      
    }
    
    $('[id$=recaud]').hide();
}

///////////////

let constraintObj2 = { 
            audio: true, 
            video:{ 
                facingMode: "user", 
                width: { min: 640, ideal: 1280, max: 1920 },
                height: { min: 480, ideal: 720, max: 1080 } 
            } 
        }; 
      
        if (navigator.mediaDevices === undefined) {
            navigator.mediaDevices = {};
            navigator.mediaDevices.getUserMedia = function(constraintObj2) {
                let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                if (!getUserMedia) {
                    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                }
                return new Promise(function(resolve, reject) {
                    getUserMedia.call(navigator, constraintObj2, resolve, reject);
                });
            }
        }else{
            navigator.mediaDevices.enumerateDevices()
            .then(devices => {
                devices.forEach(device=>{
                    console.log(device.kind.toUpperCase(), device.label);
                    //, device.deviceId
                })
            })
            .catch(err=>{
                console.log(err.name, err.message);
            })
        }
        navigator.mediaDevices.getUserMedia(constraintObj2)
        .then(function(mediaStreamObj2) {
            //connect the media stream to the first video element
            let video = document.getElementById('vidprev');
            if ("srcObject" in video) {
                video.srcObject = mediaStreamObj2;
            } else {
                //old version
                video.src = window.URL.createObjectURL(mediaStreamObj2);
            }
            
            video.onloadedmetadata = function(ev) {
                //show in the video element what is being captured by the webcam
                video.play();
            };
            
            //add listeners for saving audio/audio
            let dl2 = document.getElementById('dl2');
            let start2 = document.getElementById('btnStart2');
            let stop2 = document.getElementById('btnStop2');
            let vidSave2 = document.getElementById('vid1');
            let mediaRecorder2 = new MediaRecorder(mediaStreamObj2);
            let chunks2 = [];
            
            start2.addEventListener('click', (ev)=>{
              
                mediaRecorder2.start();
                console.log(mediaRecorder2.state);
                
            })
            stop2.addEventListener('click', (ev)=>{
              $('[id$=vid1]').show();
              $('[id$=vidprev]').hide();
              $('[id$=startrec]').hide();
              $('[id$=btnStart2]').show();
              $('[id$=btnStop2]').hide();
              $('[id$=dl2button]').show();
              
                mediaRecorder2.stop();
                console.log(mediaRecorder2.state);
            });
            mediaRecorder2.ondataavailable = function(ev) {
                chunks2.push(ev.data);
            }
            mediaRecorder2.onstop = (ev)=>{
                let blob2 = new Blob(chunks2, { 'type' : 'video/mp4;' });
                chunks2 = [];
                let audioURL2 = window.URL.createObjectURL(blob2);
                vidSave2.src = audioURL2;
                dl2.href=audioURL2;

            }
        })
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });

/////////////// camera part



var video = document.getElementById('camera');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {

        camera.srcObject = stream;
        camera.play();
    });
}

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');


// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(camera, 0, 0, 640, 480);
  let dlpic = document.getElementById('dlpic');
  dlpic.href=canvas.toDataURL();
  $('[id$=dlpicbutton]').show();
});



/////////////

    function toggleButton(p)
    {
        
        $('[id$=attachment-preview]').hide();
        $('[id$=post-title-container]').hide();
        $('[id$=reply]').val(0);
        $('[id$=shout]').val(0);
        $('[id$=post-title]').val("");
        $('[id$=titlewarning]').hide();
        $('[id$=contentwarning]').hide();
        $('[id$=stickerchoices]').show();
        $('[id$=uploadmedia]').hide();
        
        toggle=p;
        emojisICON();
        

        if(p==="media")
        {
          // $('[id$=img-label]').show();
          // $('[id$=audio-label]').show();
          // $('[id$=video-label]').show();
          // $('[id$=choosepic]').show();
          // $('[id$=choosenote]').show();
          // $('[id$=choosevid]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Post to your album!");
          $('[id$=post-title]').val(" ");
          
          // $('[id$=btnStart]').show();
          // $('[id$=btnStart2]').show();
          $('[id$=uploadmedia]').show();

        }

        if(p==="audio")
        {
          $('[id$=audio-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Post to your sound album!");
          $('[id$=post-title]').val(" ");
        }

        if(p==="video")
        {
          $('[id$=video-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Post to your video album!");
          $('[id$=post-title]').val(" ");
        }
        
        if(p==="text")
        {
          $('[id$=modaltitle]').text("Post on your board!");
          $('[id$=post-title]').val(" ");
          $('[id$=addwarning]').hide();
          
          $('[id$=contentwarning]').hide();
          $('[id$=titlewarning]').hide();
       
        }

        if(p==="shout")
        {
          $('[id$=post-title-container]').show();
          $('[id$=shout]').val(1);
          $('[id$=modaltitle]').text("Post a sticky note!");
          $('[id$=addwarning]').hide();
          
          $('[id$=titlewarning]').hide();
          $('[id$=scissors]').hide();
          $('[id$=stickerchoices]').hide();
          
        }
        
        if(p==="reply")
        {
          $('[id$=uploadmedia]').show();
          $('[id$=addwarning]').hide();
          // $('[id$=btnStart]').show();
          // $('[id$=btnStart2]').show();
          // $('[id$=img-label]').show();
          // $('[id$=audio-label]').show();
          // $('[id$=video-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=reply]').val(1);
          $('[id$=post-title]').val(" ");
          $('[id$=modaltitle]').text("Post a comment!");
          $('[id$=titlewarning]').hide();
          $('[id$=scissors]').show();
        }
        
    }

function keeper(value, stick){
    $('[id$=postester]').val(stick);
    $('[id$=post-content]').val(value + $('[id$=postester]').val());
}

function shareclick()
{
  if(document.getElementById('post-content').value.length>=16000)
  {  
    $('[id$=charLimitMessage4]').show();
  }  
      
  else
  $('[id$=charLimitMessage4]').hide();

  if(document.getElementById('post-title').value=="" && toggle=="shout")
  {
    
    $('[id$=titlewarning]').show();
  }
  else
  {
    
    $('[id$=titlewarning]').hide();
    
  }
  if(document.getElementById('post-content').value=="")
  {
    
    $('[id$=contentwarning]').show();
  }
  else{
    
    $('[id$=contentwarning]').hide();
  }
  if(hasfile!=1 && toggle!="shout" && toggle!="text" && toggle!="reply")
    {
      $('[id$=addwarning]').show();
    }
            
}


  // function showImage(src, target) 
  // {
  //   var fr = new FileReader();

  //   fr.onload = function()
  //   {
  //     // target.src = fr.result;
  //   }

  //   fr.readAsDataURL(src.files[0]);

    
  // }

  // function putImage() 
  // {
  //   var src = document.getElementById("attach-img");
  //   var target = document.getElementById("target");
  //   // showImage(src, target);

  //   if((src.files[0].size * 0.000001) > 1.6)
  //     alert("file too big!");
  // }


    var warningCount=0, count=0;
    // var x = document.getElementById("profanityWarning");
    var charCount1=100, charCount2=16000;
    
//     $('.modal-body').keyup(function(event) 
//     {
        
// //        document.getElementById('charsRemaining3').innerHTML='Characters Left: '+(charCount1-document.getElementById('post-title').value.length);
//         // document.getElementById('charsRemaining4').innerHTML='Characters Left: '+(charCount2-document.getElementById('post-content').value.length);
        
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("❤","❤");
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😞","☹");
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("🙂","🙂");
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😀","😀");
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("XD","🤣");
// //        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😐","😐");

//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("❤","❤");
//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😞","☹");
//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("🙂","🙂");
//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😀","😀");
//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("XD","🤣");
//         document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😐","😐");

//             if(
// //                document.getElementById('post-title').value.includes("fuck")||
// //                document.getElementById('post-title').value.includes("shit")||
//                 document.getElementById('post-content').value.includes("fuck")||
//                 document.getElementById('post-content').value.includes("shit")
//             )
//             {  
// //                  responsiveVoice.speak("Hey there! That's a bad word!","UK English Male",{rate: 1, pitch: 1.2});
// //                  document.getElementById("profanityWarning").innerHTML = 'NO SWEARING!';
//                 // x.style.display = "block";
//                 // document.getElementById('create-post-btn').style.color="red";
//                 // document.getElementById('create-post-btn').innerHTML="You should remove bad words from your message!";
//                 // document.getElementById('create-post-btn').style.pointerEvents="none";
//             }  

//             else
//             {
// //                    document.getElementById("profanityWarning").innerHTML = '';
              
//                 // x.style.display = "none";
//                 document.getElementById('create-post-btn').style.color="#41403E";
//                 document.getElementById('create-post-btn').innerHTML="Share";
//                 document.getElementById('create-post-btn').style.pointerEvents="auto";
//                 if(hasfile==0)
//               {
                
//               }
//             }
// ////              
// //            if(document.getElementById('post-title').value.length>=100)
// //            {  
// //                document.getElementById('charLimitMessage3').style.display = "block";
// //            }  
// //            
// //            else
// //                document.getElementById('charLimitMessage3').style.display = "none";

            
//     });  
</script>
                    
                    <!--camera-->
<!--                    
<script>(function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 320;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;
  

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');

    navigator.getMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    navigator.getMedia(
      {
        video: true,
        audio: false
      },
      function(stream) {
        if (navigator.mozGetUserMedia) {
          video.mozSrcObject = stream;
        } else {
          var vendorURL = window.URL || window.webkitURL;
          video.src = vendorURL.createObjectURL(stream);
        }
        video.play();
      },
      function(err) {
        console.log("An error occured! " + err);
      }
    );
    
    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
      
        // Firefox currently has a bug where the height can't be read from
        // the video, so we will make assumptions if this happens.
      
        if (isNaN(height)) {
          height = width / (4/3);
        }
      
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    startbutton.addEventListener('click', function(ev){
      takepicture();
      ev.preventDefault();
    }, false);
    
    clearphoto();
  }

  // Fill the photo with an indication that none has been
  // captured.

  function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
    
  }
  
  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.

  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
    
      var data = canvas.toDataURL('image/png');
      
    } else {
      clearphoto();
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);
})();</script>-->

    <!-- Begin emoji-picker JavaScript -->
    <script src="<?php echo base_url('lib/js/config.js');?>"></script>
    <script src="<?php echo base_url('lib/js/util.js');?>"></script>
    <script src="<?php echo base_url('lib/js/jquery.emojiarea.js');?>"></script>
    <script src="<?php echo base_url('lib/js/emoji-picker.js');?>"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
    var tempHTML = document.getElementById("dobback").innerHTML; //part of sticker code
    function emojisICON(){    
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
      });}
    function doBack() {//part of sticker code
    document.getElementById("dobback").innerHTML = tempHTML;
    }
    </script>
    
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
<!-- END SCRIPTS -->
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
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">
<!-- Create Post Modal -->
<div id="create-post-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong id="modaltitle">Share to <?php echo utf8_decode($topic->topic_name); ?></strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/post'); ?>" id = "create-post-form" method = "POST">
                <div class="modal-body">
                    
                    
                    
                    <div class="form-group" id="post-title-container"><!-- check if title is already taken -->
                        <!--<label for = "title">Make a title for your post:</label>-->
                        <!--<p class="lead emoji-picker-container">-->
                        <input type="text" style="height: 50px;" maxlength = "100"  required class="form-control" name = "post_title" id = "post-title" placeholder = "My title"  data-emojiable="true" value=""/>
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
                        <textarea class = "form-control" style="height: 100px;" maxlength = "16000" required name = "post_content" id = "post-content" placeholder = "My thoughts" data-emojiable="true"></textarea>
                        <!--<p id="charsRemaining4">Characters Left: 16000</p>-->
                        <div class="charLimitMessage" id="charLimitMessage4"><center>Oops! You've used up all the letters and numbers for your message!</center></div>
                    </div>
                    
                   <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div>

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
                         
                         <br><br>
                         
                    <div id = "attachment-buttons" class = "form-group">
                      <!--<img id="target"/>-->
                        <!-- Attach a file: -->
                        <!--IMAGE-->
                        <label id = "img-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;">
                            <p id = "image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Picture</p>
                        </label>

                        <!--AUDIO-->
                        <label id = "audio-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;">
                            <p id = "audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Sound</p>
                        </label>

                        <!--VIDEO-->
                        <label id = "video-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;">
                            <p id = "video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        <!--FILE-->
                        <!-- <label id = "file-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-file" type="file" name = "post_file" style = "display: none;">
                            <p id = "file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label> -->

                    </div>
                    <div id = "attachment-preview" class = "content-container">
                        <h5 id = "attachment-message" class = "text-warning text-center">No attachment yet.</h5>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <a id = "create-post-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" onClick="putImage()">Share</a>
                </div>
            </form>

            <div style="display: none">
                    <button id="btnStart">Record My Voice!</button>
                    <button id="btnStop">Im done recording!</button></p>
        
                    
                    <audio id="vid2" controls></audio><br>
        
                    <a id="dl"  download>download</a>

            </div>

        </div>
    </div>
</div>

<!-- SCRIPTS -->
<!--PROFANITY FILTER and character limit counter-->
 <!--<script src="https://code.responsivevoice.org/responsivevoice.js"></script>-->


<script>

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
            let vidSave = document.getElementById('vid2');
            let mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = [];
            
            start.addEventListener('click', (ev)=>{
                mediaRecorder.start();
                console.log(mediaRecorder.state);
                
            })
            stop.addEventListener('click', (ev)=>{
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

            }
        })
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });
        
///////////////

    function toggleButton(p)
    {
        $('[id$=img-label]').hide();
        $('[id$=audio-label]').hide();
        $('[id$=video-label]').hide();
        $('[id$=attachment-preview]').hide();
        $('[id$=post-title-container]').hide();
        $('[id$=reply]').val(0);
        $('[id$=shout]').val(0);
        $('[id$=post-title]').val("");
        

        if(p==="media")
        {
          $('[id$=img-label]').show();
          $('[id$=audio-label]').show();
          $('[id$=video-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Add stuff");
          $('[id$=post-title]').val(" ");
        }

        if(p==="audio")
        {
          $('[id$=audio-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Add to your sound album");
          $('[id$=post-title]').val(" ");
        }

        if(p==="video")
        {
          $('[id$=video-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=modaltitle]').text("Add to your video album");
          $('[id$=post-title]').val(" ");
        }
        
        if(p==="text")
        {
          $('[id$=modaltitle]').text("Add to diary");
          $('[id$=post-title]').val(" ");
        }

        if(p==="shout")
        {
          $('[id$=post-title-container]').show();
          $('[id$=shout]').val(1);
          $('[id$=modaltitle]').text("Give a shout out!");
        }
        
        if(p==="reply")
        {
          $('[id$=img-label]').show();
          $('[id$=audio-label]').show();
          $('[id$=video-label]').show();
          $('[id$=attachment-preview]').show();
          $('[id$=reply]').val(1);
          $('[id$=post-title]').val(" ");
          $('[id$=modaltitle]').text("Share it on the chat room");
        }
        
    }

</script>


<script type="text/javascript">


  function showImage(src, target) 
  {
    var fr = new FileReader();

    fr.onload = function()
    {
      // target.src = fr.result;
    }

    fr.readAsDataURL(src.files[0]);

    
  }

  function putImage() 
  {
    var src = document.getElementById("attach-img");
    var target = document.getElementById("target");
    // showImage(src, target);

    if((src.files[0].size * 0.000001) > 1.6)
      alert("file too big!");
  }


    var warningCount=0, count=0;
    var x = document.getElementById("profanityWarning");
    var charCount1=100, charCount2=16000;
    
    $('.modal-body').keyup(function(event) 
    {
        
//        document.getElementById('charsRemaining3').innerHTML='Characters Left: '+(charCount1-document.getElementById('post-title').value.length);
        document.getElementById('charsRemaining4').innerHTML='Characters Left: '+(charCount2-document.getElementById('post-content').value.length);
        
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("❤","❤");
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😞","☹");
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("🙂","🙂");
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😀","😀");
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("XD","🤣");
//        document.getElementById('post-title').value=document.getElementById('post-title').value.replace("😐","😐");

        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("❤","❤");
        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😞","☹");
        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("🙂","🙂");
        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😀","😀");
        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("XD","🤣");
        document.getElementById('post-content').value=document.getElementById('post-content').value.replace("😐","😐");

            if(
//                document.getElementById('post-title').value.includes("fuck")||
//                document.getElementById('post-title').value.includes("shit")||
                document.getElementById('post-content').value.includes("fuck")||
                document.getElementById('post-content').value.includes("shit")
            )
            {  
//                  responsiveVoice.speak("Hey there! That's a bad word!","UK English Male",{rate: 1, pitch: 1.2});
//                  document.getElementById("profanityWarning").innerHTML = 'NO SWEARING!';
                x.style.display = "block";
                document.getElementById('create-post-btn').style.background="red";
                document.getElementById('create-post-btn').innerHTML="You should remove bad words from your message!";
                document.getElementById('create-post-btn').style.pointerEvents="none";
            }  

            else
            {
//                    document.getElementById("profanityWarning").innerHTML = '';
                x.style.display = "none";
                document.getElementById('create-post-btn').style.background=getCookie("ButtonColor");
                document.getElementById('create-post-btn').innerHTML="Share";
                document.getElementById('create-post-btn').style.pointerEvents="auto";
            }
////              
//            if(document.getElementById('post-title').value.length>=100)
//            {  
//                document.getElementById('charLimitMessage3').style.display = "block";
//            }  
//            
//            else
//                document.getElementById('charLimitMessage3').style.display = "none";

            if(document.getElementById('post-content').value.length>=16000)
            {  
                document.getElementById('charLimitMessage4').style.display = "block";
            }  
                
            else
                document.getElementById('charLimitMessage4').style.display = "none";

    });  
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
    
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
<!-- END SCRIPTS -->
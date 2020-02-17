<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Play Modal -->
<head>

</head>

<div id="room_media_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <!-- Play Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <h4 class="modal-title text-center textoutliner"><strong>My Stuff</strong></h4>
                <?php else: ?>
                <h4 class="modal-title text-center textoutliner"><strong><?php echo utf8_decode($c_topic->user->first_name); ?>'s Stuff</strong></h4>
                <?php endif; ?>
            </div>
            
            <div class="modal-body content-container container-fluid">
                <div class="mediapreview" style="display: block;">
                <?php $previewcount=1; $mediacount=0;
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                <?php foreach ($attachments as $attachment):
                                    if ($attachment->attachment_type_id === '1'):?>
                                    <img class="dot blocks3 clicker" onclick="currentSlide(<?php echo $previewcount ?>)" src = "<?= base_url($attachment->file_url); ?>" width = "10%" height="10%" style="vertical-align:baseline" />
                                <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                        <audio class="dot blocks3 clicker" onclick="currentSlide(<?php echo $previewcount ?>)" src = "<?= base_url($attachment->file_url); ?>" style="width:8%"  controls></audio>
                                <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                        <video class="dot blocks3 clicker" onclick="currentSlide(<?php echo $previewcount ?>)" src = "<?= base_url($attachment->file_url); ?>" width = "10%" height="10%" autoplay loop muted></video>
                                <?php 
                                    endif;
                                    $previewcount++;
                                    $mediacount++;
                                endforeach; ?>

                        <?php endif; endforeach; 
                        if($mediacount==0):?>
                            <center><h2>There's no stuff yet.</h2></center>
                        <?php endif;?>
                </div>
                <br>
                <center>
                <?php if($mediacount>1):?>
                <button id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" onclick="minusSlides(1)" style="font-size:22px">< Previous</button>
                <!--<p><?php echo $previewcount+1?></p>    total number of media posts-->
                <button id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" onclick="plusSlides(1)" style="font-size:22px">Next ></button>
                <?php endif;?>
                </center>
                <div id="Mposts" class = "row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                         <?php
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <div class="mySlides fader " >
                                                            <div class="whitebg">
<!--                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>--><hr>
                                                                <span class = "text-muted" style="position:absolute;right: 0"> <i style = "font-size: 18px;"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                                <br>
                                                            <div class=" polaroidwrapper">
                                                                <p id="Mpostss"><?php echo utf8_decode($post->post_content); ?></p>
                                                                <img src = "<?= base_url($attachment->file_url); ?>" width = "55%"  style="position:relative;" />
                                                            </div>
                                                            </div>
                                                        </div>
                                                <?php elseif ($attachment->attachment_type_id === '2'):?>
                                                        <div class="mySlides fader " >
                                                            <div class="whitebg">
<!--                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>--><hr>
                                                            <span class = "text-muted" style="position:absolute;right: 0"> <i style = "font-size: 18px;"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                            <br>
                                                            <div class=" polaroidwrapper">
                                                                <p id="Mpostss"><?php echo utf8_decode($post->post_content); ?></p>
                                                                <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 65%" controls></audio>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php elseif ($attachment->attachment_type_id === '3'):?>
                                                        <div class="mySlides fader ">
                                                            <div class="whitebg">
<!--                                                            <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                            <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name;?></a></small>
                                                            <br>--><hr>
                                                            <span class = "text-muted" style="position:absolute;right: 0"> <i style = "font-size: 18px;"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                                            <br>
                                                            <div class=" polaroidwrapper">
                                                                <p id="Mpostss"><?php echo utf8_decode($post->post_content); ?></p>
                                                                <video src = "<?= base_url($attachment->file_url); ?>" width = "55%" controls/></video>
                                                            </div>
                                                            </div>
                                                        </div>
                    
                    
                                                <?php 

                                                    endif;
                                                endforeach;

                                                ?>
                        
                        <?php endif; endforeach; ?>
                    
                    
                </div>
                <center>
                <?php if($mediacount>1):?>
                <button id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" onclick="minusSlides(1)" style="font-size:22px">< Previous</button>
                <button id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" onclick="plusSlides(1)" style="font-size:22px">Next ></button>
                <?php endif;?>
                </center>
                <script>
                    document.addEventListener('keydown', function(eve) {
                      if (eve.keyCode === 37) { //left arrow
                        minusSlides(1);
                      }
                      if(eve.keyCode === 39){ //right arrow
                         plusSlides(1);
                      }
                    });
                    //var slideIndex = 0;
                    //showSlides();
                    
                    var slideIndex = 1;
                    showSlides(slideIndex);

                    function plusSlides(n) {
                      showSlides(slideIndex += n);
                    }
                    function minusSlides(n) {
                      showSlides(slideIndex -= n);
                    }

                    function currentSlide(n) {
                      showSlides(slideIndex = n);
                    }
                    function showSlides(n) {
                      var i;
                      var slides = document.getElementsByClassName("mySlides");
                      var dots = document.getElementsByClassName("dot");
                      if (n > slides.length) {slideIndex = 1}    
                      if (n < 1) {slideIndex = slides.length}
                      for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                      }
                      for (i = 0; i < dots.length; i++) {
                          dots[i].className = dots[i].className.replace(" selected3", "");
                      }
                      if(slides[slideIndex-1] !== null)
                        slides[slideIndex-1].style.display = "block";  
                      dots[slideIndex-1].className += " selected3";  
                    //  slideIndex++;
                    //  if (slideIndex > slides.length) {slideIndex = 1};
                    //  slides[slideIndex-1].style.display = "block";  
                    //  setTimeout(showSlides, 2000); // Change image every 2 seconds
                    }
                    function getslideIndex(){
                        return slideIndex;
                    }
            </script>
            </div>
        </div>
    </div>
</div>
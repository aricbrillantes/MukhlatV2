<?php
// $topic = $_SESSION['current_topic'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url('lib/css/emoji.css'); ?>" rel="stylesheet">

<!-- Create Announcement Modal -->
<div id="create-announcement-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Announcement Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Announcement</strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/announcement'); ?>" id = "create-announcement-form" method = "POST">
                <div class="modal-body">

                    <div class="form-group" ><!-- check if description exceeds n words-->
                        <!--<label for = "content">Make the content of your post:</label>-->
                        <!--<p class="lead emoji-picker-container">-->
                        <textarea class = "form-control" style="height: 100px;" maxlength = "200" required name = "announcement_content" id = "announcement-content" placeholder = "Write your announcement here:" ></textarea>
                        <!-- <p id="charsRemaining4">Characters Left: 16000</p> -->
                        
                    </div><br>
                    <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                        <button id = "create-announcement-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" >Share</button>
                    </div>
                    
                    <h4>Previous Announcements:</h4>
                     <?php 
                            //load models
                            $CI->load->model('topic_model');
                            $CI->load->model('user_model');

                            //get announcements
                            $announcements = $CI->topic_model->get_announcements();

                            //get teacher's details for each announcement
                            foreach ($announcements as $announcement):

                                $details = $CI->user_model->view_adult($announcement->user_id);

                                foreach ($details->result() as $teacher) //store teacher's details in array
                                    $data['user'] = $CI->user_model->get_details(true, true, array('user_id' => $announcement->user_id));
                                
                        ?>

                            <li class = "list-group-item admin-list-item">
                                <h5 class = "no-padding admin-list-name">Teacher <?php echo $teacher->first_name?> says: </h5> <br>
                                <h4 class = "no-padding admin-list-name">"<?php echo $announcement->announcement ?>"</h4>
                            </li>                                    
                       
                        <?php endforeach; ?>
                         
                    <!-- <div id = "attachment-buttons" class = "form-group">
                      
                        <label id = "img-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;" onchange="readURL(this);">
                            <p id = "image-text" class = "attach-btn-text"><i class = "fa fa-file-image-o"></i> Add Picture</p>
                        </label>

                        <label id = "audio-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;" onchange="readAud(this);">
                            <p id = "audio-text" class = "attach-btn-text"><i class = "fa fa-file-audio-o"></i> Add Sound</p>
                        </label>

                        <label id = "video-label" class="btn btn-primary buttonsbgcolor borderbuttonoutline">
                            <input id = "attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;" onchange="readVid(this);">
                            <p id = "video-text" class = "attach-btn-text"><i class = "fa fa-file-video-o"></i> Add Video</p>
                        </label>

                        

                    </div> -->


                    <!-- <img id="pic" src="#" style="display: none" width="400" /> -->
              <!-- <audio id="aud" style="display: none" controls>
              <source src="#" id="audio_here">
              hi
              </audio>
              <video id="vid" width="400" style="display: none" controls>
                  <source src="#" id="video_here">
                  hi
              </video>  
              <h2 id="pic_h" style="display: none">The picture you used is too big sorry!</h2>
              <h2 id="vid_h" style="display: none">The video you used is too big sorry!</h2>
              <h2 id="snd_h" style="display: none">The sound you used is too big sorry!</h2>
                </div> -->



                
                

            </form>
            
        </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<!--PROFANITY FILTER and character limit counter-->
 <!--<script src="https://code.responsivevoice.org/responsivevoice.js"></script>-->




    
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
<!-- END SCRIPTS -->
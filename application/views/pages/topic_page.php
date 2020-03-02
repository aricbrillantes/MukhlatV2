<?php
    include(APPPATH . 'views/header.php');
    
    if(isset($_SESSION['current_topic']))
        $c_topic = $_SESSION['current_topic'];

    $CI =&get_instance();
    $CI->load->model('attachment_model');
    
    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    
?>



    <?php
        include(APPPATH . 'views/navigation_bar.php'); ?>
       <?php 
        $nameframe ="#".$c_topic->nameframe;
//        if(strlen(dechex(hexdec($c_topic->nameframe)+6190))==6 && strlen(dechex(hexdec($c_topic->nameframe)-6190))==6):
//        $nameframe2 ="#". dechex(hexdec($c_topic->nameframe)+6190);
//        $nameframe3 ="#". dechex(hexdec($c_topic->nameframe)-6190);
//        else:
//        $nameframe2 = $nameframe;          
//        $nameframe3 = $nameframe;
//        endif;
        $chatbox ="#".$c_topic->chatbox;
        $memo ="#".$c_topic->shoutout;
        $board="#".$c_topic->board;
        $bulletin ="#".$c_topic->bulletin;
        $media ="#". $c_topic->media;
        if(strlen(dechex(hexdec($c_topic->media)+6190))==6 && strlen(dechex(hexdec($c_topic->media)-6190))==6):
        $media2 ="#". dechex(hexdec($c_topic->media)+6190);
        $media3 ="#". dechex(hexdec($c_topic->media)-6190);
        else:
        $media2 = $media;          
        $media3 = $media;
        endif;
        $wallpaper="";
        if($c_topic->theme=="1"): $theme="roomtheme-arrow";
        elseif($c_topic->theme=="2"): $theme="roomtheme-zigzag";
        elseif($c_topic->theme=="3"): $theme="roomtheme-scales";
        elseif($c_topic->theme=="4"): $theme="roomtheme-halfrhombe";
        elseif($c_topic->theme=="5"): $theme="roomtheme-marrakesh";
        elseif($c_topic->theme=="6"): $theme="roomtheme-hearts";
        elseif($c_topic->theme=="7"): $theme="roomtheme-stars";
        elseif($c_topic->theme=="8"): $theme="roomtheme-seigaiha";
        elseif($c_topic->theme=="9"): $theme="roomtheme-bricks";
        elseif($c_topic->theme=="10"): $theme="roomtheme-diacheckerboard";
        elseif($c_topic->theme=="11"): $theme="roomtheme-tablecloth";
        elseif($c_topic->theme=="12"): $theme="roomtheme-brady";
        elseif($c_topic->theme=="13"): $theme="roomtheme-argyle";
        elseif($c_topic->theme=="14"): $theme="roomtheme-shippo";
        elseif($c_topic->theme=="15"): $theme="roomtheme-waves";
        elseif($c_topic->theme=="16"): $theme="roomtheme-polkadot";
        elseif($c_topic->theme=="17"): $theme="roomtheme-honeycomb";
        elseif($c_topic->theme=="18"): $theme="roomtheme-chocolateweave";
        elseif($c_topic->theme=="19"): $theme="roomtheme-crosseddot";
        else: $theme="dooroom"; $wallpaper="background-color: #".$c_topic->theme;
        endif;?>
<body class="row <?php echo $theme?> " style=";overflow-x: hidden;<?php echo $wallpaper?>;">
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:20px;"> 
        <!--<div id = "topic-page" class = "container page" style = "min-height: 100%; height: 100%;">test</div>-->
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 col-xl-12"> 
            
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="nameframe" style="margin-top:62px; margin-left: -10px;margin-bottom: 15px; border-color: <?php echo $nameframe?>">
                    <br>
            <h4><strong><?php echo utf8_decode($c_topic->user->first_name); ?>'s Room</strong></h4>
            </div>
                    <br>
<!--<strong>Theme: <?php echo utf8_decode($c_topic->theme); ?></strong>-->
            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="#edit-topic-modal" data-toggle = "modal" style="min-width:20%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> Redecorate room</a>
            <?php endif;?>
                </div>
            <div id="chalkb" class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 chalkboard" style="min-height:200px; max-height:200px;margin-top: 60px;border-color: <?php echo $board?>">
                    <?php
                        foreach ($c_topic->posts as $post):
                            if($post->shout==0 && $post->reply==0):?>
                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                    <?php if(!$attachments):?>
                            <p style = "border-right: none; max-width: 714px;padding: 3%;max-height: 50%;font-family: KGChasingPavements;"><?php echo utf8_decode($post->post_content); ?>
                                                <button class = "btn btn-primary pull-right" id="text2speak" style = "margin-right: 3px;border-radius: 20px;" onclick="readcontent('<?php $stringy = utf8_decode($post->post_content); $stringy1 = str_replace('\'', '`', $stringy); echo trim(preg_replace('/[^A-Za-z0-9()#,%\/?@$*.:+=_~`-]/', ' ', $stringy1)); ?>')"><i class="glyphicon glyphicon-volume-up" style="padding-top: 5px;"></i></button></p>
                    <?php endif;
                          endif;
                          endforeach; ?>
                            
                    </div>
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <button onmouseenter="playclip()" onclick="toggleButton('text')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner pull-right" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;">My Board</button><br><br>
                <?php endif;?>
        </div>
            
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 col-xl-12">
                <?php if($mobile):?>
                    <div class="hidertab">
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6 col-xl-6" style="margin-top:50px">
                            <a onmouseenter="playclip()"  href="#view-announcements-modal" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/whiteboard.png'); ?>" class="iconin" style="width:60%;height:auto"/><!Style></p>
                                <!--<span class ="btn btn-primary buttonsbgcolor textoutliner" style="width:140px">Announcements</span>-->
                            </a>
                        </div>
                        <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6 col-xl-6" style="margin-top:50px"> 
                            <a onmouseenter="playclip()" href="#view-notes-modal" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/parentnotes.png'); ?>" class="iconin" style="width:60%;height:auto"/><!Style></p>
                                <!--<span class ="btn btn-primary buttonsbgcolor textoutliner">Guardian's Notes</span>-->
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
            <?php endif;?>
                
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 col-xl-12"> 
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3  hider" style="min-width: 450px !important;">
            
                
                <div class="white-board" style="min-height:50%; max-height:195px;border-color: <?php echo $bulletin?>">
                        <?php 
                    //load models
                    $CI =&get_instance();
                    $CI->load->model('topic_model');
                    $CI->load->model('user_model');

                    //get announcements
                    $announcements = $CI->topic_model->get_announcements();
                    if(empty($announcements)):?>
                        
                    <h4>You have no teacher announcements yet.</h4>
                    <?php endif;?>
                    
                    <?php
                    //get teacher's details for each announcement
                    foreach (array_reverse($announcements) as $announcement):

                        $details = $CI->user_model->view_adult($announcement->user_id);

                        foreach ($details->result() as $teacher): //store teacher's details in array
                            $data['user'] = $CI->user_model->get_details(true, true, array('user_id' => $announcement->user_id));
                        
                ?>

                    <li class = ""><!--<h4 class = "no-padding admin-list-name">Teacher <?php echo $teacher->first_name?> says: </h4>--> 
                        <h5 class = "no-padding admin-list-name">"<?php echo utf8_decode($announcement->announcement) ?>"</h5>
                    </li>
                    <?php  endforeach; endforeach; ?>
                    </div>
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <div class="white-board" style=" min-height:50%; max-height:195px;border-color: <?php echo $bulletin?>">
                        
                    <?php 
                    $CI =&get_instance();
                    $CI->load->model('user_model'); //load models
                    $notes = $CI->user_model->get_notes($logged_user->user_id); //get notes
                    if(empty($notes)):?>
                        
                    <h4>You have no guardian messages yet.</h4>
                    <?php endif;?>
                    
                    <?php
                    foreach (array_reverse($notes) as $note): ?>

                    <div class = "">
                        <!--<h4 class = "no-padding admin-list-name"><?php echo $teacher->first_name?> says: </h4>--> 
                        <h4 class = " admin-list-name"><?php echo utf8_decode($note->note) ?></h4>
                    </div>
                                                       
                    <?php endforeach; ?>
                    </div>
                <?php endif;?>
            </div>
            
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3"> <div class="hider"><br><br></div>
                <a class="picture" href="#room_media_modal" data-toggle = "modal" style="color: black">
                    <div style="margin-left: 60px;">
                    <figure class="boxside boxtop" style="background-color: <?php echo $media2?>"><i class = "glyphicon glyphicon-picture fa-2x" style="margin-top: 25px"></i></figure>
                    <figure class="boxside boxleft" style="background-color: <?php echo $media?>"><i class = "glyphicon glyphicon-volume-up fa-2x" style="margin-top: 25px"></i></figure>
                    <figure class="boxside boxright" style="background-color: <?php echo $media3?>"><i class = "fa fa-play fa-2x" style="margin-top: 25px"></i></figure>
                    </div>
                    <!--<div class="hook"></div>-->
<!--                    <div class="frame">
                        <div class="inside"><strong><center>Pictures</center></strong>-->
                        
<!--            </div>
                    </div>-->
                </a>
                
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <button onmouseenter="playclip()" onclick="toggleButton('media')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top:210px; margin-left: 75px">My Album</button><br><br>
                <?php endif;?>

            </div>
                
                <!--Shout out-->
            <ul class="stickynote col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">
               <li class="stickytext">
                   <a href="#room_shout_modal" data-toggle = "modal" class="stickyact" style="background: <?php echo $memo?>">
                        <?php
                            foreach ($c_topic->posts as $post):
                                if($post->shout==1):?>
                            
                    <h2><?php echo utf8_decode($post->post_title); ?></h2>
                    <p><?php echo utf8_decode($post->post_content); ?></p>
                    <?php break; endif; endforeach; ?>

                  </a>
                </li>

            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <button onmouseenter="playclip()" onclick="toggleButton('shout')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top: 2%;margin-left: 50px; margin-right: 100%">My Sticky Notes</button><br><br>
                <?php endif;?>
            </ul>
                
            
            
        </div>
            
<!--            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 col-xl-12"> 
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 hider">

                <div class = "pad-header"><span class="textoutliner" style="color:white;margin:28%">Guardian's notes</span></div>
                <div class = "pad">
                    <div class="padol">
                <?php 
                    $CI =&get_instance();
                    $CI->load->model('user_model'); //load models
                    $notes = $CI->user_model->get_notes($logged_user->user_id); //get notes

                    foreach (array_reverse($notes) as $note): ?>

                    <div class = "padli">
                        <h3 class = " admin-list-name"><?php echo utf8_decode($note->note) ?></h3>
                    </div>
                                                       
                <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            Pictures
            
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 hider">
                <div class="mystuffpreview">
            <?php 
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                <?php foreach ($attachments as $attachment):
                                    if ($attachment->attachment_type_id === '1'):?>
                                        <img class="mySlides fader" src = "<?= base_url($attachment->file_url); ?>" width = "100%" height="100%"  style="position:relative;" />
                                <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                        <audio class="mySlides fader" src = "<?= base_url($attachment->file_url); ?>" style="width:100%"  controls></audio>
                                <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                        <video class="mySlides fader" src = "<?= base_url($attachment->file_url); ?>" width = "100%" height="100%" controls/></video>
                                <?php 
                                    endif;
                                endforeach; ?>

                        <?php endif; endforeach; ?>
                </div>
              </div>
                
                
                
                regular text, emojis and stickers
                <div> <div class="hideinbig"><br><br><br><br><br><br><br><br><br></div>
                <div id="chalkb" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 pull-right chalkboard" style="min-height:300px; max-height:300px;">
                    <?php
                        foreach ($c_topic->posts as $post):
                            if($post->shout==0 && $post->reply==0):?>
                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                    <?php if(!$attachments):?>
                            <p style = "border-right: none; max-width: 714px;padding: 3%;max-height: 50%;font-family: KGChasingPavements"><?php echo utf8_decode($post->post_content); ?>
                                                <button class = "btn btn-primary pull-right" id="text2speak" style = "margin-right: 3px;border-radius: 20px;" onclick="readcontent('<?php $stringy = utf8_decode($post->post_content); $stringy1 = str_replace('\'', '`', $stringy); echo trim(preg_replace('/[^A-Za-z0-9()#,%\/?@$*.:+=_~`-]/', ' ', $stringy1)); ?>')"><i class="glyphicon glyphicon-volume-up" style="padding-top: 5px;"></i></button></p>
                    <?php endif;
                          endif;
                          endforeach; ?>
                            
                    </div>
            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <center> <button onmouseenter="playclip()" onclick="toggleButton('text')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-left: 58%;margin-top: 1%">My Board</button></center><br><br>
                <?php endif;?></div>
            </div>  -->
        </div>
        
        <div class="" >
    <!--<div class = "home-sidebar content-container" style="background:darkgray;">-->
    <!--Header-->

    <!-- Topic Post List -->
                    
    <div id="messageb" class = "topic-post-list col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3" style = "padding-top:70px; background-color: <?php echo $chatbox?>">
        <!--<div class = "list-group" style = "padding-top: 15%">-->
           <!--List Entry--> 
           <?php $chatcount=0;
           foreach ($c_topic->posts as $post):
                                    if($post->reply==1):
                                        $chatcount++;
            ?>
            <!--<a href = "javascript: void(0);" class = "btn btn-link list-group-item list-entry no-up-down-pad topic-post-entry" data-value = "<?php echo $post->post_id; ?>">-->
          
           <!--if logged user sent the message-->
           <?php if ($post->user->user_id === $logged_user->user_id): ?> 
           <div class = "col-xs-11 messagesender">
          
          <!--if another user sent message-->
           <?php else: ?> 
           <div class = "col-xs-11 messagereceiver">
           <?php endif;?>
            
            <div>
                <a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><img class = "img-circle nav-prof-pic iconin" src = "<?php echo $post->user->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/></a>
                <h4 class = "ellipsis"><strong><?php echo utf8_decode($post->post_title); ?></strong> 
                    <small><a href="<?php echo base_url('user/profile/' . $post->user_id); ?>"><?php echo $post->user->first_name . " " . $post->user->last_name; ?></a></small></h4>
                    <hr>
                <p style="white-space: pre-wrap;"><?php echo utf8_decode($post->post_content); ?></p>
            </div>
        <!--                                    <div class = "col-xs-3 text-center" style = "padding: 0px;">
        <p style = "padding-top: 10px; font-size: 18px !important;color: #78909C;"><i><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></p>
        </div>-->
        

        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);

                        // print_r($attachments);

        foreach ($attachments as $attachment):
            if ($attachment->attachment_type_id === '1'):?>
                <img src = "<?= base_url($attachment->file_url); ?>" width="200px"/>

                <?php elseif ($attachment->attachment_type_id === '2'): ?>
                <audio src = "<?= base_url($attachment->file_url); ?>" style="width:200px"  controls></audio>

                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                        <video src = "<?= base_url($attachment->file_url); ?>" width = "200px" controls/></video>

                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>

                            <?php 

                        endif;
                    endforeach;
                    
                    ?> 
                    </div>
                    <!--                                </a>-->
                    <?php 
                endif;
                endforeach; 
                if($chatcount==0):?>
                    <center><h2 class="messagereceiver">Be the first to say something.</h2></center>
                <?php endif;?>
                <!--</div>-->
            </div>
        <div>
            
                <button onmouseenter="playclip()" onclick="toggleButton('reply')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px">Say something</button>
           
        </div>
           
           <!--Direct post modal for chatting-->
           
<!--    <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/post'); ?>" id = "create-post-form" method = "POST">
                <div class="modal-body">
                    
                    
                    
                    <div class="form-group" id="post-title-container"> check if title is already taken 
                        <label for = "title">Make a title for your post:</label>
                        <p class="lead emoji-picker-container">
                        <h3 id="titlewarning" style="display: none;color:red;"><i class="arrow down"></i> Add a title here! <i class="arrow down"></i></h3>
                        <p class="emoji-picker-container"><input class="title-text" type="text" style="height: 50px;background:transparent;outline:none;border:none;" maxlength = "100"  required class="form-control" name = "post_title" id = "post-title"  placeholder = "My title"  data-emojiable="true" value=" " required /></p>
                        <p id="charsRemaining3">Characters Left: 100</p>
                        <div class="charLimitMessage" id="charLimitMessage3"><center>Oops! You've used up all the letters and numbers for your title!</center></div>
                        <span id="start_button" onclick="startDictation2(event)" style="display: inline-block;"><img border="0" alt="Start" id="start_img" src="https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif"></span>
                            <a href="#" class="voicesearch" id="voicesearch" onclick="stopDictation2(event)"><img border="0" id="voicesearchicon" class="voicesearchicon" alt="START" src="images/microphone_start.png" height="50" width="50"></a>
                            <button onclick="startDictation2(event)">Try it</button>
                    </div>
                    
                    <div style="display: none">
                        <input maxlength = "1"  required class="form-control" name = "reply" id = "reply"  value="1"/>
                        <input maxlength = "1"  required class="form-control" name = "shout" id = "shout"  value="0"/>
                    </div>
                    
                    
                    <div id="results" style="display: none" border="1px">
                        <span id="final_span2" class="final"></span>
                        <span id="interim_span2" class="interim"></span>
                    </div>
                    
                    <div class="form-group" > check if description exceeds n words
                        <label for = "content">Make the content of your post:</label>
                        <p class="lead emoji-picker-container">
                        <h3 id="contentwarning" style="display: none;color:red;"><i class="arrow down"></i> Write your thoughts here! <i class="arrow down"></i></h3>
                        <p id="dobback" class="emoji-picker-container"><textarea class = "form-control" style="height: 100px;background:transparent;outline:none;border:none;" maxlength = "16000" required name = "post_content" id = "post-content" placeholder = "My thoughts" data-emojiable="true" required></textarea></p>
                        <textarea id="postester" style="display: none"></textarea>
                        <p id="charsRemaining4">Characters Left: 16000</p>
                        <div class="charLimitMessage" id="charLimitMessage4"><center>Oops! You've used up all the letters and numbers for your message!</center></div>
                    </div>
            <div id="stickerchoices">     
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
                    
                    <div class="profanityWarning" id="profanityWarning"><center>Hey there! It looks like you used a bad word!</center></div> 

                    <div data-toggle="collapse" data-target="#camera" class="dropbtn" style = "background: #D7eadd; cursor: pointer;"><center><div>Take Picture</div>
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
                        </div>
                        
            <div id="scissors"></div>
            <label id = "record-label" >
            <button type="button" id="btnStart" class="drawnbutton lined thin" onclick="recordaudio();"><img src="http://localhost/MukhlatV2/icons/mic.png" style="display:block;margin: 0 auto;margin-bottom: 15px;margin-top: 10px"></img>Tick Talk!</button>
            <button type="button" id="btnStart2" class="drawnbutton lined thin" onclick="recordvideo();"><img src="http://localhost/MukhlatV2/icons/Recordvid.png" style="display:block;margin: 0 auto;"></img>Video Time!</button>
            <br>
            <h4 id="startrec" style="display: none;text-align:center;">You are now recording!</h4>

            <div id="recaud" style="display: none">
                    
                    
        
                    
                    <audio id="aud1" controls></audio><br>
                    <div style="text-align: center;">
                    <button type="button" id="btnStop" class="drawnbutton dashed thick">Im done recording!</button>
                    <button id="dlbutton" class="drawnbutton dashed thick"  style="display: none;"><a id="dl" download="My Voice">Save my Voice</a></button>
                    </div>
            </div>
            
            <div id="recvid" style="display: none">
                    <video width="400" id="vidprev"  controls muted></video><br>
                    
        
                    
                    <video width="400" id="vid1" style="display: none" controls></video><br>
                    <div style="text-align: center;">
                    <button type="button" id="btnStop2" class="drawnbutton dashed thick">Im done recording!</button>
                    <button id="dl2button" class="drawnbutton dashed thick"  style="display: none;"><a id="dl2"  download="My Video" style="text-decoration: none;">Save my Video</a></button>
                    </div>

            </div>
            <br>
            </label>
            <div id="scissors-mid"></div>
                         
                         
                    <div id = "attachment-buttons" class = "form-group">
                      <img id="target"/>
                         Attach a file: 
                        IMAGE
                        <label id = "img-label" class="drawnbutton dotted thin">
                            <input id = "attach-img" accept = "image/*" type="file" name = "post_image" style = "display: none;" onchange="fileAdded();readURL(this);">
                            <p id = "image-text" class = "attach-btn-text" style="text-align: center;"><img src="http://localhost/MukhlatV2/icons/pic.png" style="display:block;margin: 0 auto;"> Pix </p>
                        </label>

                        AUDIO
                        <label id = "audio-label" class="drawnbutton dotted thin">
                            <input id = "attach-audio" accept = "audio/*" type="file" name = "post_audio" style = "display: none;" onchange="fileAdded();readAud(this);">
                            <p id = "audio-text" class = "attach-btn-text" style="text-align: center;"><img src="http://localhost/MukhlatV2/icons/note.png" style="display:block;margin: 0 auto;"> Sounds </p>
 
                        </label>

                        VIDEO
                        <label id = "video-label" class="drawnbutton dotted thin">
                            <input id = "attach-video" accept = "video/*" type="file" name = "post_video" style = "display: none;" onchange="fileAdded();readVid(this);">
                            <p id = "video-text" class = "attach-btn-text" style="text-align: center;"><img src="http://localhost/MukhlatV2/icons/video.png" style="display:block;margin: 0 auto;"> Vids </p>
                        </label>

                        FILE
                         <label id = "file-label" class="btn btn-primary buttonsbgcolor">
                            <input id = "attach-file" type="file" name = "post_file" style = "display: none;">
                            <p id = "file-text" class = "attach-btn-text"><i class = "fa fa-file-o"></i> Add File</p>
                        </label> 

                    </div>
                    <img id="pic" src="#" style="display: none" width="400" />
              <audio id="aud" style="display: none" controls>
              <source src="#" id="audio_here">
              hi
              </audio>
              <video id="vid" width="400" style="display: none" controls>
                  <source src="#" id="video_here">
                  hi
              </video>  
              <h2 id="addwarning" style="display:none;color:red;" ><i class="arrow up"></i> add something to share! </h2>
              <h2 id="pic_h" style="display: none">The picture you used is too big, sorry!</h2>
              <h2 id="vid_h" style="display: none">The video you used is too big, sorry!</h2>
              <h2 id="snd_h" style="display: none">The sound you used is too big, sorry!</h2>
              
              
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <button class="drawnbutton lined thick"><a id = "create-post-btn" style="font-size: 30px;text-decoration: none;" data-toggle = "modal" onclick="shareclick()" >Share</a></button>
                </div>
                

            </form>-->
           
           
</div>
</div>
    
    
    <!--for deletion in the future-->
<!--        <div class="doorroom col-sm-12 col-md-11">
            <div class="wrapper col-sm-3">
                <a class="picture" href="#room_sounds_modal" data-toggle = "modal">
                    <div class="hook"></div>
                    <div class="frame">
                        <div class="inside"><strong><center>Sounds</center></strong></div>
                    </div>
                </a>

                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <button onmouseenter="playclip()" onclick="toggleButton('audio')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top: 2%; margin-left: 17%">Add Sounds</button><br><br>
                    <?php endif;?>
            </div>
            
            <div class="wrapper col-sm-3">
                <a class="picture" href="#room_videos_modal" data-toggle = "modal">
                    <div class="hook"></div>
                    <div class="frame">
                        <div class="inside"><strong><center>Videos</center></strong>
                        <?php $once=0;
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                <?php foreach ($attachments as $attachment):
                                    if ($attachment->attachment_type_id === '3' && $once==0):?>
                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "99%" style="max-height:120px"/></video>
                                        
                                <?php 
                                    $once++;
                                    endif;
                                endforeach; ?>
                            <?php endif; endforeach; ?>
                        </div>
                    </div>
                  </a>
                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <button onmouseenter="playclip()" onclick="toggleButton('video')"id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top: 2%; margin-left: 17%">Add Videos</button><br><br>
                <?php endif;?>
            </div>
            
        </div>-->

    <!-- <div class = "col-sm-12 col-md-2 topic-preview-div">
                    
        <div class = "col-md-12 topic-post-list">

           <?php
           foreach ($c_topic->posts as $post):?>

        <div>
            <div class = "col-xs-9">
                <h4 class = "ellipsis"><strong><?php echo utf8_decode($post->post_title); ?></strong> <small><i><?php echo $post->user->first_name . " " . $post->user->last_name; ?></i></small></h4>
                <p class = "ellipsis" style="white-space: pre-wrap;"><?php echo utf8_decode($post->post_content); ?></p>
            </div>

        </div>

        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);

        // print_r($attachments);

        foreach ($attachments as $attachment):
            if ($attachment->attachment_type_id === '1'):?>
                <img src = "<?= base_url($attachment->file_url); ?>"/>

                <?php elseif ($attachment->attachment_type_id === '2'): ?>
                    <audio src = "<?= base_url($attachment->file_url); ?>" controls></audio>

                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                        <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>

                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>

                        <?php 

                        endif;
                    endforeach;
                    
                    ?> 

                    <?php 
                endforeach; ?>

            </div>
        <div>
            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <button onmouseenter="playclip()" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px">Say something</button>
            <?php endif;?>
        </div>
    </div> -->

</body>



<!--    <div class="line1"></div>
    </div>-->
<!--        <table style="width:150%;border-style: inset;border-color: #b38377;border-width: 10px; background-color: #b38377;  border-top: 6px solid #b89675;  border-right: 6px solid #7b654f;border-bottom: 6px solid #7b654f;  border-left: 6px solid #a67c52; "><tr>
                <td>hi</td><td>hi</td>
            </tr></table>-->
    
<!--    <div id = "topic-page" class = "container page" style = "min-height: 100%; height: 100%;">
         Topic Page Header 
        <div class = "row">
            <div id = "topic-heading" class = "col-md-12 content-container no-padding">
                <a onmouseenter="playclip()" class = "btn btn-topic-header" href="<?php echo base_url('topic'); ?>">
                    <h4 class = "pull-left topic-header-title no-padding" style = "margin-top: 3px; margin-bottom: 0px;">
                        <strong class = "text-info text1color" style="cursor:pointer;"><i class = "fa fa-chevron-left" style="cursor:pointer;"></i> 
                            Back to my roomies
                        </strong>
                        
                    </h4>
                </a>
                <center><h4 class = "col-md-4 col-md-offset-4 text-center user-topic-header topic-intro-header bar1color" style="border-radius:20px"><strong><?php echo utf8_decode($c_topic->user->first_name); ?>'s Room</strong></h4></center>
                <?php if (!$is_followed): ?>
                    <button onmouseenter="playclip()" id = "topic-follow-btn" class = "btn pull-right btn-primary textoutliner" style = "margin: 5px; margin-right: 20px; width: 20%;font-size: 19px;" value = "<?php echo $c_topic->topic_id ?>">
                        <i class = "fa fa-plus-circle"></i> Follow Topic
                    </button>
                    <?php else: ?>
                        <button onmouseenter="playclip()" id = "topic-follow-btn" class = "btn pull-right btn-danger textoutliner" style = "margin: 5px; margin-right: 20px; width: 20%;font-size: 19px;" value = "<?php echo $c_topic->topic_id ?>">
                            <i class = "fa fa-minus-circle"></i> Unfollow Topic
                        <?php endif; ?>
                    </button>
                    <a onmouseenter="playclip()" class = "btn btn-success pull-right btn-md textoutliner" style = "margin: 5px; width: 20%" href = "#topic-members-modal" data-toggle = "modal">
                        <i class = "fa fa-user"></i> Members
                    </a>
            </div>
        </div>
        <div class = "row">
             Topic Page Content 
            <div class = "col-md-8 col-xs-12 content-container">
                 Topic Post Preview 
                <div class = "col-sm-12 col-md-12">
                    <div class = "col-12 col-md-12 no-padding">

                        <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                            <button onmouseenter="playclip()" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px">Decorate your room</button><br><br>
                        <?php endif;?>

                       
                        <data></data><div class = "content-container topic-intro-content " style="border-radius:30px;"> <h4 class = "no-margin text-center user-topic-header topic-intro-header bar1color" style="border-radius:20px">
                           <strong class="textoutliner"><?php echo utf8_decode($c_topic->topic_name); ?></strong>

                             <?php if ($is_moderated): ?>
                            <br>
                            <button onmouseenter="playclip()" id = "edit-topic-btn" class = "btn btn-default"><i class = "fa fa-pencil"></i> Edit Description</button>

                            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                                <button onmouseenter="playclip()" type = "button" id = "cancel-topic-btn" class = "btn btn-danger" style = "margin-left: 5px;"><i class = "fa fa-trash"></i> Cancel Topic</button>
                            <?php endif; 
                            endif;?> 
                        </h4>
                          <p id = "desc-creator" class = "no-margin text-muted" align = "center">
                                <small><i>by <a class = "btn btn-link btn-xs no-padding no-margin text1color" href = "<?php echo base_url('user/profile/' . $c_topic->user->user_id); ?>"><?php echo $c_topic->user->first_name . " " . $c_topic->user->last_name; ?></a></i></small>
                            </p> 
                            <?php if ($is_moderated): 

                                // print($c_topic->user->first_name);
                                ?>
                                <div id = "desc-edit" class = "col-md-12 hidden pull-left">
                                    <div class = "form-group" style = "margin-bottom: 5px; margin-left: -1">
                                        <p class="lead emoji-picker-container">
                                            <textarea id = "edit-topic-text" style="height:100px;" maxlength = "180" class = "form-control" data-emojiable="true"><?php echo $c_topic->topic_description ?></textarea>
                                        </p>
                                    </div>
                                    <div class = "form-group pull-right" style = "margin-top: 0px;">
                                        <button onmouseenter="playclip()" value = "<?php echo $c_topic->topic_id ?>" id = "edit-topic-save" class = "btn btn-primary btn-sm">Save</button>
                                        <button onmouseenter="playclip()" id = "edit-topic-cancel" type = "button" class = "btn btn-gray btn-sm">Cancel</button>
                                    </div>

                                </div>
                            <?php endif; ?>

                            <p id = "desc-container" class = "no-margin wrap text-center">
                                <?php echo utf8_decode($c_topic->topic_description); ?>
                            </p>
                        </div>

                        <div class = "col-sm-12 col-md-12">
                            <div class=" col-md-12">

                            <?php
                            // var_dump($c_topic->posts);   

                            foreach ($c_topic->posts as $post):

                                $text_class = '';
                                if ($post->vote_count > 0) {
                                    $text_class = 'text-success';
                                } else if ($post->vote_count < 0) {
                                    $text_class = 'text-danger';
                                }

                                if($post->user_id === $c_topic->creator_id):
                                ?> 

                                <div class="topic-grid1 content-container" style="color: white;  position: relative;  height: auto;  min-height: 100% !important;">
                                         <?php echo ($post->topic_id); ?> 
                                         <?php echo ($c_topic->creator_id); ?> 
                                         <?php echo ($post->user_id); ?> 
                                         <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->profile_url ? base_url($post->user->profile_url) : base_url('images/default.jpg'); ?>"/>  

                                        <p style="font-size: 19px; display:inline"> <?php echo($post->user->first_name); ?> says </p>
                                        
                                        <br>
                                        <p class = "" style = "border-right: none; max-width: 714px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">"<?php echo utf8_decode($post->post_content); ?>"</p>

                                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                <?php //print_r($attachments); ?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />

                                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                        <audio src = "<?= base_url($attachment->file_url); ?>" controls></audio>

                                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "300px" controls/></video>

                                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                        <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>

                                                <?php 

                                                    endif;
                                                endforeach;
                                                ?>                                     
                                    </div>
                                
                            <?php endif;

                            endforeach; 


                            ?>
                        </div>
                </div>
                        
                    </div>
                    <div id = "preview-div" class = "col-sm-12 well topic-preview-div">
                        <div id = "no-preview"class = "topic-no-preview text-center">
                            <span><h3>Click a post to preview</h3></span>
                        </div>
                    </div>
                </div>
                 Topic Post List 
                <div class = "col-sm-6 topic-preview-div">
                    
                    <div class = "col-xs-12 topic-post-list">
                        <div class = "list-group" style = "padding-top: 15px;">
                             List Entry 
                            <?php
                            foreach ($c_topic->posts as $post):
                                $text_class = '';
                                if ($post->vote_count > 0) {
                                    $text_class = 'text-success';
                                } else if ($post->vote_count < 0) {
                                    $text_class = 'text-danger';
                                }
                                ?>
                                <a href = "javascript: void(0);" class = "btn btn-link list-group-item list-entry no-up-down-pad topic-post-entry" data-value = "<?php echo $post->post_id; ?>">
                                    <div class = "row">
                                        <div class = "col-xs-9 fadebelow">
                                            <h4 class = "ellipsis"><strong><?php echo utf8_decode($post->post_title); ?></strong> <small><i><?php echo $post->user->first_name . " " . $post->user->last_name; ?></i></small></h4>
                                            <p class = "ellipsis" style="white-space: pre-wrap;"><?php echo utf8_decode($post->post_content); ?></p>
                                        </div>
                                        <div class = "col-xs-3 text-center" style = "padding: 0px;">
                                            <p style = "padding-top: 10px; font-size: 18px !important;color: #78909C;"><i><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></p>
                                            <span class = "vote-count <?php echo $text_class ?>"><?php echo $post->vote_count ? $post->vote_count : '0'; ?> <i class = "glyphicon glyphicon-star"></i></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            
    </div>-->

    <?php
//     include(APPPATH . 'views/side_postbar.php');
    include(APPPATH . 'views/modals/room_media_modal.php');
    include(APPPATH . 'views/modals/room_shout_modal.php');
//    include(APPPATH . 'views/modals/room_sounds_modal.php');
//    include(APPPATH . 'views/modals/room_videos_modal.php');
//    
//    
//    include(APPPATH . 'views/modals/create_reply_modal.php');
    include(APPPATH . 'views/modals/create_post_modal.php');
//    include(APPPATH . 'views/modals/topic_members_modal.php');
//    include(APPPATH . 'views/modals/cancel_topic_modal.php');
    include(APPPATH . 'views/modals/change_theme_modal.php');
     //   include(APPPATH . 'views/chat/chat.php');
    ?>



    
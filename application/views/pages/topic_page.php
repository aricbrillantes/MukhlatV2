<?php
include(APPPATH . 'views/header.php');
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

<body class="row">

    <?php
        include(APPPATH . 'views/navigation_bar.php'); ?>
       
   <div class = "col-sm-12 col-md-10"> 
        <!--<div id = "topic-page" class = "container page" style = "min-height: 100%; height: 100%;">test</div>-->
        
        <div class="doorroom col-sm-12 col-md-11">
           
            <center><div class="nameframe">
            <h4><strong><?php echo utf8_decode($c_topic->user->first_name); ?>'s Room</strong></h4>
            </div></center>
            <!--Pictures-->
            <div class="col-sm-3"><br><br><br>
                <a class="picture" href="#room_media_modal" data-toggle = "modal" style="color: black">
                    <div style="margin-left: 60px;margin-bottom: 100%">
                        <figure class="boxside boxtop"><i class = "glyphicon glyphicon-picture fa-2x" style="margin-top: 25px"></i></figure>
                    <figure class="boxside boxleft"><i class = "glyphicon glyphicon-volume-up fa-2x" style="margin-top: 25px"></i></figure>
                    <figure class="boxside boxright"><i class = "fa fa-play fa-2x" style="margin-top: 25px"></i></figure>
                    </div>
                    <!--<div class="hook"></div>-->
<!--                    <div class="frame">
                        <div class="inside"><strong><center>Pictures</center></strong>
                        <?php $once=0;
                            foreach ($c_topic->posts as $post):
                                if($post->reply==0):?>
                            <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                <?php foreach ($attachments as $attachment):
                                    if ($attachment->attachment_type_id === '1' && $once==0):?>
                                        <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />
                                                
                                <?php 
                                    $once++;
                                    endif;
                                endforeach; ?>

                        <?php endif; endforeach; ?></div>
                    </div>-->
                </a>

                <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <button onmouseenter="playclip()" onclick="toggleButton('media')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top: 2%; margin-left: 30%">My Stuff</button><br><br>
                <?php endif;?>

            </div>
              
                <!--Shout out-->
           <ul class="stickynote col-sm-3">
               <li class="stickytext">
                   <a href="#room_shout_modal" data-toggle = "modal" class="stickyact">
                        <?php
                            foreach ($c_topic->posts as $post):
                                if($post->shout==1):?>
                            
                    <h2><?php echo utf8_decode($post->post_title); ?></h2>
                    <p><?php echo utf8_decode($post->post_content); ?></p>
                    <?php break; endif; endforeach; ?>

                  </a>
                </li>

            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                <button onmouseenter="playclip()" onclick="toggleButton('shout')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-top: 2%; margin-left: 17%">Shoutout!</button><br><br>
                <?php endif;?>
            </ul>
                
                
                <!--regular text, emojis and stickers-->
                <div>
                <div  class="col-sm-3 pull-right chalkboard" style="min-height:300px; max-height:300px">
                    <?php
                        foreach ($c_topic->posts as $post):
                            if($post->shout==0 && $post->reply==0):?>
                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                    <?php if(!$attachments):?>
                            <p style = "border-right: none; max-width: 714px;padding: 3%;max-height: 50%;font-family: KGChasingPavements"><?php echo utf8_decode($post->post_content); ?></p>
                    <?php endif;
                          endif;
                          endforeach; ?>
                            
                    </div>
            <?php if ($c_topic->creator_id === $logged_user->user_id): ?>
                    <center> <button onmouseenter="playclip()" onclick="toggleButton('text')" id="crettop" class = "btn btn-primary buttonsbgcolor textoutliner" href="#create-post-modal" data-toggle = "modal" style="font-size:22px;margin-left: 5%;margin-top: 1%">My Board</button></center><br><br>
                <?php endif;?></div>
                
        </div>

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
        
    </div>

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
     include(APPPATH . 'views/side_postbar.php');
    include(APPPATH . 'views/modals/room_media_modal.php');
    include(APPPATH . 'views/modals/room_shout_modal.php');
    include(APPPATH . 'views/modals/room_sounds_modal.php');
    include(APPPATH . 'views/modals/room_videos_modal.php');
    
    
    include(APPPATH . 'views/modals/create_reply_modal.php');
    include(APPPATH . 'views/modals/create_post_modal.php');
    include(APPPATH . 'views/modals/topic_members_modal.php');
    include(APPPATH . 'views/modals/cancel_topic_modal.php');
     //   include(APPPATH . 'views/chat/chat.php');
    ?>



    
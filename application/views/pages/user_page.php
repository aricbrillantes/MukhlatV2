<?php
include(APPPATH . 'views/header.php');
    $CI =&get_instance();
    $CI->load->model('attachment_model');
?>
<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
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

    //get user ID of user being viewed (from the URL)
    $id = $this->uri->segment(3);

    if(!$id) //if there is no user ID in the URL, redirect to home page
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    else
    {
        if(!$CI->user_model->user_exists($id))
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
            exit(0);
        }
    }
    
    ?>
   
    <div class = "container page">
        <div class = "row">
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 content-container" style = "padding-top: 20px;">
                <div class = "col-md-6">
                    <!-- User Info -->
                    <div class = "col-md-12" style = "height: 160px;">
                        <div class = "user-profile-info">
                            <div class = "col-xs-3 no-padding" style = "margin-top: 20px;">
                                <img class = "pull-left img-circle user-profile-img" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>" width = "100px" height = "100px"/>
                            </div>
                            <div class = "col-xs-6 no-padding no-margin">
                                <p class = "no-padding text-info" style = "margin-bottom: 0px;margin-top: 20px;"><strong><?php echo $user->first_name . " " . $user->last_name ?></strong></p>
                                <small class = "no-padding no-margin"><?php echo $user->email ?></small>
                                <p class = "wrap text-muted" style = "font-size: 12px;"><i><?php echo $user->description ? $user->description : 'Hello World!'; ?></i></p>
                                <?php //feature unavailable - hide buttons 
                                //echo '<button class = "btn btn-success btn-sm"><i class = "fa fa-phone"></i></button>
                                //<button class = "btn btn-success btn-sm"><i class = "fa fa-comment"></i></button>' ?>
                            </div>
                            <?php if ($logged_user->user_id === $user->user_id): ?>
                                <div class = "col-xs-2 no-padding" style = "margin-top: 20px;">
                                    <a class = "pull-right btn btn-gray btn-sm" href = "#edit-profile-modal" data-toggle = "modal"><i class = "fa fa-pencil"></i> Edit Profile</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- User Topics -->
                    <!--<div class = "col-md-12 user-topic-container">-->
                       
                        <!--</div>-->
                    <!--</div>-->
                </div>

                <!--<div class = "col-md-6">-->
                    <!-- User Stats -->
<!--                    <div class = "col-md-12" style = "padding: 40px 30px; height: 160px;">
                        <div class = "col-sm-4 no-left-right-pad">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo count($user->topics); ?></strong></h2>
                                <p>Topics</p>
                            </div>
                        </div>
                        <div class = "col-sm-4 no-left-right-pad"style = "border-right: 1px solid #E0E0E0; border-left: 1px solid #E0E0E0;">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo $user->vote_points; ?></strong></h2>
                                <p>Points</p>
                            </div>
                        </div>
                        <div class = "col-sm-4 no-left-right-pad">
                            <div class = "col-xs-12 text-center no-left-right-pad">
                                <h2 class = "text-info no-margin"><strong><?php echo $user->post_count; ?></strong></h2>
                                <p>Posts</p>
                            </div>
                        </div>
                    </div>-->

                    <style>
                        @media (max-width: 768px) {
                          .pages> li {
                            display: table-cell;
                            width: 1%;
                          }
                          .pages> li > a  {
                            border-bottom: 0px solid #ddd !important;
                            border-radius: 0px 0px 0 0 !important;
                            margin-bottom: 0 !important;
                          }
                        }
                    </style>

                    <!-- User Activities -->
                    <div class = "col-md-12 user-topic-container">                
                    <?php if ($user->user_id === $logged_user->user_id): ?>
                        <h3 class = "text-info text-center user-activities-header modalbg"><strong class="textoutliner">My Activities</strong></h3>
                    <?php else: ?>
                        <h3 class = "text-info text-center user-activities-header modalbg"><strong class="textoutliner"><?php echo utf8_decode($user->first_name); ?>'s Activities</strong></h3>
                    <?php endif; ?>   
                        <div id="UHposts" class = "col-sm-12 user-activities-div tab-content">
                            <ul class="nav nav-pills nav-justified row text-center pages" style="margin-left:5px; overflow-x: auto; overflow-y: hidden">
                            <?php 
                               $i = 0;
                                $y = 0;
                                $z = 0;

                                for ($x = 0; $x <= count($user->activities); $x+=6): $y++; ?>

                                    <?php if(count($user->activities)>6):

                                    if($x==0): ?>
                                        <li class="active col-md-2 col-xs-2" ><a data-toggle="pill" href="#topics-page-<?php echo $y;?>"><?php echo $y;?></a></li>
                                        

                                        <?php else:?>
                                        <li class="col-md-2 col-xs-2 "><a data-toggle="pill" href="#topics-page-<?php echo $y;?>"><?php echo $y;?></a></li>
                                        

                                    <?php endif;
                                    endif;?>
                                <?php endfor;?>
                            </ul>

                             <?php $index = -1;
                                $posts_chunks = array_chunk($user->activities, 6);

                                if($posts_chunks):
                                    for ($x = 0; $x <= count($user->activities); $x+=6): 
                                        $z++; 
                                        $index++; ?>

                                    <?php if($x==0):?>
                                        <div id="topics-page-<?php echo $z;?>" class = "tab-content tab-pane fade in active">

                                        <?php 

                                        foreach ($posts_chunks[$index] as $post): ?> <?php $wallpaper="";
                                            if($post->theme=="1"): $theme="roomtheme-arrow";
                                            elseif($post->theme=="2"): $theme="roomtheme-zigzag";
                                            elseif($post->theme=="3"): $theme="roomtheme-scales";
                                            elseif($post->theme=="4"): $theme="roomtheme-halfrhombe";
                                            elseif($post->theme=="5"): $theme="roomtheme-marrakesh";
                                            elseif($post->theme=="6"): $theme="roomtheme-hearts";
                                            elseif($post->theme=="7"): $theme="roomtheme-stars";
                                            elseif($post->theme=="8"): $theme="roomtheme-seigaiha";
                                            elseif($post->theme=="9"): $theme="roomtheme-bricks";
                                            elseif($post->theme=="10"): $theme="roomtheme-diacheckerboard";
                                            elseif($post->theme=="11"): $theme="roomtheme-tablecloth";
                                            elseif($post->theme=="12"): $theme="roomtheme-brady";
                                            elseif($post->theme=="13"): $theme="roomtheme-argyle";
                                            elseif($post->theme=="14"): $theme="roomtheme-shippo";
                                            elseif($post->theme=="15"): $theme="roomtheme-waves";
                                            elseif($post->theme=="16"): $theme="roomtheme-polkadot";
                                            elseif($post->theme=="17"): $theme="roomtheme-honeycomb";
                                            elseif($post->theme=="18"): $theme="roomtheme-chocolateweave";
                                            elseif($post->theme=="19"): $theme="roomtheme-crosseddot";
                                            else: $theme="";$wallpaper="background-color: #".$post->theme;
                                            endif;?>
                                        <div class = "polaroid homepostsborder elements-resizer col-xs-12 col-sm-12 <?php echo $theme?>" style = "margin-bottom: 10px; border-radius: 20px;margin-right: 1%;<?php echo $wallpaper?>">
                                            <div class = "user-post-heading" style="border-radius: 20px 20px 0px 0px;background-color: white">
                                                <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->profile_url ? base_url($post->profile_url) : base_url('images/default.jpg'); ?>"/> 
                                                
                                                <a class = "text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                    <strong class="clicker" style = "font-size: 21px"><?php echo $post->first_name; ?></strong>
                                                </a> 
                                                <?php if (empty($post->parent)): ?>
                                                <span style="color:black">said in</span> 
                                                <?php else: ?>
                                                    <span style="color:black">said in</span> 
                                                <?php endif; ?>
                                                <a class = "text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                                    <strong class="clicker" style = "font-size: 22px"><?php echo utf8_decode($post->topic_name); ?>'s room</strong>
                                                </a>
                                                <?php if (!empty($post->parent)): ?>
                                                    <span class = "text-muted" style = "font-size: 18px;">( <i class = "fa fa-reply"></i> <i>in reply to <a class = "btn btn-link btn-xs no-padding no-margin text1color" href = "<?php echo base_url('user/profile/' . $post->parent->user->user_id); ?>"><?php echo $post->parent->user->first_name . " " . $post->parent->user->last_name; ?></a> )</i></span>
                                                <?php endif; ?>
                                                :
                                                <br>
                                                
                                                    <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                            </div>
                                            <div class = "col-xs-12 user-post-content" style="border-radius: 0px 0px 20px 20px">
        <!--                                        <div class = "col-xs-2 text-center no-padding" style = "padding-left: 10px;">
                                                    <img width = "40px" height = "40px" class = "img-circle" style = "margin: 10px 0px;" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                </div>-->
                                                    <?php if (!empty($post->post_title)): ?>
                                                        <!--<h5 class = "no-padding no-margin text-muted wrap"><strong style = "font-size: 21px"><?php echo utf8_decode($post->post_title); ?></strong></h5>-->
        <!--                                                <i class = "text-muted">
                                                            <small>
                                                                <a class = "btn btn-link btn-xs no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>" style="margin-left:10px;">
                                                                    <?php echo $post->first_name . " " . $post->last_name ?>
                                                                </a>
                                                            </small>
                                                        </i>-->
                                                    <?php else: ?>
                                                    <strong style = "font-size: 21px" class="text1color"><?php echo $post->first_name . " " . $post->last_name; ?></strong>

                                                    <?php endif; ?>
                                                    <!--<span class = "text-muted pull-right"> <i style = "font-size: 18px;padding-right: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>-->
                                                    <hr>
                                                    <div class="polaroidwrapper">
                                                    <p class = "whitebg" style = "overflow-wrap: break-word;"><?php echo utf8_decode($post->post_content); ?></p>
                                                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                                                
                                                        <?php //print_r($attachments); ?>

                                                        <?php foreach ($attachments as $attachment):
                                                            if ($attachment->attachment_type_id === '1'):?>
                                                                <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />
                                                                

                                                            <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                                <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                                

                                                            <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                                <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" controls/></video>
                                                            

                                                            <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                                <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                            
                                                        <?php endif; ?>
                                                
                                                            
                                                        <?php endforeach;?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        </div>

                                    <?php else:?>
                                    <div id="topics-page-<?php echo $z;?>" class = "tab-content tab-pane fade">

                                        <?php 

                                        foreach ($posts_chunks[$index] as $post): ?> 
                                            <?php $wallpaper="";
                                            if($post->theme=="1"): $theme="roomtheme-arrow";
                                            elseif($post->theme=="2"): $theme="roomtheme-zigzag";
                                            elseif($post->theme=="3"): $theme="roomtheme-scales";
                                            elseif($post->theme=="4"): $theme="roomtheme-halfrhombe";
                                            elseif($post->theme=="5"): $theme="roomtheme-marrakesh";
                                            elseif($post->theme=="6"): $theme="roomtheme-hearts";
                                            elseif($post->theme=="7"): $theme="roomtheme-stars";
                                            elseif($post->theme=="8"): $theme="roomtheme-seigaiha";
                                            elseif($post->theme=="9"): $theme="roomtheme-bricks";
                                            elseif($post->theme=="10"): $theme="roomtheme-diacheckerboard";
                                            elseif($post->theme=="11"): $theme="roomtheme-tablecloth";
                                            elseif($post->theme=="12"): $theme="roomtheme-brady";
                                            elseif($post->theme=="13"): $theme="roomtheme-argyle";
                                            elseif($post->theme=="14"): $theme="roomtheme-shippo";
                                            elseif($post->theme=="15"): $theme="roomtheme-waves";
                                            elseif($post->theme=="16"): $theme="roomtheme-polkadot";
                                            elseif($post->theme=="17"): $theme="roomtheme-honeycomb";
                                            elseif($post->theme=="18"): $theme="roomtheme-chocolateweave";
                                            elseif($post->theme=="19"): $theme="roomtheme-crosseddot";
                                            else: $theme="";$wallpaper="background-color: #".$post->theme;
                                            endif;?>
                                        <div class = "polaroid homepostsborder elements-resizer col-xs-12 col-sm-12 <?php echo $theme?>" style = "margin-bottom: 10px; border-radius: 20px;margin-right: 1%;<?php echo $wallpaper?>">
                                            <div class = "user-post-heading" style="border-radius: 20px 20px 0px 0px;background-color: white">
                                                <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->profile_url ? base_url($post->profile_url) : base_url('images/default.jpg'); ?>"/> 
                                                
                                                <a class = "text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                    <strong class="clicker" style = "font-size: 21px"><?php echo $post->first_name; ?></strong>
                                                </a> 
                                                <?php if (empty($post->parent)): ?>
                                                <span style="color:black">said in</span> 
                                                <?php else: ?>
                                                    <span style="color:black">said in</span> 
                                                <?php endif; ?>
                                                <a class = "text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                                    <strong class="clicker" style = "font-size: 22px"><?php echo utf8_decode($post->topic_name); ?>'s room</strong>
                                                </a>
                                                <?php if (!empty($post->parent)): ?>
                                                    <span class = "text-muted" style = "font-size: 18px;">( <i class = "fa fa-reply"></i> <i>in reply to <a class = "btn btn-link btn-xs no-padding no-margin text1color" href = "<?php echo base_url('user/profile/' . $post->parent->user->user_id); ?>"><?php echo $post->parent->user->first_name . " " . $post->parent->user->last_name; ?></a> )</i></span>
                                                <?php endif; ?>
                                                :
                                                <br>
                                                
                                                    <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                            </div>
                                            <div class = "col-xs-12 user-post-content" style="border-radius: 0px 0px 20px 20px">
        <!--                                        <div class = "col-xs-2 text-center no-padding" style = "padding-left: 10px;">
                                                    <img width = "40px" height = "40px" class = "img-circle" style = "margin: 10px 0px;" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                </div>-->
                                                    <?php if (!empty($post->post_title)): ?>
                                                        <!--<h5 class = "no-padding no-margin text-muted wrap"><strong style = "font-size: 21px"><?php echo utf8_decode($post->post_title); ?></strong></h5>-->
        <!--                                                <i class = "text-muted">
                                                            <small>
                                                                <a class = "btn btn-link btn-xs no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>" style="margin-left:10px;">
                                                                    <?php echo $post->first_name . " " . $post->last_name ?>
                                                                </a>
                                                            </small>
                                                        </i>-->
                                                    <?php else: ?>
                                                    <strong style = "font-size: 21px" class="text1color"><?php echo $post->first_name . " " . $post->last_name; ?></strong>

                                                    <?php endif; ?>
                                                    <!--<span class = "text-muted pull-right"> <i style = "font-size: 18px;padding-right: 10px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>-->
                                                    <hr>
                                                    <div class="polaroidwrapper">
                                                    <p class = "whitebg" style = "overflow-wrap: break-word;"><?php echo utf8_decode($post->post_content); ?></p>
                                                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                                                
                                                        <?php //print_r($attachments); ?>

                                                        <?php foreach ($attachments as $attachment):
                                                            if ($attachment->attachment_type_id === '1'):?>
                                                                <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative;" />
                                                                

                                                            <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                                <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                                

                                                            <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                                <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" controls/></video>
                                                            

                                                            <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                                <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                            
                                                        <?php endif; ?>
                                                
                                                            
                                                        <?php endforeach;?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        </div>


                                <?php endif; 
                                endfor;
                            endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>
    <?php
  //  include(APPPATH . 'views/chat/chat.php');
    // include(APPPATH . 'views/side_navbar.php');
    include(APPPATH . 'views/modals/edit_profile_modal.php');?>
    
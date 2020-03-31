<?php
    include(APPPATH . 'views/header.php');

    //check if current user is parent or logged in
    //if user is not a parent, redirect to home
    //if user is not logged in, redirect to sign in
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 3 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    //load user model
    $CI =&get_instance();
    $CI->load->model('user_model');
    $CI->load->model('attachment_model');

    //get user ID of child being monitored (from the URL)
    $id = $this->uri->segment(3);

    if(!$id) //if there is no user ID in the URL, redirect to home page
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    if($CI->user_model->isParent($logged_user->email,$id) == 999)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    //get children for navbar
    $children_display = $CI->user_model->view_child($logged_user->email);

    //get data of child being monitored
    $children = $CI->user_model->view_specific_child($id);

    //load topic model
    $CI =&get_instance();
    $CI->load->model('topic_model');
    $CI->load->model('post_model');

    $user_activity = $CI->user_model->get_child_records($id);
    $activities = $CI->post_model->get_user_activities($id,$id);

    $CI =&get_instance();
    $CI->load->library('user_agent');

    $mobile=$CI->agent->is_mobile();

?>

<script>
    document.cookie = "updatetime=0;path=/";
    document.cookie = "selectedWarning=0;path=/";   
    document.cookie = "selectedLimit=180;path=/"; 
    document.cookie = "selectedKeep=1;path=/"; 
    var ctr = 0;
</script>

<?php if ($logged_user->role_id == 2): ?>
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>

<link href="https://fonts.googleapis.com/css?family=Cabin|Muli|Oswald" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />
<style>div.content-container{border:0px;}</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="<?php echo base_url('lib/css/emoji_parentview.css'); ?>"/>

<?php if ($logged_user->role_id == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>


<?php foreach ($children->result() as $child): 

    //read data of child 
    //note: foreach is needed even though only one child is being fetched

    //store user data in array
    $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id,'is_enabled'));
    
    //get topic data
    $user_topics = $CI->topic_model->get_user_topics($child->user_id);
    $user_moderated_topics = $CI->topic_model->get_moderated_topics($child->user_id);
    $user_followed_topics = $CI->topic_model->get_followed_topics($child->user_id);

?>
<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px; border:0" href="<?php echo base_url('home') ?>">
            <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                    Back
                </strong>
            </h3>
        </a>
            
            
        <?php if (!$mobile): ?>

            <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px; color: black;" >
                <li class="dropdown" style="color: black;">

                    <a class="dropdown-toggle pull-right" data-toggle="dropdown" href="#">
                        Monitoring: <b><?php echo $child->first_name ?></b>
                        <span class="caret"></span>
                    </a>                
                
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><i class = "fa fa-user"></i> My Profile</a></li> -->
                        
                        <?php foreach ($children_display->result() as $child):$data['user'] = $CI->user_model->get_user(true, true, array('user_id' =>  $child->user_id));?>

                        <li><a href="<?php echo base_url('parents/activity/' . $child->user_id); ?>"><i class = "fa fa-user" style="color:green"></i> <?php echo $child->first_name?></a></li>    
                        <?php endforeach; ?>

                        <li><span style="color:white">______</span></li>
                        
                        <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Log Out</a></li>

                    </ul>
                </li>
            </ul>

        <?php else: ?>
            <a href="#logout-modal-parents" data-toggle = "modal" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#c73838; border-color: #c73838;">Log Out</a>
                            
        <?php endif; ?>
        
    </div>
</nav><br><br><br>
<?php endforeach; ?>

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container col-md-10 col-sm-12 col-xs-12 col-md-offset-1" style = "">
        
        <div class = "row" >
            <?php foreach ($children->result() as $child): 

                //read data of child 
                //note: foreach is needed even though only one child is being fetched

                //store user data in array
                $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));
                
                //get topic data
                $user_topics = $CI->topic_model->get_user_topics($child->user_id);
                $user_moderated_topics = $CI->topic_model->get_moderated_topics($child->user_id);
                // $user_followed_topics = $CI->topic_model->get_followed_topics($child->user_id);

                //ceil to round up float
                foreach ($user_topics as $topic)
                {}

                $totalPosts=0;
                $totalRoomPosts=0;
                $roomPosts=0;;
                $selfPosts=0;
                $otherPosts=0;
                $shoutOuts=0;
                $postCount=0;


                foreach ($activities as $post)
                {
                    $totalPosts++;
                    // print_r($post);
                    if ($topic->topic_id == $post->topic_id)
                    {
                        
                        if($post->shout == '1')
                            $shoutOuts++;
                            
                        elseif($post->reply == '1')
                        {
                            $roomPosts++;
                            $totalRoomPosts++;
                        }

                        else
                        {
                            $totalRoomPosts++;
                            $selfPosts++;
                        }
                    }

                    else
                        $otherPosts++;
                }
            
            ?>
            <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid " style = "margin-top: -15px; margin-bottom: -15px;">
                
            </div> 

            <div class = "content-container container-fluid" style = "margin-top: -15px;">

                <!-- User Room -->
                <div class = "col-xs-12 col-sm-6 col-md-6 content-container container-fluid row " style = "margin-top: -15px; margin-left: 0px">
                    <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid" style="border:0px; margin-bottom: 0px;">
                        <div class = "col-xs-12 col-md-12 col-sm-12 text-center" style="border:0px; margin-bottom: 0px;"> 
                            <?php if($child->is_enabled === '0'):?>
                                <h4 class = "no-padding " style="color:red;"><b>Account Unverified</h4></b>
                            <?php endif;?>

                            <img id = "user-pic-display" class = "img-circle" width = "80px" height = "80px" src = "<?php echo $child->profile_url ? base_url($child->profile_url) : base_url('images/default.jpg') ?>" style = "margin-bottom: 5px;">
                            
                            <h3 class = "no-padding text-info" style = "margin-top: 5px; margin-bottom: 5px; "><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                            <h5 class = "no-padding no-margin" style = "margin-top: 5px; margin-bottom: 5px; "><i>@<?php echo $child->email ?></i></h5>
                            <h5 class = "no-padding no-margin" style = "margin-top: 5px; margin-bottom: 5px; "><?php echo date_format(date_create($child->birthdate),"M d, Y") ?></h5>
                            
                            <!-- <p class = "wrap text-muted" style = ""><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p> -->
                        
                            <a class = "btn btn-primary col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3" style="font-size:14px; margin-top: 15px;" href = "<?php echo base_url('parents/settings/' . $child->user_id) ?>" ><i class = "glyphicon glyphicon-time"></i> 
                                <?php if (!$mobile): ?>
                                    Manage <?php echo $child->first_name;?>'s Schedule

                                <?php else: ?>
                                    Schedule

                                <?php endif; ?>
                            </a>
                            </h4>
                        </div>
                    </div>   

                    
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <br>
                        <h3 class = "text-info text-center user-activities-header">
                            <strong><?php echo $child->first_name; ?>'s Use Statistics</strong>
                        </h3>

                    </div>

                    <style>

                    </style>
                    
                    <div class=" "> 
                        <h5 style="visibility: hidden">_</h5>

                        <div class="col-md-3 col-sm-3 col-xs-3" style="border-right: 1px solid #dedede">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Total posts </h4></strong> <br><h3 class = "" style = "display: inline-block;"><?php echo $totalPosts; ?></h3>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4" style="border-right: 1px solid #dedede">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Posts in room </h4></strong> <br><h3 class = "" style = "display: inline-block;"><?php echo $totalRoomPosts; ?></h3>
                        </div>

                        <div class=" col-md-5 col-sm-5 col-xs-5">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Comments (in room) </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $roomPosts; ?></h3>
                        </div>

                        <div class=" col-md-12 col-sm-12 col-xs-12" style="visibility: hidden">
                            <br>
                        </div>

                        <div class=" col-md-3 col-sm-3 col-xs-3" style="border-right: 1px solid #dedede">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Sticky Notes </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $shoutOuts; ?></h3>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4" style="border-right: 1px solid #dedede"> 
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Files uploaded </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $selfPosts; ?></h3>
                        </div>

                        <div class="col-md-5 col-sm-5 col-xs-4">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Comments (other rooms)</h4></strong> <br><h3 class = "" style = "display: inline-block;"><?php echo $otherPosts; ?></h3>
                        </div>

                        <div class=" col-md-12 col-sm-12 col-xs-12">
                            <hr class="style1" style="border-top: 1px solid #dedede;">
                        </div>

                       <!--  <div class=" col-md-12 col-sm-12 col-xs-12">
                            <i><small class = "" style = "display: inline-block; margin-right: 20px">(Last updated: <?php echo date_format(date_create($child->updated),"m/d/Y"); ?> )</small></i>
                        </div><br><br> -->

                        <div class="col-md-4 col-sm-4 col-xs-4" style="border-right: 1px solid #dedede">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Bad words<br>(this week) </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $child->current_total; ?></h3><br>
                        </div>

                        <div class=" col-md-4 col-sm-4 col-xs-4" style="border-right: 1px solid #dedede">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Bad words<br>(last week) </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $child->last_total; ?></h3>
                        </div>

                        <div class=" col-md-4 col-sm-4 col-xs-4">
                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Bad words<br>(total) </h4></strong><br> <h3 class = "" style = "display: inline-block;"><?php echo $child->overall_total; ?></h3>
                        </div>
                    </div>

                    <!-- User Room -->
                    <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid row" style = "margin-top: 50px; margin-left: 0px">
                        <h3 class = "text-info text-center user-activities-header">
                            <strong>Leave a note for <?php echo $child->first_name; ?></strong><br>
                        </h3>
                    </div>

                    <form enctype = "multipart/form-data" action = "<?php echo base_url('parents/note/').$id; ?>" id = "create-note-form" method = "POST">
                        <div class="modal-body">

                            <div class="form-group"><!-- check if description exceeds n words-->
                                
                                <?php if(!$mobile): ?>
                                <p class="emoji-picker-container">
                                    <textarea class = "form-control" data-emojiable="true" style="height: 100px;" maxlength = "200" required name = "note_content" id = "note-content" placeholder = "Write your note here:" ></textarea>
                                </p>

                                <?php else:?>
                                    <textarea class = "form-control" style="height: 100px;" maxlength = "200" required name = "note_content" id = "note-content" placeholder = "Write your note here:" ></textarea>
                                
                                <?php endif;?>

                                
                            </div>

                            <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                                <button id = "create-note-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" >Send</button>
                            </div>

                            <strong class = "text-info" style = "display: inline-block; margin-right: 20px"><h4>Previous notes to <?php echo $child->first_name;?>: </h4></strong> <h2 class = "" style = "display: inline-block;"></h2>
                                <div style="max-height:200px; overflow-x: hidden; overflow-y: scroll">
                                    <?php 
                                    
                                    $CI->load->model('user_model'); //load models       
                                    $notes = $CI->user_model->get_notes($id); //get notes

                                    foreach (array_reverse($notes) as $note): ?>

                                    <li class = "list-group-item admin-list-item" >
                                        <i class = "pull-right">(<?php echo date_format(date_create($note->date),"M d Y - H:i");?>)</i>
                                        <h4 class = "no-padding admin-list-name"><?php echo utf8_decode($note->note); ?></h4>
                                    </li>
                                                                       
                                <?php endforeach; ?>
                                </div>
                            
                        </div>
                    </form> 
                    </h4>

                </div>

                <!-- Activity -->
                <div class = "col-xs-12 col-md-6 col-sm-6 col-md-offset-0 content-container container-fluid tab-content" style = "margin-bottom: 0px; margin-left: 0px">
                    <h3 class = "text-info text-center user-activities-header">
                        <strong><?php echo $child->first_name; ?>'s Activity</strong>
                    </h3>
                    
                    <br>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#all-posts">All</a></li>
                        <li class=""><a data-toggle="pill" href="#room-posts">In Room</a></li>
                        <li class=""><a data-toggle="pill" href="#other-posts">In Other Rooms</a></li>
                        <li class=""><a data-toggle="modal" href="#child-activity-modal-parents">Files</a></li>
                    </ul><br>

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

                    

                    <div id="UHposts" class="tab-content" style="max-height:500px;">
                        <!-- ALL POSTS -->
                        <div id="all-posts" class = "tab-pane fade in active tab-content " >
                            <ul class="nav nav-pills nav-justified row text-center pages" style="margin-left:5px; overflow-x: auto; overflow-y: hidden">
                            <?php 
                                /*
                                    $totalPosts=0;
                                    $totalRoomPosts=0;
                                    $roomPosts=0;;
                                    $selfPosts=0;
                                    $otherPosts=0;
                                    $shoutOuts=0;
                                    $postCount=0;
                                */
                                $i = 0;
                                $y = 0;
                                $z = 0;

                                for ($x = 0; $x <= $totalPosts; $x+=40): $y++; ?>

                                    <?php if($totalPosts>40):

                                    if($x==0): ?>
                                        <li class="active col-md-2 col-xs-2" ><a data-toggle="pill" href="#all-page-<?php echo $y;?>"><?php echo $y;?></a></li>
                                        
                                        <?php else:?>
                                        <li class="col-md-2 col-xs-2 "><a data-toggle="pill" href="#all-page-<?php echo $y;?>"><?php echo $y;?></a></li>
                                        

                                    <?php endif;
                                    endif;?>
                                <?php endfor;?>
                            </ul>

                            <div class = "tab-content" style="max-height:480px; overflow-x: hidden; overflow-y: scroll">
                                <?php $index = -1;
                                for ($x = 0; $x <= $totalPosts; $x+=40): $z++; $index++;?>

                                <?php if($x==0):?>
                                    <div id="all-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; ">
                                    
                                <?php else:?>
                                    <div id="all-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px; ">

                                <?php endif;?>
                                
                                <?php 

                                    $activities_chunks = array_chunk($activities, 40);
                                    
                                    if($activities_chunks):
                                        foreach ($activities_chunks[$index] as $n=>$post): $i++;?> 
                                        <div id="" class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                            <div class = "user-post-heading no-margin">

                                                <?php if ($post->is_deleted): ?>
                                                <span class = "pull-right" style="color:#ce0000"><b>POST DELETED</b></span>
                                                
                                                <?php endif; ?>

                                                
                                                <?php if ($topic->topic_id == $post->topic_id): ?>
                                                    <?php if ($post->reply == 1): ?>
                                                        <span>commented on <strong>their room</strong> </span>
                                                    
                                                    <?php else: ?>
                                                        <span>posted in <strong>their room</strong> </span>

                                                    <?php endif; ?>

                                                <?php else: ?>
                                                    <span>commented on <strong><?php echo $post->topic_name; ?>'s Room</strong> </span> 

                                                <?php endif; ?>
                                                
                                                <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y - H:i", strtotime($post->date_posted)); ?>)</i></span>
                                               
                                            </div>
                                            <div class = "col-xs-12 user-post-content no-padding">
                                                
                                                <div class = "col-xs-10 no-padding" style = "margin-top: 1vw; margin-left: 1vw;">
                                                    <?php if (!empty($post->post_title)): ?>
                                                        <h5 class = "no-padding no-margin text-muted wrap"><strong><?php echo utf8_decode($post->post_title); ?></strong></h5>
                                                        
                                                    <?php else: ?>
                                                        <!-- <h5 class = "no-padding no-margin text-muted wrap"><a class = "btn btn-link no-padding no-margin"><strong><?php echo $post->first_name . " " . $post->last_name; ?></strong></a></h5> -->

                                                    <?php endif; ?>
                                                    
                                                    <p class = "home-content-body" style = "border-right: none;"><?php echo utf8_decode($post->post_content); ?></p>

                                                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                    <?php foreach ($attachments as $attachment):
                                                        if ($attachment->attachment_type_id === '1'):?>
                                                            <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 200px; max-width: 300px;" />
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                            <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                            <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video>
                                                        

                                                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                        
                                                    <?php endif; endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    endforeach; endif;?>
                                </div>
                                <?php endfor;?>
                            </div>
                        </div>

                        <!-- POSTS IN OWN ROOM-->
                        <div id="room-posts" class = "tab-pane fade tab-content" >
                            <ul class="nav nav-pills nav-justified row text-center pages" style="overflow-x: auto; overflow-y: hidden">
                            <?php 
                                $i = 0;
                                $y = 0;
                                $z = 0;

                                for ($x = 0; $x < $totalRoomPosts; $x+=40): $y++; ?>

                                    <?php if($totalRoomPosts>40):

                                    if($x==0): ?>
                                        <li class="active col-md-2 col-xs-2"><a data-toggle="pill" href="#room-page-<?php echo $y;?>"><?php echo $y;?></a></li>

                                        <?php else:?>
                                        <li class="col-md-2 col-xs-2"><a data-toggle="pill" href="#room-page-<?php echo $y;?>"><?php echo $y;?></a></li>

                                    <?php endif;
                                    endif;?>
                                <?php endfor;?>
                            </ul>

                            <div class = "tab-content" style="max-height:480px; overflow-x: hidden; overflow-y: scroll">
                                <?php $index = -1;

                                $roomArray = array();

                                foreach($activities as $activity)
                                {
                                    if ($topic->topic_id == $activity->topic_id)
                                        array_push($roomArray,$activity);
                                }

                                for ($x = 0; $x <= $totalRoomPosts; $x+=40): $z++; $index++;?>

                                <?php if($x==0):?>
                                    <div id="room-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; ">
                                    
                                <?php else:?>
                                    <div id="room-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px; ">

                                <?php endif;?>
                                
                                <?php 

                                    $roomArray_chunks = array_chunk($roomArray, 40);
                                    
                                    if($roomArray_chunks):
                                        foreach ($roomArray_chunks[$index] as $n=>$post): $i++;

                                        if ($topic->topic_id != $post->topic_id)
                                            continue; ?> 

                                        <div id="" class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                            <div class = "user-post-heading no-margin">

                                                <?php if ($post->is_deleted): ?>
                                                <span class = "pull-right" style="color:#ce0000"><b>POST DELETED</b></span>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($post->reply == 1): ?>
                                                    <span>commented on <strong>their room</strong> </span>
                                                
                                                <?php else: ?>
                                                    <span>posted in <strong>their room</strong> </span>

                                                <?php endif; ?>

                                                <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y - H:i", strtotime($post->date_posted)); ?>)</i></span>
                                               
                                            </div>
                                            <div class = "col-xs-12 user-post-content no-padding">
                                                
                                                <div class = "col-xs-10 no-padding" style = "margin-top: 1vw; margin-left: 1vw;">
                                                    <?php if (!empty($post->post_title)): ?>
                                                        <h5 class = "no-padding no-margin text-muted wrap"><strong><?php echo utf8_decode($post->post_title); ?></strong></h5>
                                                        
                                                    <?php else: ?>
                                                        <!-- <h5 class = "no-padding no-margin text-muted wrap"><a class = "btn btn-link no-padding no-margin"><strong><?php echo $post->first_name . " " . $post->last_name; ?></strong></a></h5> -->

                                                    <?php endif; ?>
                                                    
                                                    <p class = "home-content-body" style = "border-right: none;"><?php echo utf8_decode($post->post_content); ?></p>

                                                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                    <?php foreach ($attachments as $attachment):
                                                        if ($attachment->attachment_type_id === '1'):?>
                                                            <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 200px; max-width: 300px;" />
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                            <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                            <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video>
                                                        

                                                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                        
                                                    <?php endif; endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    
                                    endforeach; endif; ?>
                                </div>
                                <?php endfor;?>
                            </div>
                        </div>

                        <!-- POSTS IN OTHER ROOM-->
                        <div id="other-posts" class = "tab-pane tab-content fade" >
                            <ul class="nav nav-pills nav-justified row text-center pages" style="overflow-x: auto; overflow-y: hidden">
                            <?php 
                                $i = 0;
                                $y = 0;
                                $z = 0;

                                for ($x = 0; $x <= $otherPosts; $x+=40): $y++; ?>

                                    <?php if($otherPosts>40):

                                    if($x==0): ?>
                                        <li class="active col-md-2 col-xs-2"><a data-toggle="pill" href="#other-page-<?php echo $y;?>"><?php echo $y;?></a></li>

                                        <?php else:?>
                                        <li class="col-md-2 col-xs-2"><a data-toggle="pill" href="#other-page-<?php echo $y;?>"><?php echo $y;?></a></li>

                                    <?php endif;
                                    endif;?>
                                <?php endfor;?>
                            </ul>

                            <div class = "tab-content" style="max-height:480px; overflow-x: hidden; overflow-y: scroll">
                                <?php $index = -1; 

                                $othersArray = array();

                                foreach($activities as $activity)
                                {
                                    if ($topic->topic_id != $activity->topic_id)
                                        array_push($othersArray,$activity);
                                }


                                for ($x = 0; $x <= $otherPosts; $x+=40): $z++; $index++; ?>

                                <?php 
                                    if($otherPosts>40 && $x==0):?>
                                        <div id="other-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; ">

                                    <?php elseif($otherPosts>40):?>
                                        <div id="other-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px; ">

                                    <?php elseif($otherPosts<40):?>
                                        <div id="other-page-<?php echo $z;?>" class = "tab-content col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; ">

                                <?php endif;
                                    ?>
                                
                                <?php 
                                    
                                    $others_chunks = array_chunk($othersArray, 40);

                                    if($others_chunks):

                                        foreach ($others_chunks[$index] as $post): $i++;

                                        if ($topic->topic_id != $post->topic_id):?> 

                                        <div id="" class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                            <div class = "user-post-heading no-margin">

                                                <?php if ($post->is_deleted): ?>
                                                <span class = "pull-right" style="color:#ce0000"><b>POST DELETED</b></span>
                                                
                                                <?php endif; ?>
                                            
                                                <span>commented on <strong><?php echo $post->topic_name; ?>'s Room</strong> </span>

                                                <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y - H:i", strtotime($post->date_posted)); ?>)</i></span>
                                               
                                            </div>
                                            <div class = "col-xs-12 user-post-content no-padding">
                                                
                                                <div class = "col-xs-10 no-padding" style = "margin-top: 1vw; margin-left: 1vw;">
                                                    <?php if (!empty($post->post_title)): ?>
                                                        <h5 class = "no-padding no-margin text-muted wrap"><strong><?php echo utf8_decode($post->post_title); ?></strong></h5>
                                                        
                                                    <?php else: ?>
                                                        <!-- <h5 class = "no-padding no-margin text-muted wrap"><a class = "btn btn-link no-padding no-margin"><strong><?php echo $post->first_name . " " . $post->last_name; ?></strong></a></h5> -->

                                                    <?php endif; ?>
                                                    
                                                    <p class = "home-content-body" style = "border-right: none;"><?php echo utf8_decode($post->post_content); ?></p>

                                                    <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>

                                                    <?php foreach ($attachments as $attachment):
                                                        if ($attachment->attachment_type_id === '1'):?>
                                                            <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 200px; max-width: 300px;" />
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                            <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                            

                                                        <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                            <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 250px;" controls/></video>
                                                        

                                                        <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                            <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                        
                                                    <?php endif; endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                        endif; 
                                        endforeach; 
                                    endif;?>
                                </div>
                                <?php endfor;?>
                            </div>
                        </div>                        
                        
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
    </div>

    <style> 
    
        #cookieConsent 
        {
            background-color: rgba(20,20,20,0.8);
            min-height: 26px;
            font-size: 15px;
            color: #FFFFFF;
            line-height: 26px;
            padding: 8px 0 8px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: none;
            z-index: 9999;
        }

        #cookieConsent a 
        {
            color: #269588;
            text-decoration: none;
        }

        #closeCookieConsent 
        {
            float: right;
            display: inline-block;
            cursor: pointer;
            height: 20px;
            width: 20px;
            margin: -15px 0 0 0;
        }

        #closeCookieConsent:hover 
        {
            color: #FFF;
        }

        #cookieConsent a.cookieConsentOK 
        {
            background-color: #269588;
            color: #FFFFFF;
            display: inline-block;
            border-radius: 5px;
            font-size: 18px;
            padding: 6px 20px;
            cursor: pointer;
            float: center;
        }

        #cookieConsent a.cookieConsentOK:hover 
        {
            background-color: #d6e4e1;
            color: #000000;
        }

    </style>

    

    <div id="cookieConsent" class="text-center">
        <div id="closeCookieConsent">x</div>
        <div class="col-md-10 col-sm-9 col-xs-12">
            To enhance you and your child's user experience, <i>Mukhlat</i> uses cookies.
            By continuing to use the website, you agree that we may store and access cookies on your device.
            You are free to disable cookies in your Web Browser's settings, but some features of Mukhlat may not work properly.<br> 

            <!-- <a href="#" target="_blank">(Click here for more info)</a> -->
        </div>

        <div class="col-md-2 col-sm-3 col-xs-12">
             <a class="cookieConsentOK" onclick="toogleCookieWarning();">I accept!</a>
        </div>
    </div>

<script>
    function getCookie(cname) 
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) 
        {
            var c = ca[i];
            while (c.charAt(0) === ' ') 
            {
                c = c.substring(1);
            }

            if (c.indexOf(name) === 0) 
            {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function toogleCookieWarning()
    {
        if(getCookie("cookiewarning") == 0 || getCookie("cookiewarning")=="0")
        {
            document.cookie = "cookiewarning=1;" + ";path=/"; 
            // document.getElementById("cookiewarning").style.display= "none";
            document.getElementById("cookieConsent").style.display= "none";
            
        }
    }

    if(getCookie("cookiewarning") == 0 || getCookie("cookiewarning")=="0")
    {
        // document.getElementById("cookiewarning").style.display= "block";
        document.getElementById("cookieConsent").style.display= "block";
    }

    if(getCookie("cookiewarning") == 1 || getCookie("cookiewarning")=="1")
    {
        // document.getElementById("cookiewarning").style.display= "none";
        document.getElementById("cookieConsent").style.display= "none";
    }
</script>

<script type="text/javascript" src="<?php echo base_url("/js/admin.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/js/search.js"); ?>"></script>
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

<script type="text/javascript" src="<?php echo base_url("/js/parent.js"); ?>"></script>

</body>
</html>

<?php
    include(APPPATH . 'views/modals/child_activity_modal_parents.php');
//    include(APPPATH . 'views/modals/create_note_modal.php');
    include(APPPATH . 'views/modals/network_view_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
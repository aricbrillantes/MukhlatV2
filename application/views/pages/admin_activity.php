<?php
    include(APPPATH . 'views/header.php');

    //check if current user is parent or logged in
    //if user is not a parent, redirect to home
    //if user is not logged in, redirect to sign in
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 1 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
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
    }

    $isChild = $CI->user_model->checkUserType($id);

    if($isChild)
    {
        foreach ($isChild as $check)
        {
            if($check->role_id != 2)
            {
                $homeURL = base_url('home');
                header("Location: $homeURL");
            }
        }
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    // $children_display = $CI->user_model->view_child($logged_user->user_id);

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

<?php foreach ($children->result() as $child): 

    //read data of child 
    //note: foreach is needed even though only one child is being fetched

    //store user data in array
    $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));
    
    //get topic data
    $user_topics = $CI->topic_model->get_user_topics($child->user_id);


    if($child->role_id == 3)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        // print("parent");
    }    
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

            <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px;">
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <!-- <img class = "img-rounded nav-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/>  -->
                        <?php echo $logged_user->first_name . " " . $logged_user->last_name; ?>
                        
                        <span class="caret"></span>
                    </a>                 
                
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Logout</a></li>

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
    <div class = "container" style = "">
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

            <div class = "content-container container-fluid" >
                <!-- User Posts -->
                <div class = "col-xs-12 col-sm-6 col-md-6 content-container container-fluid row" style = "margin-top: -15px;  margin-bottom: 0px; margin-left: 0px">
                    <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid" style="border:0px; margin-bottom: 0px;">
                        <div class = "col-xs-12 col-md-12 col-sm-12 text-center"> 
                            <?php if($child->is_enabled === '0'):?>
                                <h4 class = "" style="color:red;"><b>Unverified Account</h4></b>

                            <?php endif;?>
                            <img id = "user-pic-display" class = "img-circle" width = "72px" height = "72px" src = "<?php echo $child->profile_url ? base_url($child->profile_url) : base_url('images/default.jpg') ?>" style = "margin-bottom: 0px;">
                            <br>
                            <h3 class = "no-padding text-info" style = "margin-top: 5px; margin-bottom: 5px; "><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                            <h5 class = "no-padding no-margin"><?php echo $child->email ?></h5>
                            <h5 class = "no-padding no-margin" style = "margin-top: 5px; margin-bottom: 5px; "><?php echo date_format(date_create($child->birthdate),"M d, Y") ?></h5>
                            <br>
                            <!-- <h5 class = "no-padding no-margin"><b>Parent's email: </b><?php echo $child->parent ?></h5> -->
                            <!-- <h5 class = "no-padding no-margin"><?php echo ($child->parent === "") ? $child->parent : 'NO EMAIL' ?></h5> -->

                            <?php 
                                $CI =&get_instance();
                                $CI->load->model('user_model'); //load model       
                                $parentExists = $CI->user_model->user_exists_email($child->parent); //check if email exists

                                // print_r($parentExists);
                            ?>

                            <?php if($child->parent === "" || !($child->parent)):?>
                                <h5 class = "no-padding no-margin" style="color:red;"><b>No Parent/Guardian Email</b></h5>

                            <?php elseif(empty($parentExists)):?>
                                <h5 class = "no-padding no-margin" style="color:red;"><b><?php echo $child->parent ?></b> is not a valid Parent/Guardian email</h5>

                            <?php else:?>
                                <h5 class = "no-padding no-margin"><b>Parent's email: </b><?php echo $child->parent ?></h5></h5>
                                               
                            <?php endif;?>

                            <!-- <p class = "wrap text-muted" style = ""><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p> -->
                        </div>
                    </div>    

                    <div class=" col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; margin-bottom: 10px;">
                        <h3 class = "text-info text-center user-activities-header">
                            <strong><?php echo $child->first_name; ?>'s Use Statistics</strong>
                        </h3><br>
                    </div>

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

                                for ($x = 0; $x < $totalPosts; $x+=40): $y++; ?>

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
                                                
                                                <?php else: ?>
                                                <button style="height:20px" name="<?php echo $post->user_id ?>" value = "<?php echo $post->post_id ?>" class = "delete-btn pull-right btn btn-sm btn-danger no-padding"> <i class = "fa fa-trash"></i> Delete </button>
                                                
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
                                                
                                                <?php else: ?>
                                                <button style="height:20px" name="<?php echo $post->user_id ?>" value = "<?php echo $post->post_id ?>" class = "delete-btn pull-right btn btn-sm btn-danger no-padding"> <i class = "fa fa-trash"></i> Delete </button>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($post->reply == 1): ?>
                                                    <span>commented in <strong>their room</strong> </span>
                                                
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
                                    endforeach; endif;?>
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

                                for ($x = 0; $x < $otherPosts; $x+=40): $y++; ?>

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
                                                
                                                <?php else: ?>
                                                <button style="height:20px" name="<?php echo $post->user_id ?>" value = "<?php echo $post->post_id ?>" class = "delete-btn pull-right btn btn-sm btn-danger no-padding"> <i class = "fa fa-trash"></i> Delete </button>
                                                
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

    <!-- <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/network.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" /> -->

</body>
</html>
<script type="text/javascript" src="<?php echo base_url("/js/post.js"); ?>"></script>

<?php
    include(APPPATH . 'views/modals/delete_post_modal.php');
    include(APPPATH . 'views/modals/child_activity_modal_parents.php');
    include(APPPATH . 'views/modals/network_view_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
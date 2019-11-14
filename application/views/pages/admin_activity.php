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

    $children_display = $CI->user_model->view_child($logged_user->user_id);

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

    if($mobile):?>
    <!-- <script>alert('mobile!');</script> -->
    <style>
        body.sign-in
        {
            background-image: none;
            background-color: #f9f9f9;
            font-family: 'Cabin', 'Muli', sans-serif;
            height: 500px;
        }

        div.content-container{
            border:0px;
            background-color: #f9f9f9;
        }
    </style>

<?php endif; ?>

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

<?php if ($logged_user->role_id == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>

<?php if($mobile):?>
    <!-- <script>alert('mobile!');</script> -->
    <style>

        body.sign-in
        {
            background-image: none;
            background-color: #f9f9f9;
            font-family: 'Cabin', 'Muli', sans-serif;
            height: 500px;
        }


        div.content-container{
            border:0px;
            background-color: #f9f9f9;
        }

    </style>
<?php endif; ?>

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

        <a href="#logout-modal-parents" data-toggle = "modal" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#c73838; border-color: #c73838;">Log Out</a>
                            
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
            ?>

             <div class = "col-xs-16 col-md-8 col-md-offset-2 content-container container-fluid " style = "margin-bottom: 5px;">
                <div class = "col-xs-16 col-md-16 col-md-offset-0 content-container container-fluid" style="border:0px; margin-bottom: 0px;">
                    <div class = "col-xs-6 no-padding no-margin"> 
                        <h3 class = "no-padding text-info" style = "margin-top: 5px; margin-bottom: 5px; "><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                        <small class = "no-padding no-margin"><?php echo $child->email ?></small>
                        
                        <p class = "wrap text-muted" style = ""><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p>
                    </div>
                </div>    
            </div>                 

            <div class = "content-container container-fluid" >
                <!-- User Posts -->
                <div class = "col-xs-12 col-md-6 content-container container-fluid" style = "margin-bottom: 0px margin-left: 0px">
                    <h3 class = "text-info text-center user-activities-header">
                        <strong><?php echo $child->first_name; ?>'s Use Statistics</strong><br>
                    </h3>
                    <br>
                    <div class = "col-sm-12 " style = "margin-bottom: 40px">
                        <!-- <ul class="nav nav-pills nav-justified">
                            <li class="active "><a data-toggle="pill" href="#user-topic-created">Created Posts</a></li>
                            <li class=""><a data-toggle="pill" href="#user-topic-moderated">Moderated Posts</a></li>
                            <li class=""><a data-toggle="pill" href="#user-topic-followed">Followed Posts</a></li>
                        </ul> -->
                        <br>

                        <div class="tab-content">
                            <div id="user-topic-created" class="tab-pane fade in active">
                                <div class = "col-sm-12 no-padding">
                                    <!-- <div class = "user-header">
                                        <h4 class = "text-center"><strong>Posts Created by <?php echo $child->first_name; ?></strong></h4>
                                    </div> -->
                                    <div class = "">
                                        <ul class="nav">
                                            <!-- <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h3>Updated: </h3></strong>
                                                <h4 class = "" style = "display: inline-block;"><?php echo $child->updated; ?></h4>
                                            </li>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h3>Refresh: </h3></strong>
                                                <h4 class = "" style = "display: inline-block;"><?php 
                                                
                                                ?></h4>
                                            </li> -->

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Total swears this week: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $child->current_total; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Last week's total: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $child->last_total; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Total swears: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $child->overall_total; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Current average: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $child->current_avg; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Last week's average: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $child->last_avg; ?></h3>
                                            </li><br>

                                            <?php 

                                                //ceil to round up float
                                                foreach ($user_topics as $topic)
                                                {

                                                }

                                                $totalRoomPosts=0;
                                                $roomPosts=0;;
                                                $selfPosts=0;
                                                $otherPosts=0;
                                                $shoutOuts=0;
                                                $postCount=0;


                                                foreach ($activities as $post)
                                                {
                                                    // print_r($post);
                                                    if ($topic->topic_id == $post->topic_id)
                                                    {
                                                        
                                                        if($post->shout == '1')
                                                        {
                                                            $shoutOuts++;
                                                        }    

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

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Total posts in room: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $totalRoomPosts; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "text-indent: 50px; display: inline-block; margin-right: 20px"><h4>Stuff shared: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $selfPosts; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "text-indent: 50px; display: inline-block; margin-right: 20px"><h4>Posts in room: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $roomPosts; ?></h3>
                                            </li>

                                            <li>
                                                <strong class = "" style = "text-indent: 50px; display: inline-block; margin-right: 20px"><h4>Shoutouts: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $shoutOuts; ?></h3>
                                            </li><br>

                                            <li>
                                                <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Posts in other rooms: </h4></strong>
                                                <h3 class = "" style = "display: inline-block;"><?php echo $otherPosts; ?></h3>
                                            </li>
                                            <!-- <?php foreach ($user_topics as $topic): ?>
                                                <li>
                                                    <a class = "user-topic-item" href="#" style = "padding: 5px 30px;">
                                                        <h4 class = "no-padding no-margin" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                        <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity -->
                <div class = "col-xs-12 col-md-6 content-container container-fluid" style = "margin-bottom: 5px; margin-left: 0px">
                    <h3 class = "text-info text-center user-activities-header">
                        <strong><?php echo $child->first_name; ?>'s Activity</strong>
                    </h3>
                    
                    <div class = "col-sm-12 " style = "margin-bottom: 40px">
                        <!-- POST PREVIEW -->
                        <?php foreach ($activities as $post): ?> 
                            <div class = "col-xs-12 no-padding post-container" style = "margin-top: 10px;">
                                <div class = "user-post-heading no-margin">
                                    
                                    <?php if ($topic->topic_id == $post->topic_id): ?>
                                        <span>posted to <strong>their room</strong> </span>

                                    <?php else: ?>
                                        <span>posted in <strong><?php echo $post->topic_name; ?></strong> </span> 

                                    <?php endif; ?>
                                    
                                    <!-- <strong><?php echo utf8_decode($post->topic_name); ?></strong> -->
                                    <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                   
                                    <!-- <?php if (!empty($post->parent)): ?>
                                        <span class = "text-muted" style = "font-size: 1vw;">( <i class = "fa fa-reply"></i> <i>in reply to <?php echo $post->parent->user->first_name . " " . $post->parent->user->last_name; ?> )</i></span>
                                    <?php endif; ?> -->
                                    :
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
                        <?php endforeach; ?>
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

<?php
    include(APPPATH . 'views/modals/network_view_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
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
            

            <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid " style = "margin-bottom: 5px;">
                <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid" style="border:0px; margin-bottom: 0px;">
                    <div class = "col-xs-12 col-md-12 col-sm-12 text-center"> 
                        <?php if($child->is_enabled === '0'):?>
                            <h4 class = "no-padding no-margin" style="color:red;"><b>Account Unverified</h4></b><br>
                        <?php endif;?>

                        <img id = "user-pic-display" class = "img-circle" width = "100px" height = "100px" src = "<?php echo $child->profile_url ? base_url($child->profile_url) : base_url('images/default.jpg') ?>" style = "margin-bottom: 5px;">
                        <br>
                        <h3 class = "no-padding text-info" style = "margin-top: 5px; margin-bottom: 5px; "><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                        <h5 class = "no-padding no-margin" style = "margin-top: 5px; margin-bottom: 5px; "><?php echo $child->email ?></h5>
                        <h5 class = "no-padding no-margin" style = "margin-top: 5px; margin-bottom: 5px; "><?php echo date_format(date_create($child->birthdate),"M d, Y") ?></h5>
                        
                        <!-- <p class = "wrap text-muted" style = ""><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p> -->
                    
                        <a class = "btn btn-primary col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3" style="font-size:14px; margin-top: 15px;" href = "<?php echo base_url('parents/settings/' . $child->user_id) ?>" ><i class = "glyphicon glyphicon-time"></i> 
                            <?php if (!$mobile): ?>
                                Manage <?php echo $child->first_name?>'s Schedule

                            <?php else: ?>
                                Schedule

                            <?php endif; ?>
                        </a>

                    </div>
                    

                </div>    
            </div>                 

            <div class = "content-container container-fluid" >
                <!-- User Room -->
                <div class = "col-xs-12 col-sm-6 col-md-6 content-container container-fluid row" style = "margin-bottom: 0px; margin-left: 0px">
                    <h3 class = "text-info text-center user-activities-header">
                        <strong><?php echo $child->first_name; ?>'s Use Statistics</strong><br>
                    </h3>
                    <br>

                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Posts to others</h4></strong> <br><h2 class = "" style = "display: inline-block;"><?php echo $otherPosts; ?></h2>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Total posts: </h4></strong> <br><h2 class = "" style = "display: inline-block;"><?php echo $totalRoomPosts; ?></h2>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Stuff shared: </h4></strong><br> <h2 class = "" style = "display: inline-block;"><?php echo $selfPosts; ?></h2><br><br><br>
                    </div>

                    <div class=" col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Replies: </h4></strong><br> <h2 class = "" style = "display: inline-block;"><?php echo $roomPosts; ?></h2>
                    </div>

                    <div class=" col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Shout outs: </h4></strong><br> <h2 class = "" style = "display: inline-block;"><?php echo $shoutOuts; ?></h2>
                    </div>


                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <br><br>
                    </div>


                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <i><strong class = "" style = "display: inline-block; margin-right: 20px"><h5>(Last updated: <?php echo date_format(date_create($child->updated),"m/d/Y"); ?> )</h5></strong></i>
                    </div><br><br><br>

                    <div class=" col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Swears this week: </h4></strong> <h2 class = "" style = "display: inline-block;"><?php echo $child->current_total; ?></h2>
                    </div>

                    <div class=" col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Swears last week: </h4></strong> <h2 class = "" style = "display: inline-block;"><?php echo $child->last_total; ?></h2>
                    </div>

                    <div class=" col-md-4 col-sm-4 col-xs-4">
                        <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Lifetime swears: </h4></strong> <h2 class = "" style = "display: inline-block;"><?php echo $child->overall_total; ?></h2>
                    </div>

                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <br><br>
                    </div>


                    <!-- User Room -->
                    <div class = "col-xs-12 col-sm-12 col-md-12 col-md-offset-0 content-container container-fluid row" style = "margin-bottom: 0px; margin-left: 0px">
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

                            <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Previous notes to <?php echo $child->first_name;?>: </h4></strong> <h2 class = "" style = "display: inline-block;"></h2>
                                <?php 
                                    
                                    $CI->load->model('user_model'); //load models       
                                    $notes = $CI->user_model->get_notes($id); //get notes

                                    foreach (array_reverse($notes) as $note): ?>

                                    <li class = "list-group-item admin-list-item">
                                        <i class = "pull-right">(<?php echo date_format(date_create($note->date),"M d Y - H:i");?>)</i>
                                        <h3 class = "no-padding admin-list-name"><?php echo utf8_decode($note->note); ?></h3>
                                    </li>
                                                                       
                                <?php endforeach; ?>
                            
                        </div>
                    </form> 
                    
                </div>



                <!-- Activity -->
                <div class = "col-xs-12 col-md-6 col-sm-6 content-container container-fluid tab-content" style = "margin-bottom: 0px; margin-left: 0px">
                    <h3 class = "text-info text-center user-activities-header">
                        <strong><?php echo $child->first_name; ?>'s Activity</strong>
                    </h3>
                    
                    <br>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active "><a data-toggle="pill" href="#all-posts">All</a></li>
                        <li class=""><a data-toggle="pill" href="#room-posts">Room Posts</a></li>
                        <li class=""><a data-toggle="pill" href="#other-posts">Posts in other rooms</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- ALL POSTS -->
                        <div id="all-posts" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade in active" style = "margin-bottom: 40px; ">
                            <?php foreach ($activities as $post): ?> 
                                <div class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                    <div class = "user-post-heading no-margin">
                                        
                                        <?php if ($topic->topic_id == $post->topic_id): ?>
                                            <span>posted to <strong>their room</strong> </span>

                                        <?php else: ?>
                                            <span>posted in <strong><?php echo $post->topic_name; ?></strong> </span> 

                                        <?php endif; ?>
                                        
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                       
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

                        <!-- POSTS IN OWN ROOM -->
                        <div id="room-posts" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px">
                            <?php foreach ($activities as $post): 
                                if ($topic->topic_id == $post->topic_id):?> 
                                
                                <div class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                    <div class = "user-post-heading no-margin">
                                        
                                        <span>posted to <strong>their room</strong> </span>
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                       
                                    </div>

                                    <div class = "col-xs-12 user-post-content no-padding">
                                        <div class = "col-xs-10 no-padding" style = "margin-top: 1vw; margin-left: 1vw;">
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
                            <?php endif;
                            endforeach; ?>
                        </div>

                        <!-- POSTS IN OTHER ROOMS -->
                        <div id="other-posts" class = "col-sm-12 col-xs-12 col-md-12 tab-pane fade" style = "margin-bottom: 40px">
                            <?php foreach ($activities as $post): 
                                if (!($topic->topic_id == $post->topic_id)):?> 
                                
                                <div class = "col-xs-12 no-padding post-container " style = "margin-top: 10px;">
                                    <div class = "user-post-heading no-margin">
                 
                                        <span>posted in <strong><?php echo $post->topic_name; ?></strong> </span> 
                                        
                                        <span class = "text-muted"> <i style = "font-size: 11px">(<?php echo date("M-d-y", strtotime($post->date_posted)); ?>)</i></span>
                                       
                                    </div>

                                    <div class = "col-xs-12 user-post-content no-padding">
                                        <div class = "col-xs-10 no-padding" style = "margin-top: 1vw; margin-left: 1vw;">
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
                            <?php endif;
                            endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
    </div>

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
    include(APPPATH . 'views/modals/create_note_modal.php');
    include(APPPATH . 'views/modals/network_view_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
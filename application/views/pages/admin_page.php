<?php
    include(APPPATH . 'views/header.php');
    $logged_user = $_SESSION['logged_user'];

    //check if current user is admin or logged in
    //if user is not an admin, redirect to home
    //if user is not logged in, redirect to sign in
    if($logged_user->role_id != 1 || $logged_user == null)
    {      
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    $CI =&get_instance();
    $CI->load->library('user_agent');

    $mobile=$CI->agent->is_mobile();
?>
<?php if ($logged_user->role_id == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>

<link rel="stylesheet" href="<?php echo base_url('lib/css/emoji_parentview.css'); ?>"/>

<style>
    .emoji-picker-icon 
    {
        margin-top: 0px;
        position: absolute; 
    }
</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        
        <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/mukhlatlogo_side_basic.png'); ?>"/></a>

        <?php if (!$mobile): ?>

            <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px;">
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <!-- <img class = "img-rounded nav-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/>  -->
                        <?php echo $logged_user->first_name . " " . $logged_user->last_name; ?>
                        
                        <span class="caret"></span>
                    </a>                 
                
                    <ul class="dropdown-menu">
                        <li><a href = "#edit-profile-modal-admin" data-toggle = "modal"><i class = "fa fa-pencil"></i> Edit Profile</a></li>
                        <li><span style="color:white">______</span></li>
                        <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Logout</a></li>

                    </ul>
                </li>
            </ul>

        <?php else: ?>
            <a href="#edit-profile-modal-admin" data-toggle = "modal" class = "btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#269588; border-color: #269588;">Edit Profile</a>
            <a href="#logout-modal-parents" data-toggle = "modal" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#c73838; border-color: #c73838;">Log Out</a>
                            
        <?php endif; ?>
                            
    </div>
    
</nav><br><br><br>

<body class = "sign-in">

    <div id = "admin-page" class = "container" style = "margin-top: 0px;">
        <div class = "row">
            <!-- Admin Header -->
            <div class = "col-md-8 col-md-offset-2 content-container container-fluid text-center" style = "margin-bottom: 0px;">
                <!-- <h3 class = "text-info no-margin" style = "display: inline-block; margin-top: 5px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3> -->
            </div>

            <!-- Admin Content -->
            <div class = "col-md-8 col-md-offset-0 col-sm-8 col-xs-12 col-md-offset-0 col-xs-offset-0 content-container row">
                <h3 class = "text-info text-center user-activities-header col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">Users of Mukhlat</h3>

                <div class = "content-container container-fluid col-md-12 col-md-offset-0 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                    <ul class="nav nav-pills nav-justified" style="">
                        <li class="active"><a data-toggle="pill" href="#user-list-1">Children</a></li>
                        <li class=""><a data-toggle="pill" href="#user-list-2">Parents</a></li>
                        <li class=""><a data-toggle="pill" href="#user-list-3">Administrators</a></li>
                        <!-- <li class=""><a data-toggle="pill" href="#announcements">Announcements</a></li> -->
                    </ul>
                </div>

                <div class = "col-md-12 col-sm-12 col-xs-12 container-fluid tab-content " style="max-height:500px; overflow-x: hidden; overflow-y: scroll">
                    <div id = "user-list-1" class = "list-group tab-pane fade in active ">
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '2'):?>

                                <li class = "list-group-item admin-list-item container-fluid">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 

                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>

                                    <?php 
                                        $CI =&get_instance();
                                        $CI->load->model('user_model'); //load model       
                                        $parentExists = $CI->user_model->user_exists_email($user->parent); //check if email exists

                                        // print_r($parentExists);
                                    ?>

                                    <?php if (!($user->is_enabled)):?>

                                        <?php if($user->parent === "" || !($user->parent)):?>
                                        <br><small class = "no-padding no-margin" style="color:red;"><b>(No Parent/Guardian Email)</b></small>

                                        <?php else:?>

                                            <?php if (!empty($parentExists)):?>
                                                <br><small class = "no-padding no-margin">(Parent/Guardian: <?php echo $user->parent?>)</small>

                                            <?php else:?>
                                                <br><small class = "no-padding no-margin" style="color:red;"><b><?php echo $user->parent?></b> is not a valid Parent/Guardian Email</small><br>
                                            
                                            <?php endif;?>
                                            
                                                           
                                        <?php endif;?>

                                    <?php else:?>

                                        <?php if($user->parent === "" || !($user->parent)):?>
                                        <br><small class = "no-padding no-margin" style="color:red;"><b>(No Parent/Guardian Email)</b></small>

                                        <?php else:?>

                                            <?php if (!empty($parentExists) && !$user->is_enabled):?>
                                                <br><small class = "no-padding no-margin">(Parent/Guardian: <?php echo $user->parent?>)</small>

                                            <?php elseif (empty($parentExists)):?>
                                                <br><small class = "no-padding no-margin" style="color:red;"><b><?php echo $user->parent?></b> is not a valid Parent/Guardian Email</small><br>
                                            
                                            <?php endif;?>
                                            
                                                           
                                        <?php endif;?>

                                    <?php endif;?>
                                    <a value = "" href="<?php echo base_url('admin/activity/' . $user->user_id)?>" class = "btn-link btn-xs"> <i>View record</i></a>

                                    <?php
                                        if ($logged_user->user_id !== $user->user_id):
                                            if ($user->is_enabled && !empty($parentExists)): ?>
                                                    <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-danger admin-list-btn">Disable</button>

                                                <?php elseif ($user->is_enabled && empty($parentExists)): ?>
                                                    <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-danger admin-list-btn">Disable</button>
                                                
                                                <?php elseif(!$user->is_enabled && !empty($parentExists)): ?>
                                                    <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-success admin-list-btn">Enable</button>
                                            <?php
                                            endif;
                                        endif;
                                    ?>
                                </li>                                    
                       
                            <?php endif; ?> 

                        <?php endforeach; ?>
                    </div>

                    <div id = "user-list-2" class = "list-group tab-pane fade">
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '3'):?>

                                <li class = "list-group-item admin-list-item container-fluid">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 

                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>

                                    <a value = "" href="<?php echo base_url('admin/parent/' . $user->user_id)?>" class = " btn btn-link btn-xs"> <i>View Children</i></a>

                                    <?php
                                        if ($logged_user->user_id !== $user->user_id):
                                            if ($user->is_enabled):
                                                ?>
                                                <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-danger admin-list-btn">Disable</button>
                                            <?php else: ?>
                                                <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-success admin-list-btn">Enable</button>
                                            <?php
                                            endif;
                                        endif;
                                    ?>
                                </li>                                    
                       
                            <?php endif; ?> 

                        <?php endforeach; ?>
                        
                    </div>

                    <div id = "user-list-3" class = "list-group tab-pane fade">
                        
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '1'):?>

                                <li class = "list-group-item admin-list-item container-fluid">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 
                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>
                                    
                                        <i class = "text-muted btn-sm no-padding"><?php echo ($logged_user->user_id === $user->user_id) ? '(You)' : '' ?></i>

                                    <?php
                                        if ($logged_user->user_id !== $user->user_id):
                                            if ($user->is_enabled):
                                                ?>
                                                <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-danger admin-list-btn">Disable</button>
                                            <?php else: ?>
                                                <button type = "button" value = "<?php echo $user->user_id ?>" class = "toggle-account pull-right btn btn-success admin-list-btn">Enable</button>
                                            <?php
                                            endif;
                                        endif;
                                    ?>
                                </li>                                    
                       
                            <?php endif; ?> 

                        <?php endforeach; ?>
                    </div>

                    
                </div>
            </div>

            <div class = "col-md-4 col-sm-4 col-xs-12 col-md-offset-0 col-xs-offset-0 col-sm-offset-0 content-container row">
                <!-- <h3 style="margin-left: 15px">Announcements</h3> -->
                <h3 class = "text-info text-center user-activities-header col-md-offset-0">Announcements</h3><br>
                <form enctype = "multipart/form-data" action = "<?php echo base_url('topic/announcement'); ?>" id = "create-announcement-form" method = "POST">
                    <div class="form-group container-fluid" >

                        <?php if(!$mobile): ?>
                        <p class="emoji-picker-container">
                            <textarea class = "form-control" data-emojiable="true" style="height: 100px;" maxlength = "200" required name = "announcement_content" id = "announcement-content" placeholder = "Write your announcement here:" ></textarea>
                        </p>

                        <?php else:?>
                            <textarea class = "form-control" style="height: 100px;" maxlength = "200" required name = "announcement_content" id = "announcement-content" placeholder = "Write your announcement here:" ></textarea>
                        
                        <?php endif;?>
                        
                        <div class = "modal-footer" style = "">
                            <button id = "create-announcement-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" >Share</button>
                        </div>

                    </div>
                    
                    
                    
                </form>  

                <div id = "announcements" class = "list-group  content-container container-fluid" style="max-height:300px; overflow-x: hidden; overflow-y: scroll">
                    <?php 
                        //load models
                        $CI->load->model('topic_model');
                        $CI->load->model('user_model');

                        //get announcements
                        $announcements = $CI->topic_model->get_announcements();

                        //get teacher's details for each announcement
                        foreach (array_reverse($announcements) as $announcement):

                            $details = $CI->user_model->view_adult($announcement->user_id);

                            foreach ($details->result() as $teacher) //store teacher's details in array
                                $data['user'] = $CI->user_model->get_details(true, true, array('user_id' => $announcement->user_id));
                            
                    ?>

                        <li class = "list-group-item admin-list-item">
                            <!-- <?php echo ($logged_user->user_id === $teacher->user_id) ? 'You:' : $teacher->first_name ?> -->
                            <!-- <h5 class = "no-padding admin-list-name">Teacher <?php echo $teacher->first_name?> says: </h5> -->

                            <i class = "pull-left"><?php echo ($logged_user->user_id === $teacher->user_id) ? 'You:' : $teacher->first_name." ".$teacher->last_name.":" ?></i>
                            <i class = "pull-right">(<?php echo date_format(date_create($announcement->date),"M d Y - H:i");?>)</i>
                            

                            <br><br><h4 class = "">"<?php echo utf8_decode($announcement->announcement) ?>"</h4>
                        </li>                                    
                   
                    <?php endforeach; ?>
                </div>

                 
            </div>
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
    window.emojiPicker = new EmojiPicker
    ({
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

</body>
</html>

<?php
    //include(APPPATH . "views/modals/user_record_modal.php");
    // include(APPPATH . 'views/modals/create_announcement_modal.php');

    include(APPPATH . 'views/modals/edit_profile_modal_admins.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
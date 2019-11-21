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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        
        <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/mukhlatlogo_side_basic.png'); ?>"/></a>

        <a href="#logout-modal-parents" data-toggle = "modal" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#c73838; border-color: #c73838;">Log Out</a>
                            
    </div>
    
</nav><br><br><br>

<body class = "sign-in">

   

    <div id = "admin-page" class = "container" style = "margin-top: 30px;">
        <div class = "row">
            <!-- Admin Header -->
            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 0px;">
                <h3 class = "text-info no-margin" style = "display: inline-block; margin-top: 5px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3>
                

                <a href = "#create-announcement-modal" data-toggle = "modal" class = "btn btn-primary btn-block" style="font-size:14px; margin-top: 15px;"><i class = "fa fa-globe"></i> Create Announcement</a> 

                <!-- <button id="crettop" class = "container col-md-6 btn btn-primary  textoutliner" href="#"  >Create Announcement</button> -->

                <!-- <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px;">Log Out</a> --><br><br>

                <!-- <a href = "<?php echo base_url('admin/network'); ?>" class = "btn btn-primary btn-block"><i class = "fa fa-globe"></i> View Interaction Network of Mukhlat</a> -->
                 
            </div>

            <!-- Admin Content -->
            <div class = "col-md-8 col-md-offset-2 content-container">
                <!-- <div class = "col-md-12">
                    <form action = "javascript:void(0);" role="search">
                        <div class="input-group" style = "width: 100%">
                            <input type="text" class="form-control search-text" placeholder="&#xF002; Search for a user" id = "search-user-list">
                        </div>
                    </form>
                </div> -->

                <div class = "content-container container-fluid col-md-10 col-md-offset-1 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                    <ul class="nav nav-pills nav-justified" style="">
                        <li class="active"><a data-toggle="pill" href="#user-list-1">Children</a></li>
                        <li class=""><a data-toggle="pill" href="#user-list-2">Parents</a></li>
                        <li class=""><a data-toggle="pill" href="#user-list-3">Administrators</a></li>
                        
                    </ul>
                </div>

                <div class = "col-md-12 container-fluid tab-content">
                    <div id = "user-list-1" class = "list-group tab-pane fade in active container-fluid">
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '2'):?>

                                <li class = "list-group-item admin-list-item">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 

                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>

                                    <a value = "" href="<?php echo base_url('admin/activity/' . $user->user_id)?>" class = " btn btn-link btn-xs"><i class = "fa fa-question-circle-o"></i> <i><?php echo $user->first_name ?>'s record</i></a>

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

                    <div id = "user-list-2" class = "list-group tab-pane fade container-fluid">
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '3'):?>

                                <li class = "list-group-item admin-list-item">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 

                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>

                                    <a value = "" href="<?php echo base_url('admin/parent/' . $user->user_id)?>" class = " btn btn-link btn-xs"><i class = "fa fa-question-circle-o"></i> <i>Children of <?php echo $user->first_name ?></i></a>

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

                    <ul id = "user-list-3" class = "list-group tab-pane fade container-fluid">
                        
                        <?php foreach ($users as $user): 

                            if ($user->role_id === '1'):?>

                                <li class = "list-group-item admin-list-item">
                                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" class = "no-padding pull-left img-circle" width = "45px" height = "45px"/> 
                                    <h4 class = "no-padding admin-list-name"><?php echo $user->first_name . " " . $user->last_name ?></h4>
                                    
                                        <i class = "text-muted btn-sm no-padding">Administrator <?php echo ($logged_user->user_id === $user->user_id) ? '(You)' : '' ?></i>

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
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url("/js/admin.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("/js/search.js"); ?>"></script>

</body>
</html>

<?php
    //include(APPPATH . "views/modals/user_record_modal.php");
    include(APPPATH . 'views/modals/create_announcement_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
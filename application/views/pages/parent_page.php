<?php
    include(APPPATH . 'views/header.php');

    //check if current user is parent or logged in
    //if current user is not a parent, redirect to home
    //if current user is not logged in, redirect to sign in
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 3 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    $this->load->model('user_model', 'users');
    $children = $this->users->view_child($logged_user->user_id);

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

    document.cookie = "defaultTimeSetting=cell8-A cell9-A cell10-A cell11-A cell12-A cell13-A cell14-A cell15-A cell16-A cell17-A cell18-A cell19-A cell20-A cell21-A cell22-A cell23-A cell24-A cell25-A cell26-A cell27-A cell28-A cell29-A cell30-A cell31-A cell32-A cell33-A cell34-A cell35-A cell36-A cell37-A cell38-A cell39-A cell40-A cell41-A cell42-A cell43-A cell44-A cell45-A cell46-A cell47-A cell48-A cell49-A;path=/";   

    document.cookie = "defaultWarningSetting=30;path=/"; 
    
</script>

<style>div.content-container{border:0px;}</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        
        <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/mukhlatlogo_side_basic.png'); ?>"/></a>

        <?php if (!$mobile): ?>

            <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px;">
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img class = "img-rounded nav-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/> 
                        <?php echo $logged_user->first_name . " " . $logged_user->last_name; ?>
                        
                        <span class="caret"></span>
                    </a>                 
                
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><i class = "fa fa-user"></i> My Profile</a></li> -->
                        
                        <!-- <?php foreach ($children->result() as $child):$data['user'] = $this->users->get_user(true, true, array('user_id' =>  $child->user_id));?>

                        <li><a href="<?php echo base_url('parents/activity/' . $child->user_id); ?>"><i class = "fa fa-user" style="color:green"></i> <?php echo $child->first_name . " " . $child->last_name ?></a></li>    
                        <?php endforeach; ?> -->

                        <!-- <li><span style="color:white">______</span></li> -->
                        
                        <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Logout</a></li>

                    </ul>
                </li>
            </ul>

        <?php else: ?>
            <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>
                            
        <?php endif; ?>

    </div>
    
</nav><br><br><br>

<body class = "sign-in">

    <div class = "container" style = "">
        <div class = "row">

            <?php foreach ($children->result() as $child): 

                $data['user'] = $this->users->get_user(true, true, array('user_id' => $child->user_id));
                // echo print_r($child->topics);
                // var_dump($data);

                $CI =&get_instance();
                $CI->load->model('topic_model');

                $user_topics = $CI->topic_model->get_user_topics($child->user_id);
                $user_moderated_topics = $CI->topic_model->get_moderated_topics($child->user_id);
                $user_followed_topics = $CI->topic_model->get_followed_topics($child->user_id);

                ?>
                <div class = "col-xs-16 col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 5px;">
                     <div class = "col-xs-16 col-md-12 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 5px; border:0">
                        
                        <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                        <small class = "no-padding no-margin"><?php echo $child->email ?></small>
                        
                        <p class = "wrap text-muted" style = ""><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p>
                        <a href = "<?php echo base_url('parents/activity/' . $child->user_id); ?>" class = "btn btn-primary btn-block" style = "margin-bottom: 10px; "><i class = "fa fa-globe"></i> View <?php echo $child->first_name ?>'s activity</a>
                    </div>

                   
                </div>    
            <?php endforeach; ?>

        </div>
    </div>

</body>
</html>
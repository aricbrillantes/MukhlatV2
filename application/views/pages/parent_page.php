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


        div.content-container
        {
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

<style>div.content-container{border:0px;}</style>

<?php if ($logged_user->role_id == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>

<link href="https://fonts.googleapis.com/css?family=Cabin|Muli|Oswald" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                        <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Logout</a></li>

                    </ul>
                </li>
            </ul>

        <?php else: ?>
            <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>
                            
        <?php endif; ?>

    </div>
    
</nav><br><br><br>
<?php 
    
    $count=0;

    foreach ($children->result() as $child)
        $count++;
    
?>
<body class = "sign-in">

    <div class = "container" style = "">
        <?php if ($count>0): ?>
        <div class = "row">

            <?php foreach ($children->result() as $child): 

                $data['user'] = $this->users->get_user(true, true, array('user_id' => $child->user_id));
                
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

        <?php elseif ($count<1): ?>

        <div class = "row">

            <div class = "col-xs-16 col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 5px;">
                <div class = "col-xs-16 col-md-12 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 5px; border:0">
                    <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong>You currently have no children registered!</strong></h3>
                </div>
            </div>    
        </div>

        <?php endif; ?>
    </div>

</body>
</html>
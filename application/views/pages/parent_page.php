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

    if(!$mobile)
    {
        // echo "<script type='text/javascript'>alert('desktop');</script>";
    }   

    else
    {
        // echo "<script type='text/javascript'>alert('mobile');</script>";
    }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        
        <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/logo-blue.png'); ?>"/></a>
            
        <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>

    </div>
</nav>
<br>
<br>
<br>

<body class = "sign-in">

    <div class = "container" style = "">
        <div class = "row">
<!--             <div class = "col-md-8 col-md-offset-2 content-container no-padding " style = "margin-bottom: 5px;">
                <a style = "display: inline-block; margin-right: 5px;" >
                    <h3 class = "pull-left" style = "margin-top: 12%; margin-left: 11px; margin-bottom: 0%; ">
                        <strong class = "text-info">
                            <?php echo $logged_user->first_name . " " . $logged_user->last_name ?>
                        </strong>
                    </h3>
                </a>
                
                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>
            </div> -->

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
                <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                    <div class = "no-padding no-margin">
                        
                        <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                        <small class = "no-padding no-margin"><?php echo $child->email ?></small>
                        
                        <p class = "wrap text-muted" style = "font-size: 12px;"><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p>
                        <a href = "<?php echo base_url('parents/activity/' . $child->user_id); ?>" class = "btn btn-primary btn-block" style = "margin-bottom: 10px; "><i class = "fa fa-globe"></i> View <?php echo $child->first_name ?>'s activity</a>
                    </div>
                </div>    
            <?php endforeach; ?>

        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/network.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

    <?php
    // include(APPPATH . 'views/modals/network_view_modal.php');
    ?>

</body>
</html>
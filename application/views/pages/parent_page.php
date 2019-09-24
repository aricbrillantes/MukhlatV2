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

    // $this->load->model('topic_model', 'topics');

    // $data['user'] = $this->users->get_user(true, true, array('user_id' => $logged_user->user_id));
    // echo print_r($data);
    
    // echo "<b>Successful query!</b><br><br><b>Children:</b>";
    // foreach ($children->result() as $child)
    //     echo "<br>" . $child->first_name . " " . $child->last_name ;
?>
<body class = "sign-in">
    <div class = "container" style = "margin-top: 30px;">
        <div class = "row">
            <div class = "col-md-8 col-md-offset-2 content-container no-padding" style = "margin-bottom: 5px;">
                <a style = "display: inline-block; margin-right: 5px;" >
                    <h3 class = "pull-left" style = "margin-top: 10px; margin-left: 10px; margin-bottom: 0px; padding: 2px;">
                        <strong class = "text-info"><!-- <i class = "fa fa-chevron-left"></i>  -->
                            <?php echo $logged_user->first_name . " " . $logged_user->last_name ?>
                        </strong>
                    </h3>
                </a>
                
                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>
            </div>

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
                    <div class = "col-xs-6 no-padding no-margin">
                        
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
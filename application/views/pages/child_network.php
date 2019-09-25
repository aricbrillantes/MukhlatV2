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
    }

    //load user model
    $CI =&get_instance();
    $CI->load->model('user_model');

    //get user ID of child being monitored (from the URL)
    $id = $this->uri->segment(3);

    if(!$id) //if there is no user ID in the URL, redirect to home page
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    //get data of child being monitored
    $children = $CI->user_model->view_specific_child($id);

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body class = "sign-in">
    <?php foreach ($children->result() as $child): 

        $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));


    ?>
    <div class = "container" style = "margin-top: 30px;">
        <div class = "row">
            <div class = "col-md-8 col-md-offset-2 content-container no-padding" style = "margin-bottom: 5px;">
                <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px;" href="<?php echo base_url('parents/activity/' . $child->user_id) ?>">
                    <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                        <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                            Back
                        </strong>
                    </h3>
                </a>
                <h3 class = "text-info no-margin" style = "display: inline-block; padding-left: 10px; margin-top: 5px; padding-top: 10px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3>
                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px;">Log Out</a>
            </div>

            <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                <div class = "col-sm-12 text-center" style = "margin-bottom: 10px;"><h3 class = "no-margin">Interactions of <?php echo $child->first_name ?></h3></div>
                <div id = "network-tools" class = "col-sm-12" style = "margin-bottom: 10px;">
                    <div class = "col-xs-8 col-md-offset-2">
                        <button id = "reset-map" class = "btn btn-block btn-primary">Reset Interaction Map</button>
                    </div>
                </div>
                <div class = "col-sm-12 content-container"><div id = "interaction-network"></div></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/network.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

    <?php
    include(APPPATH . 'views/modals/network_view_modal.php');
    ?>

</body>
</html>
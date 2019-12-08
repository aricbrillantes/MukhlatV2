<?php
    include(APPPATH . 'views/header.php');

    //check if current user is parent or logged in
    //if current user is not a parent, redirect to home
    //if current user is not logged in, redirect to sign in
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 1 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    $CI =&get_instance();

    //get user ID of parent being monitored (from the URL)
    $id = $this->uri->segment(3);

    if(!$id) //if there is no user ID in the URL, redirect to home page
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    $CI->load->model('user_model');

    $email = $CI->user_model->get_details($id);

    // print_r($email);

    if(!$email)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
        exit(0);
    }

    foreach ($email as $details)
    { 
        $CI =&get_instance();
            
        $data['user'] = $CI->user_model->get_details(true, true, array('user_id' => $details->user_id));

        // print($details->email);

    }

    $parent = $CI->user_model->view_adult($id);

    $children = $CI->user_model->view_child($details->email);
    
    $CI->load->library('user_agent');
    $mobile=$CI->agent->is_mobile();

?>

<style>div.content-container{border:0px;}</style>

<link href="https://fonts.googleapis.com/css?family=Cabin|Muli|Oswald" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />
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


        div.content-container
        {
            border:0px;
            background-color: #f9f9f9;
        }

        @media ( max-width: 568px ) 
        {
            .img-child-list 
            {
                height:48px;
                width:48px;
            }
            
        }

    </style>
<?php endif; ?>


<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
        
        <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px; border:0" href="<?php echo base_url('') ?>">
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
<?php 
    
    $count=0;

    foreach ($children->result() as $child)
        $count++;
    
    // echo($count);
?>
<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <?php foreach ($parent->result() as $user): 

                $CI =&get_instance();
                    
                $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $user->user_id));

                ?>
                
               <div class = "col-md-12 col-sm-12 col-xs-12 content-container container-fluid text-center" style = "">
                    <img id = "user-pic-display" class = "img-circle" width = "100px" height = "100px" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>" style = "margin-bottom: 5px;">
                    
                    <h3 class = "no-padding text-info" style = ""><strong><?php echo $user->first_name . " " . $user->last_name ?></strong></h3>
                            <small class = "no-padding no-margin"><?php echo $user->email ?></small>
                </div>     
            <?php endforeach; ?>

                
            
            <?php if($count>0): ?>
                <div class="content-container container-fluid col-md-12 col-xs-12 col-sm-12 " >
                    <!-- <h3 class = "text-info "><strong>Children of <?php echo $user->first_name . " " . $user->last_name ?></strong></h3>  -->

                <?php foreach ($children->result() as $child): 

                    $CI =&get_instance();
                        
                    $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));

                    ?>
                    
                    <div class="col-xs-3 col-md-2 col-sm-3 col-md-offset-1">
                        <center>
                            <img id = "user-pic-display" class = "img-circle" width = "64px" height = "64px" src = "<?php echo $child->profile_url ? base_url($child->profile_url) : base_url('images/default.jpg') ?>" style = "margin-top: 30px;">
                        </center>
                    </div>

                        

                    <div class = "col-xs-9 col-md-7 col-sm-8 content-container container-fluid " style = "margin-bottom: 5px;">
                        <div class = "col-xs-16 col-md-16 col-md-offset-0 content-container container-fluid" style="border:0px; margin-bottom: 0px;">
                            <div class = "col-xs-12 col-md-12 col-sm-12 no-padding no-margin"> 
                                <h3 class = "no-padding text-info" style = "margin-top: 5px; margin-bottom: 5px; "><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                                <small class = "no-padding no-margin"><?php echo $child->email ?></small>
                                
                                <?php if($child->is_enabled == 0):?>
                                    <h4 style="color:red;"><i>(Account Unverified)</i></h4>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <a href = "<?php echo base_url('admin/activity/' . $child->user_id); ?>" class = "btn btn-primary btn-block" style = "margin-bottom: 10px; "><i class = "glyphicon glyphicon-user"></i> View <?php echo $child->first_name ?>'s activity</a>  
                    </div>     
                <?php endforeach; ?>
                </div>

            <?php elseif($count<1): ?>
                <div class = "col-xs-12 col-md-12 col-sm-12 col-md-offset-0 content-container container-fluid text-center" style = "margin-bottom: 5px;">
                    <div class = "col-xs-12 col-md-12 col-sm-12 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 5px; border:0">
                        <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong><?php echo $user->first_name . " " . $user->last_name ?> has no children registered!</strong></h3>
                    </div>
                </div>     

            <?php endif; ?>
            
        </div>

        
    </div>

</body>
</html>

<?php
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');
?>
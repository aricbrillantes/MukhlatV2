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

    //load topic model
    $CI =&get_instance();
    $CI->load->model('topic_model');


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
<body class = "sign-in">
    <div class = "container" style = "margin-top: 2%;">
        <div class = "row">
            <div class = "col-md-8 col-md-offset-2 content-container no-padding" style = "margin-bottom: 5px;">
                
                <?php if(!$mobile): ?> 
                    <a class = "pull-left btn" style = "display: margin-right: 1%;" href="<?php echo base_url('home') ?>">
                        <h3 class = "pull-left" style = "margin-top: 10%; margin-bottom: 20%; ">
                            <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                                Back
                            </strong>
                        </h3>
                    </a>

                <?php else: ?>
                    <a class = "pull-left btn" style = "display:  margin-right: 1%;" href="<?php echo base_url('home') ?>">
                        <h3 class = "pull-left" style = "margin-top: 10%; margin-bottom: %; ">
                            <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                                Back
                            </strong>
                        </h3>
                    </a>

                <?php endif; ?> 

                <h3 class = "text-info no-margin" style = "display: inline-block; padding-left: 10px; margin-top: 0.5%; padding-top: 10px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3>
                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 2%; margin-top: 1.5%;">Log Out</a>
            </div>


            <?php foreach ($children->result() as $child): 

                //read data of child 
                //note: foreach is needed even though only one child is being fetched

                //store user data in array
                $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));
                
                //get topic data
                $user_topics = $CI->topic_model->get_user_topics($child->user_id);
                $user_moderated_topics = $CI->topic_model->get_moderated_topics($child->user_id);
                $user_followed_topics = $CI->topic_model->get_followed_topics($child->user_id);

                ?>
                <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 1%; margin-top: 1%;">
                    <div class = "col-xs-6 no-padding no-margin">
                        
                        <h3 class = "no-padding text-info" style = "margin-bottom: 0%;"><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                        <small class = "no-padding no-margin"><?php echo $child->email ?></small>
                        
                        <p class = "wrap text-muted" style = "font-size: 12%;"><i><?php echo $child->description ? $child->description : 'Hello World!'; ?></i></p>
                    </div>

                    <div class = "col-xs-6 no-padding no-margin" style="float: right">
                        <a class = "pull-right btn " style = "display: inline-block; float: right: 5px;" href="<?php echo base_url('parents/settings/' . $child->user_id) ?>">
                            <h3 class = "no-padding text-info" style = "margin-bottom: 0px; float: right"><strong><i class = "glyphicon glyphicon-cog"></i></strong></h3>
                        </strong>
                    </h3>
                </a>
                        
                    </div>
                </div>    

                <?php if(!$mobile): ?> 
                    <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                        <h3 class = "text-info text-center user-topic-header"><strong><?php echo $child->first_name ?>'s Activity</strong></h3>

                <?php else: ?>
                    <div class = " col-md-offset-2 content-container" style = "margin-bottom: 10%;">
                        <h5 class = " user-topic-header"><strong><?php echo $child->first_name ?>'s Activity</strong></h3>
                <?php endif; ?> 

                

                    <a href = "<?php echo base_url('parents/network/' . $child->user_id); ?>" class = "btn btn-primary btn-block" style = "margin-bottom: 10px;"><i class = "fa fa-globe"></i> View <?php echo $child->first_name ?>'s activity network</a>

                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#user-topic-created">Created Topics</a></li>
                        <li><a data-toggle="pill" href="#user-topic-moderated">Moderated Topics</a></li>
                        <li><a data-toggle="pill" href="#user-topic-followed">Followed Topics</a></li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div id="user-topic-created" class="tab-pane fade in active">
                            <div class = "col-sm-12 no-padding">
                                <div class = "user-header">
                                    <h4 class = "text-center"><strong>Topics Created by <?php echo $child->first_name; ?></strong></h4>
                                </div>
                                <div class = "user-topic-div">
                                    <ul class="nav">
                                        <?php foreach ($user_topics as $topic): ?>
                                            <li>
                                                <a class = "user-topic-item" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style = "padding: 5px 30px;">
                                                    <h4 class = "no-padding no-margin" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                    <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="user-topic-moderated" class="tab-pane fade">
                            <div class = "user-header">
                                <h4 class = "text-center"><strong>Topics Moderated by <?php echo $child->first_name; ?></strong></h4>
                            </div>
                            <div class = "user-topic-div">
                                <ul class="nav">
                                    <?php foreach ($user_moderated_topics as $topic): ?>
                                        <li>
                                            <a class = "user-topic-item" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style = "padding: 5px 30px;">
                                                <h4 class = "no-padding no-margin" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div id="user-topic-followed" class="tab-pane fade">
                            <div class = "col-sm-12 no-padding">
                                <div class = "user-header">
                                    <h4 class = "text-center"><strong>Topics Followed by <?php echo $child->first_name; ?></strong></h4>
                                </div>
                                <div class = "user-topic-div">
                                    <ul class="nav">
                                        <?php foreach ($user_followed_topics as $topic): ?>
                                            <li>
                                                <a class = "user-topic-item" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style = "padding: 5px 30px;">
                                                    <h4 class = "no-padding no-margin" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                                    <span class = "pull-right label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0' ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
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

    <?php
    include(APPPATH . 'views/modals/network_view_modal.php');
    ?>

</body>
</html>
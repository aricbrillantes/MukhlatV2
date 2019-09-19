<?php
    include(APPPATH . 'views/header.php');
    
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 3 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    $this->load->model('user_model', 'users');
    $children = $this->users->view_child($logged_user->user_id);
    // echo print_r($children);
    
    // echo "<b>Successful query!</b><br><br><b>Children:</b>";
    // foreach ($children->result() as $row)
    //     echo "<br>" . $row->first_name . " " . $row->last_name ;
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

         <!--    <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                <div class = "col-xs-6 no-padding no-margin">
                    
                    <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3>
                    <small class = "no-padding no-margin"><?php echo $logged_user->email ?></small>
                    
                    <p class = "wrap text-muted" style = "font-size: 12px;"><i><?php echo $logged_user->description ? $logged_user->description : 'Hello World!'; ?></i></p>
                </div>

                <div class = "col-md-8 col-md-offset-2 ">
                    <a href = "<?php echo base_url('parents/activity'); ?>" class = "btn btn-primary btn-block"><i class = "fa fa-globe"></i> View child's posts</a>                
                </div>
            </div>
 -->
            <?php foreach ($children->result() as $row): ?>
                <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                    <div class = "col-xs-6 no-padding no-margin">
                        
                        <h3 class = "no-padding text-info" style = "margin-bottom: 0px;"><strong><?php echo $row->first_name . " " . $row->last_name ?></strong></h3>
                        <small class = "no-padding no-margin"><?php echo $row->email ?></small>
                        
                        <p class = "wrap text-muted" style = "font-size: 12px;"><i><?php echo $row->description ? $row->description : 'Hello World!'; ?></i></p>
                    </div>

                    
                </div>    


                <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                    <h3 class = "text-info text-center user-topic-header"><strong><?php echo $row->first_name ?>'s Activity</strong></h3>

                    <a href = "<?php echo base_url('parents/activity'); ?>" class = "btn btn-primary btn-block" style = "margin-bottom: 10px;"><i class = "fa fa-globe"></i> View <?php echo $row->first_name ?>'s activity network</a>

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
                                    <h4 class = "text-center"><strong>Topics Created by <?php echo $row->first_name; ?></strong></h4>
                                </div>
                                <div class = "user-topic-div">
                                    <ul class="nav">
                                        <?php foreach ($logged_user->topics as $topic): ?>
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
                                <h4 class = "text-center"><strong>Topics Moderated by <?php echo $logged_user->first_name; ?></strong></h4>
                            </div>
                            <div class = "user-topic-div">
                                <ul class="nav">
                                    <?php foreach ($logged_user->moderated_topics as $topic): ?>
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
                                    <h4 class = "text-center"><strong>Topics Followed by <?php echo $logged_user->first_name; ?></strong></h4>
                                </div>
                                <div class = "user-topic-div">
                                    <ul class="nav">
                                        <?php foreach ($logged_user->followed_topics as $topic): ?>
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

    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/network.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

    <?php
    include(APPPATH . 'views/modals/network_view_modal.php');
    ?>

</body>
</html>
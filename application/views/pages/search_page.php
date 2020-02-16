<?php
    include(APPPATH . 'views/header.php');
?>
<body>
    <?php
        include(APPPATH . 'views/navigation_bar.php');

        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }

    ?>

    <div class = "container page">
        <div class = "row">
            <div class = "col-md-offset-2 col-md-8 content-container text-center">
                <h4 class = "text-muted"><i class = "fa fa-search"></i> Search Results for <i><?php echo $keyword; ?></i></h4>
<!--                <ul class="nav nav-pills" style = "display: inline-block;">
                    <li class="active"><a data-toggle = "pill" href="#user-search">Roomies</a></li>
                    <li><a data-toggle = "pill" href = "#topic-search">Topics</a></li>
                </ul>-->
            </div>
            <div class = "col-md-offset-2 col-md-8 col-xs-12 col-sm-12 col-lg-8 col-xl-8 content-container text-center">
                <div class = "tab-content">
                    <!-- USERS -->
                    <div id="user-search" class="tab-pane fade in active">
                        <div id = "topic-list" class = "list-group">
                            <?php
                            if (!empty($topics)):
                                foreach ($topics as $topic):
                                    ?><?php $wallpaper="";
                        if($topic->theme=="1"): $theme="roomthemes roomtheme-arrow";
                        elseif($topic->theme=="2"): $theme="roomthemes roomtheme-zigzag";
                        elseif($topic->theme=="3"): $theme="roomthemes roomtheme-scales";
                        elseif($topic->theme=="4"): $theme="roomthemes roomtheme-halfrhombe";
                        elseif($topic->theme=="5"): $theme="roomthemes roomtheme-marrakesh";
                        elseif($topic->theme=="6"): $theme="roomthemes roomtheme-hearts";
                        elseif($topic->theme=="7"): $theme="roomthemes roomtheme-stars";
                        elseif($topic->theme=="8"): $theme="roomthemes roomtheme-seigaiha";
                        elseif($topic->theme=="9"): $theme="roomthemes roomtheme-bricks";
                        elseif($topic->theme=="10"): $theme="roomthemes roomtheme-diacheckerboard";
                        elseif($topic->theme=="11"): $theme="roomthemes roomtheme-tablecloth";
                        elseif($topic->theme=="12"): $theme="roomthemes roomtheme-brady";
                        elseif($topic->theme=="13"): $theme="roomthemes roomtheme-argyle";
                        elseif($topic->theme=="14"): $theme="roomthemes roomtheme-shippo";
                        elseif($topic->theme=="15"): $theme="roomthemes roomtheme-waves";
                        elseif($topic->theme=="16"): $theme="roomthemes roomtheme-polkadot";
                        elseif($topic->theme=="17"): $theme="roomthemes roomtheme-honeycomb";
                        elseif($topic->theme=="18"): $theme="roomthemes roomtheme-chocolateweave";
                        elseif($topic->theme=="19"): $theme="roomthemes roomtheme-crosseddot";
                        else: $theme="topic-grid1 col-md-3";$wallpaper="background-color: #".$topic->theme;
                        endif;?> 
                            <a class = "roomthemes elements-resizer <?php echo $theme?>" href = "topic/view/<?php echo $topic->topic_id; ?>" style="<?php echo $wallpaper?>">
                                        <!--<img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $topic->user->profile_url ? base_url($topic->user->profile_url) : base_url('images/default.jpg'); ?>"/>--> 
                                        <h4 class = "text-info no-padding no-margin  text1color topicheader clicker" style = "display: inline-block;"><?php echo $topic->topic_name;?></h4>
                                        <!--<small><i>by <?php echo $topic->user->first_name . " " . $topic->user->last_name; ?></i></small>-->
<!--                                        <div class = "pull-right">
                                            <span class = "label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0'; ?></span>
                                        </div>-->
                                    </a>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <h3 class = "text-warning">Oops, it looks like we can't find "<i><?php echo $keyword ?>" anywhere!</i></h3>
                            <?php
                            endif;
                            ?>
                        </div>
<!--                        <div id = "topic-list" class = "list-group">
                            <?php
                            if (!empty($users)):
                                foreach ($users as $user):
                                    ?>
                                    <a class = "list-group-item btn btn-link list-entry" href = "user/profile/<?php echo $user->user_id; ?>">
                                        <img class = "img-circle" width = "45px" height = "45px" src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url('images/default.jpg') ?>"/>
                                        <h4 class = "text-info no-padding no-margin" style = "display: inline-block;"><?php echo $user->first_name . " " . $user->last_name ?></h4>
                                    </a>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <h3 class = "text-warning">No roomies were found for <i><?php echo $keyword ?></i></h3>
                            <?php
                            endif;
                            ?>
                        </div>-->
                    </div>

                    <!-- TOPICS -->
<!--                    <div id="topic-search" class="tab-pane fade">
                        <div id = "topic-list" class = "list-group">
                            <?php
                            if (!empty($topics)):
                                foreach ($topics as $topic):
                                    ?>
                                    <a class = "list-group-item btn btn-link list-entry" href = "topic/view/<?php echo $topic->topic_id; ?>">
                                        <h4 class = "text-info no-padding no-margin" style = "display: inline-block;"><?php echo utf8_decode($topic->topic_name); ?></h4>
                                        <small><i>by <?php echo $topic->user->first_name . " " . $topic->user->last_name; ?></i></small>
                                        <div class = "pull-right">
                                            <span class = "label label-info follower-label"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0'; ?></span>
                                        </div>
                                    </a>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <h3 class = "text-warning">No topics were found for <i><?php echo $keyword ?></i></h3>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <?php
  //  include(APPPATH . 'views/chat/chat.php');
    
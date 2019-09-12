<?php
include(APPPATH . 'third_party/fusioncharts.php');
?>

<!-- User Record Modal -->
<div id = "record-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-heading text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"style = "display: inline-block;">Record of <?php echo $user->first_name . " " . $user->last_name ?></h4>
            </div>
            <div class="modal-body text-center">
                <div class = "row">
                    <img src = "<?php echo $user->profile_url ? base_url($user->profile_url) : base_url("images/default.jpg"); ?>" class = "img-circle" width = "100px" height = "100px" />
                    <h5 class = "text-info no-margin"><strong><?php echo $user->first_name . " " . $user->last_name ?></strong></h5>
                    <p class = "text-muted"><i><?php echo $user->email; ?></i></p>
                    <div class = "col-sm-12">
                        <ul class = "nav nav-tabs nav-justified">
                            <li class = "active"><a href = "#topic-record" data-toggle = "tab">Topics</a></li>
                            <li><a href = "#post-record" data-toggle = "tab">Posts and Replies</a></li>
                            <li><a href = "#vote-record" data-toggle = "tab">Votes</a></li>
                        </ul>
                    </div>
                    <div class = "col-sm-12">
                        <div class="tab-content">
                            <!--TOPICS TAB-->
                            <div id="topic-record" class="tab-pane fade in active record-tab">
                                <div class = "col-sm-4">
                                    <h2 class = "text-info"><strong><?php echo $record->topic_count ?></strong></h2>
                                    <p>Topics Created</p>
                                </div>
                                <div class = "col-sm-4">
                                    <h2 class = "text-info"><strong><?php echo $record->followed_topic_count ?></strong></h2>
                                    <p>Topics Followed</p>
                                </div>
                                <div class = "col-sm-4">
                                    <h2 class = "text-info"><strong><?php echo $record->moderated_topic_count ?></strong></h2>
                                    <p>Topics Moderated</p>
                                </div>
                            </div>

                            <!--POSTS TAB-->
                            <div id="post-record" class="tab-pane fade record-tab">
                                <ul class = "nav nav-pills nav-justified">
                                    <li class = "active"><a href = "#post-statistics" data-toggle = "pill">Statistical Data</a></li>
                                    <li><a href = "#post-thread" data-toggle = "pill">Post Threads</a></li>
                                    <li><a href = "#post-topic" data-toggle = "pill">Posts Published</a></li>
                                    <li><a href = "#post-reply" data-toggle = "pill">Replies</a></li>
                                </ul>

                                <div class = "tab-content">
                                    <!--POSTS STATISTICS-->
                                    <div id = "post-statistics" class = "tab-pane fade in active">
                                        <div class = "col-sm-6">
                                            <h2 class = "text-info"><strong><?php echo $record->post_count ?></strong></h2>
                                            <p>Posts Published</p>
                                        </div>
                                        <div class = "col-sm-6">
                                            <h2 class = "text-info"><strong><?php echo $record->reply_count ?></strong></h2>
                                            <p>Replies Made</p>
                                        </div>
                                    </div>

                                    <!--POSTS GRAPHS-->

                                    <!--THREAD GRAPH-->
                                    <div id = "post-thread" class = "tab-pane fade">
                                        <?php
                                        $start_string = "";
                                        foreach ($record->post_start as $start):
                                            $start_string .= '{ "label":"' . utf8_decode($start->topic_name) . '",'
                                                    . '"value":"' . $start->post_count . '"},';
                                        endforeach;
                                        $threadChart = new FusionCharts("column2d", "threadChart", "80%", 300, "thread-chart", "json", '{  
                "chart":{  
                  "caption":"Post Threads Started by ' . $user->first_name . '",
                  "subCaption":"Top topics posted in by ' . $user->first_name . '",
                  "theme":"fint",
                  "baseFont":"Muli"
                }, "data":[' . $start_string . ']}');

                                        $threadChart->render();
                                        ?>
                                        <div id="thread-chart"></div>
                                    </div>

                                    <!--POSTS PUBLISHED-->
                                    <div id = "post-topic" class = "tab-pane fade">
                                        <?php
                                        $publish_string = "";
                                        foreach ($record->post_published as $publish):
                                            $publish_string .= '{ "label":"' . utf8_decode($publish->topic_name) . '",'
                                                    . '"value":"' . $publish->post_count . '"},';
                                        endforeach;
                                        $postTopicChart = new FusionCharts("column2d", "postTopicChart", "80%", 300, "post-topic-chart", "json", '{  
                "chart":{  
                  "caption":"Posts in Topics Published by ' . $user->first_name . '",
                  "subCaption":"Top topics posted in by ' . $user->first_name . '",
                  "theme":"fint",
                  "baseFont":"Muli"
                }, "data":[' . $publish_string . ']}');
                                        $postTopicChart->render();
                                        ?>
                                        <div id="post-topic-chart"></div>
                                    </div>

                                    <!--REPLIES MADE-->
                                    <div id = "post-reply" class = "tab-pane fade">
                                        <?php
                                        $reply_string = "";
                                        foreach ($record->replies as $reply):
                                            $reply_string .= '{ "label":"' . $reply->first_name . " " . $reply->last_name . '",'
                                                    . '"value":"' . $reply->reply_count . '"},';
                                        endforeach;
                                        $postReplyChart = new FusionCharts("column2d", "postReplyChart", "80%", 300, "post-reply-chart", "json", '{  
                "chart":{  
                  "caption":"Replies Made by ' . $user->first_name . '",
                  "subCaption":"Top users replied to by ' . $user->first_name . '",
                  "theme":"fint",
                  "baseFont":"Muli"
                }, "data":[' . $reply_string . ']}');
                                        $postReplyChart->render();
                                        ?>
                                        <div id="post-reply-chart"></div>
                                    </div>
                                </div>
                            </div>

                            <!--VOTES TAB-->
                            <div id="vote-record" class="tab-pane fade record-tab">
                                <ul class = "nav nav-pills nav-justified">
                                    <li class = "active"><a href = "#vote-statistics" data-toggle = "pill">Statistical Data</a></li>
                                    <li><a href = "#upvote-users" data-toggle = "pill">Upvotes</a></li>
                                    <li><a href = "#downvote-users" data-toggle = "pill">Downvotes</a></li>
                                </ul>

                                <div class = "tab-content">
                                    <div id = "vote-statistics" class = "tab-pane fade in active">
                                        <div class = "col-sm-4">
                                            <h2 class = "text-info"><strong><?php echo $record->upvote_count ?></strong></h2>
                                            <p>Upvotes Given</p>
                                        </div>
                                        <div class = "col-sm-4">
                                            <h2 class = "text-info"><strong><?php echo $record->downvote_count ?></strong></h2>
                                            <p>Downvotes Given</p>
                                        </div>
                                        <div class = "col-sm-4">
                                            <h2 class = "text-info"><strong><?php echo $record->points ?></strong></h2>
                                            <p>Vote Points</p>
                                        </div>
                                    </div>
                                    <div id = "upvote-users" class = "tab-pane fade">
                                        <?php
                                        $upvote_string = "";
                                        foreach ($record->upvotes as $upvote):
                                            $upvote_string .= '{ "label":"' . $upvote->first_name . " " . $upvote->last_name . '",'
                                                    . '"value":"' . $upvote->vote_count . '"},';
                                        endforeach;
                                        $upvote_string = rtrim($upvote_string, ",");
                                        $upvoteChart = new FusionCharts("column2d", "upvoteChart", "80%", 300, "upvote-chart", "json", '{  
                "chart":{  
                  "caption":"Upvotes Given by ' . $user->first_name . '",
                  "subCaption":"Top users given an upvote by ' . $user->first_name . '",
                  "theme":"fint",
                  "baseFont":"Muli"
                }, "data":[' . $upvote_string . ']}');
                                        $upvoteChart->render();
                                        ?>
                                        <div id="upvote-chart"></div>
                                    </div>
                                    <div id = "downvote-users" class = "tab-pane fade">
                                        <?php
                                        $downvote_string = "";
                                        foreach ($record->downvotes as $downvote):
                                            $downvote_string .= '{ "label":"' . $downvote->first_name . " " . $downvote->last_name . '",'
                                                    . '"value":"' . $downvote->vote_count . '"},';
                                        endforeach;
                                        $downvote_string = rtrim($downvote_string, ",");
                                        $downvoteChart = new FusionCharts("column2d", "downvoteChart", "80%", 300, "downvote-chart", "json", '{  
                "chart":{  
                  "caption":"Downvotes Given by ' . $user->first_name . '",
                  "subCaption":"Top users given a downvote by ' . $user->first_name . '",
                  "theme":"fint",
                  "baseFont":"Muli"
                }, "data":[' . $downvote_string . ']}');
                                        $downvoteChart->render();
                                        ?>
                                        <div id="downvote-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
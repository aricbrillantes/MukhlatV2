<?php
$logged_user = $_SESSION['logged_user'];
?>
    
<!-- Sidebar -->
<div class="col-md-3" style = "padding-left: 0px; margin-right:1%;margin-left: 3.5%;width:22.5%">
    <div class = "col-xs-12 home-sidebar content-container" style="border-radius:20px;">
        <!--Header-->
        <div class = "clearfix content-container" style="border-radius:20px;cursor: pointer;position: relative" id = "side-topics-followed-btn"  onclick="tpsidebar()">
            <!--<i class="fa fa-chevron-down pull-right" style="display: inline;position: relative;top:40%;cursor: pointer;"></i>-->
                        <a class="text1color" href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>">
                            <img style="cursor:pointer;" class = "pull-left img-rounded btn btn-link home-prof-pic topictop" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>">
                        </a>
                        <div class = "col-sm-4 home-user-text">
                            <a class = "btn btn-link home-username text1color" href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><strong style="cursor:pointer;"><?php echo $logged_user->first_name . " " . $logged_user->last_name;?></strong></a>
<!--                            <i class = "fa fa-caret-right header-arrow"></i> 
                            <div class="home-dropdown dropdown">
                                <button class="btn btn-link dropdown-toggle home-username text1color" type="button" data-toggle="dropdown"><strong>Home</strong>
                                    <i class="caret"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="home">Home</a></li>
                                    <li><a href="topic">Topic</a></li>
                                </ul>
                            </div>-->
                        </div>
 </div>
<!--        <div id = "side-topics-followed">
        <h3 class = "text-center text-info no-padding no-margin text1color" style = "margin-bottom: 10px;"><strong>Topic Shortcuts</strong></h3>
        <a id = "side-topics-created-btn" class = "btn btn-sm btn-block no-padding sidebar-header-btn buttonsbgcolor">
            <h4 class="ptopcolor textoutliner" style="border-radius: 2px;color: white">Your topics</h4>
        </a>
        <div class = "sidebar-topic-div">
            <ul class="nav">
                <?php
                if(!empty($logged_user->topics)):
                foreach ($logged_user->topics as $topic):
                ?>
                <li onmouseenter="playclip()">
                    <a href="topic/view/<?php echo $topic->topic_id; ?>">
                        <span class = "text-muted" style="cursor:pointer;"><?php echo utf8_decode($topic->topic_name); ?></span>
                        <span class = "pull-right label label-info" style="cursor:pointer;"><i class = "fa fa-group" style="cursor:pointer;"></i> <?php echo $topic->followers ? count($topic->followers) : '0'; ?></span>
                    </a>
                </li>
                <?php
                endforeach;
                else:
                ?>
                <li><h5 class = "text-center text-warning">No Topics here!</h5></li>
                <?php endif; ?>
            </ul>
        </div>



        <a id = "side-topics-followed-btn" class = "btn btn-block no-padding sidebar-header-btn buttonsbgcolor">
        <h4 class="ptopcolor textoutliner" style="border-radius: 2px;color: white">Topics you Follow</h4>
        </a>
        <div class = "sidebar-topic-div">
            <ul class="nav">
                <?php
                if(!empty($logged_user->followed_topics)):
                foreach ($logged_user->followed_topics as $topic):
                ?>
                <li onmouseenter="playclip()">
                    <a href="topic/view/<?php echo $topic->topic_id; ?>">
                        <span class = "text-muted"><?php echo utf8_decode($topic->topic_name); ?></span>
                        <span class = "pull-right label label-info"><i class = "fa fa-group"></i> <?php echo $topic->followers ? count($topic->followers) : '0'; ?></span>
                    </a>
                </li>
                <?php
                endforeach;
                else:
                ?>
                <li><h5 class = "text-center text-warning">No Topics here!</h5></li>
                <?php endif; ?>
            </ul>
        </div>
        </div>-->
        <!--random trivia-->
        <div id="randtriv1" class="draggable">
        <?php
        $servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "mukhlat";
	$conn = @new mysqli($servername, $username, $password, $dbname);
        
        $count = rand(1, 4);
        $sql = "SELECT Tquestion, Tanswer, Tcategory FROM tbl_trivias WHERE TriviaID = '$count'";
	$result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        echo '<div class="whitebg1"> '.$row['Tcategory'].' Trivia</div><br>';
        echo '<div class="whitebg">Q: '.$row['Tquestion'].'</div><br>';
        echo '<div class="whitebg">A: '.$row['Tanswer'].'</div>';
        $conn->close();
        }?>
        <img class = "pinwheel1" src = "<?php echo base_url('images/Picture1.png'); ?>"/></div>
        <div style="position: relative;bottom:100px;left: 100px;">Hello! You found me.</div>
        <center> <a href="https://kids.nationalgeographic.com/">Click here to learn more!</a></center>
    
    </div>
</div>

<!-- SCRIPTS -->
<!--topic sidebar collapsed or expanded script-->
<script>
function tpsidebar(){
    if($("#side-topics-followed").is(":visible"))
        document.cookie='tpsidebar=0;path=/;';
    else
        document.cookie='tpsidebar=1;path=/;';
}

</script>
<script>var $draggable = $('.draggable').draggabilly();</script>
<script type="text/javascript" src="<?php echo base_url("/js/side_bar.js"); ?>"></script>
<!-- END SCRIPTS -->
<!-- End Sidebar -->
<?php
include(APPPATH . 'views/header.php');
?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
//    include(APPPATH . 'views/topic_side_bar.php');
    ?>

    <style>
        
        .topic-grid1{
   
        margin:1.5%;
        position:relative;
        float:left;
        width:30%;
        padding:10px;
        text-decoration:none;
        height:200px;
        border-radius: 10px;   
    }

        
    </style>
    
    <!-- CODE HERE -->
<!--    <div class="well well-sm">
        <strong>Display</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>-->


    <div class = "container page">
        <div class = "row">
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 home-container">
                <div class = "col-md-12 home-container">
                    <!-- HEADER -->
                    <div class = "clearfix content-container" style="border-radius:20px;">
<!--                        <a class="text1color" href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>">
                            <img class = "pull-left img-rounded btn btn-link home-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>">
                        </a>-->

<!--                        <div class = "col-sm-4 home-user-text">
                            <a href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>" class = "btn btn-link home-username text1color"><strong><?php echo $logged_user->first_name; ?></strong></a>
                            <i class = "fa fa-caret-right header-arrow"></i> 
                            <div class="home-dropdown dropdown">
                                <button class="btn btn-link dropdown-toggle home-username text1color" type="button" data-toggle="dropdown"><strong>Topic</strong>
                                    <i class="caret"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="home">Home</a></li>
                                    <li><a href="topic">Topic</a></li>
                                </ul>
                            </div>
                        </div>-->
<center>    
    <?php $flag=0; foreach ($logged_user->topics as $topic): $flag++; endforeach;?>
                                    
            <?php if($flag>0):?>
            <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" data-toggle = "modal" style="margin:1%; width:20%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> My Room</a>
            <?php else:?>
            <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="#create-topic-modal" data-toggle = "modal" style="margin:1%; width:20%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> My Room</a>
            <?php endif;?>
</center>
                    </div>
                </div>

                <div class = "col-md-12 content-container" style="border-radius:20px;display:none">
                    <form action = "javascript:void(0);" role="search">
                        <div class="input-group" style = "width: 100%">
                            <input type="text" class="form-control search-text" placeholder="&#xF002; Search for a topic" id = "search-topic-list">
                        </div>
                    </form>
                </div>

                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 content-container" style="border-radius:20px;">
<!--                    <div id = "sort-dropdown" class = "dropdown text-muted" style="font-size: 22px">
                        Sort Topics by: <br>
                        <button id = "chosen-sort" class="btn btn-gray dropdown-toggle" type="button" data-toggle="dropdown"><strong style="font-size: 20px"><i class = "fa fa-clock-o"></i> Date Created</strong>
                            <i class="caret"></i></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-value = "1"><i class = "fa fa-clock-o"></i> Date Created</a></li>
                            <li><a href="#" data-value = "2"><i class = "fa fa-group"></i> Follower Count</a></li>
                            <li><a href="#" data-value = "3"><i class = "fa fa-comments"></i> Post Count</a></li>
                        </ul>
                    </div>-->

                    <div id = "topic-list" class = "list-group">
                        
                                <?php 
                                    foreach ($topics as $topic): 
                                        $wallpaper="";
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
                                        endif;
                                    ?>  
                        
                                   <div>
                                       <a class="<?php echo $theme?> elements-resizer"  href = "<?php echo base_url('topic/view/' . $topic->topic_id); ?>" style="<?php echo $wallpaper?>">
                                            <h4 class = "text-info no-padding text1color topicheader clicker" style="margin-top:50px;margin-left: 13px"><?php echo utf8_decode($topic->topic_name); ?></h4><br>
                                        </a>
                                   </div>
                                   <?php endforeach; ?>

                               </div>
                </div>
            </div>
            <?php
//            include(APPPATH . 'views/side_navbar.php');
            include(APPPATH . 'views/modals/create_topic_modal.php');
            ?>
        </div>
    </div>
    <!--back to top and go to bottom script-->
        <script>
window.addEventListener('load', function (){
    scrollFunction();
});
window.onscroll = function() {scrollFunction();};

function scrollFunction() 
{
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
    {
        document.getElementById("topbut").style.display = "block";
        // document.getElementById('topbut').className = 'balloon'; 
    } 

    else 
    {
        document.getElementById("topbut").style.display = "none";
        // document.getElementById('topbut').className = '';
    }

    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) 
    {
        document.getElementById("botbut").style.display = "none";
    }

    else 
    {
        document.getElementById("botbut").style.display = "block";
    }
}
            
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                var whistleup = new Audio('<?php echo base_url('images/Slide Whistle up1.mp3'); ?>');
                window.scroll({
                  top: 0,
                  behavior: 'smooth' 
                });
                whistleup.play();
            }
            function botFunction() {                
                var fallrock = new Audio('<?php echo base_url('images/Slide Whistle Down.mp3'); ?>');
                window.scroll({
                  top: 100000000,
                  behavior: 'smooth' 
                });
                fallrock.play();
            }
        </script>
        
        <style>
            .downarrow{
                width:120px;
              height:120px;
              position: fixed;
              top: 100px;
              right: 50px;
            }
            .downarrow:hover{
                cursor:pointer;
            }

            .downanimation{
                transition: 2s ease;
            }

            .downanimation:hover{
            transform: rotate(1080deg);
            }

            .uparrow{
              width:120px;
              height:120px;
              position: fixed;
              top: 600px;
              right: 50px;
            }
            .uparrow:hover{
                cursor:pointer;
            }

            .upanimation{
                transition: 2s ease;
            }

            .upanimation:hover{
            transform: rotate(1080deg);
            }

        </style>

        <script type="text/javascript" src="<?php echo base_url("/js/search.js"); ?>"></script>
        <!--back to top and go to bottom buttons-->
        <!-- <div onclick="topFunction()" id="topbut" style="text-align:center;"><img class="" src = "<?php echo base_url('images/up_arrow.png'); ?>"/><p style="padding-top:50%;cursor:pointer;">Up!</p></div> -->
        <div onclick="botFunction()" id="botbut"><img class="downarrow downanimation" src = "<?php echo base_url('images/down_arrow.png'); ?>"/><p class="centeredbot"></p></div>
        <div style="display:none" onclick="topFunction()" id="topbut"><img class="uparrow upanimation" src = "<?php echo base_url('images/up_arrow.png'); ?>"/><p class=""></p></div>
        <!--
        <span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture1.png'); ?>"/></span><span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture5.png'); ?>"/></span>
        <span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture2.png'); ?>"/></span><span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture6.png'); ?>"/></span>
        <span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture3.png'); ?>"/></span><span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture7.png'); ?>"/></span>
        <span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture4.png'); ?>"/></span><span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture8.png'); ?>"/></span>
-->   

    
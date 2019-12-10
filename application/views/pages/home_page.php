
<?php
    include(APPPATH . 'views/header.php');
    $CI =&get_instance();
    $CI->load->model('attachment_model');
?>

<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
//    include(APPPATH . 'views/topic_side_bar.php');
    $logged_user = $_SESSION['logged_user'];

    ?>
<!--    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>-->
    <div class = "container page">
        <div class = "row">
            <div class = "col-md-12 home-container">
                <div class = "col-sm-12 home-container">
                    <!-- HEADER -->
<!--                    <div class = "clearfix content-container" style="border-radius:20px;"><center>
                            
                        <h1>How are you feeling today?</h1>
                        <input class="hide23" type="checkbox" title="Happy" name="happy" id="happy">
                        <label for="happy" class="labelers1 option-happy">Happy</label>
  
                        <input class="hide23" type="checkbox" title="Sad" name="sad" id="sad">
                        <label for="sad" class="labelers1 option-sad">Sad</label>
  
                        <input class="hide23" type="checkbox" title="Meh" name="meh" id="meh">
                        <label for="meh" class="labelers1 option-meh">Meh</label>
                        
                        </center></div>-->
                    
                    <div class = "clearfix content-container" style="border-radius:20px;">
                    <center>    <?php $flag=0; foreach ($logged_user->topics as $topic): $flag++; endforeach;?>
                                    
                                <?php if($flag>0):?>
                                <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="<?php echo base_url('topic/view/' . $topic->topic_id); ?>" data-toggle = "modal" style="margin:1%; width:20%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> My Room</a>
                                <?php else:?>
                                <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="#create-topic-modal" data-toggle = "modal" style="margin:1%; width:20%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> My Room</a>
                                <?php endif;?>
                                
                                <a onmouseenter="playclip()" id="crettop" class="btn btn-primary buttonsbgcolor textoutliner" href="<?php echo base_url('topic') ?>" style="margin:1%; width:20%"><img  src = "<?php echo base_url('icons/topics.png'); ?>" style="width:15%;height:auto;cursor: pointer"/> My Roomies</a>                   
                                <!--<a id="crettop" class="btn btn-primary buttonsbgcolor" href="#create-post-modal" data-toggle = "modal">Post to your wall</a>-->
                    </center>
                    </div>
<!--                    <div class = "clearfix content-container" style="border-radius:20px;">

                        <a class="text1color" href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>">
                            <img class = "pull-left img-rounded btn btn-link home-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>">
                        </a>
                        <div class = "col-sm-4 home-user-text">
                            <a class = "btn btn-link home-username text1color" href = "<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><strong><?php echo $logged_user->first_name; ?></strong></a>
                            <i class = "fa fa-caret-right header-arrow"></i> 
                            <div class="home-dropdown dropdown">
                                <button class="btn btn-link dropdown-toggle home-username text1color" type="button" data-toggle="dropdown"><strong>Home</strong>
                                    <i class="caret"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="home">Home</a></li>
                                    <li><a href="topic">Topic</a></li>
                                </ul>
                            </div>
                        </div>
                        
-->                        
                        
<!--                        <a id="crettop" class ="btn btn-primary home-create-btn buttonsbgcolor" href="#create-topic-modal" data-toggle = "modal">Create Topic</a>
                        <input onclick='responsiveVoice.speak("shush rg");' type='button' id="sel" value='🔊 Play' />

                    </div>-->

                    <!-- CONTENT -->
                    <div id="UHposts" class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 content-container" style="border-radius:20px;">
                        
                            <!-- POST PREVIEW -->
                            <?php
                            if (!empty($posts)):
                                foreach ($posts as $post):
                                    // echo utf8_decode($post->creator_id);
                                    // print_r($posts);
                            ?>
                                    <!--<div class=" " style="position: relative;  height: auto;  min-height: 100% !important;">-->
                                     <?php if($post->theme==1): $theme="roomtheme-arrow";
                                        elseif($post->theme==2): $theme="roomtheme-zigzag";
                                        elseif($post->theme==3): $theme="roomtheme-scales";
                                        elseif($post->theme==4): $theme="roomtheme-halfrhombe";
                                        elseif($post->theme==5): $theme="roomtheme-marrakesh";
                                        elseif($post->theme==6): $theme="roomtheme-hearts";
                                        elseif($post->theme==7): $theme="roomtheme-stars";
                                        elseif($post->theme==8): $theme="roomtheme-seigaiha";
                                        elseif($post->theme==9): $theme="roomtheme-bricks";
                                        elseif($post->theme==10): $theme="roomtheme-diacheckerboard";
                                        elseif($post->theme==11): $theme="roomtheme-tablecloth";
                                        elseif($post->theme==12): $theme="roomtheme-brady";
                                        elseif($post->theme==13): $theme="roomtheme-argyle";
                                        elseif($post->theme==14): $theme="roomtheme-shippo";
                                        elseif($post->theme==15): $theme="roomtheme-waves";
                                        elseif($post->theme==16): $theme="roomtheme-polkadot";
                                        elseif($post->theme==17): $theme="roomtheme-honeycomb";
                                        elseif($post->theme==18): $theme="roomtheme-chocolateweave";
                                        elseif($post->theme==19): $theme="roomtheme-crosseddot";
                                        else: $theme="";
                                        endif;?>

                                    <div class=" polaroid homepostsborder elements-resizer col-xs-12 col-sm-12 <?php echo $theme?>" >
                                     
                                        <div class="whitebg">
                                        <img class = "img-circle" style = "margin: 10px 0px;" width = "40px" height = "40px" src = "<?php echo $post->profile_url ? base_url($post->profile_url) : base_url('images/default.jpg'); ?>"/> 
                                        
                                        <?php if($post->user_id === $logged_user->user_id): ?>
                                            <a class = "text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                <strong style = "font-size: 21px">You</strong>
                                            </a> 
                                            <p style="font-size: 24px; display:inline"> decorated </p>
                                            <a style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; display:inline " class = "" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">your room! </a>

                                        <?php elseif($post->creator_id === $post->user_id): ?>
                                            <a class = "text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                <strong style = "font-size: 21px"><?php echo $post->first_name;?></strong>
                                            </a>
                                            <p style="font-size: 24px; display:inline"> decorated </p> 
                                            <a style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; display:inline " class = "" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">their room! </a>

                                        <?php else: ?>
                                            <p style="font-size: 19px; display:inline">In </p>

                                            <?php if($post->topic_id === $logged_user->user_id):?>
                                                <a style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; display:inline " class = "" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>"> your room, </a>

                                            <?php else:?>
                                                <a style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; display:inline " class = "" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>"> <?php echo utf8_decode($post->topic_name); ?>, </a>
                                            
                                            <?php endif;?>
                                            <a class = "text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                <strong style = "font-size: 21px"><?php echo $post->first_name;?></strong>
                                            </a>
                                            <p style="font-size: 24px; display:inline"> says:</p>
                                        
                                        <?php endif; ?>
                                        
                                        <!-- <h4 class = "text-info no-padding no-margin text1color topicheader"><?php echo utf8_decode($topic->topic_name); ?></h4><br> -->
                                        <!-- <small class="topicheader2"><i>by <?php echo $topic->user->first_name . " " . $topic->user->last_name; ?></i></small> -->

                                        <!-- <p style="font-size: 24px; display:inline"><?php echo $post->first_name . " " . $post->last_name ?> says:</p> -->
                                            <br>
                                        
                                        <span class = "text-muted"> <i style = "font-size: 18px;padding-left: 15px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span>
                                            <!-- <a class = "text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                                <p style="color: white"></p>
                                            </a> -->
                                        <hr>
                                        <div class="polaroidwrapper">
                                        <p class = "whitebg" style = ""><?php echo utf8_decode($post->post_content); ?></p>
                                        
                                        <?php $attachments = $CI->attachment_model->get_post_attachments($post->post_id);?>
                                        
                                                <?php //print_r($attachments); ?>

                                                <?php foreach ($attachments as $attachment):
                                                    if ($attachment->attachment_type_id === '1'):?>
                                                        <img src = "<?= base_url($attachment->file_url); ?>" width = "75%"  style="position:relative; width:auto; max-height: 200px; max-width: 300px;" />
                                                        

                                                    <?php elseif ($attachment->attachment_type_id === '2'): ?>
                                                        <audio src = "<?= base_url($attachment->file_url); ?>" style="width: 100%" controls></audio>
                                                        

                                                    <?php elseif ($attachment->attachment_type_id === '3'): ?>
                                                        <video src = "<?= base_url($attachment->file_url); ?>" width = "100%" style="height: 100%; width:auto; max-height: 220px;" controls/></video>
                                                    

                                                    <?php elseif ($attachment->attachment_type_id === '4'): ?>
                                                        <a href = "<?= base_url($attachment->file_url); ?>" download><i class = "fa fa-file-o"></i> <i class = "text" style = "font-size: 12px;"><?= utf8_decode($attachment->caption); ?></i></a>
                                                    
                                                <?php endif; ?>
                                        
                                                    
                                                <?php endforeach;

                                                ?>
                                        </div></div></div>

                                    <?php
                                endforeach;
                            //else:
                                ?>
                            <!-- <h4 class = "text-center text-warning">Your home page looks empty. Try following or creating more topics!</h4> -->
                                <?php endif; ?>
                        </div>

                    </div>
                </div>
                <!--<span> <img class = "pinwheel" src = "<?php echo base_url('images/Picture1.png'); ?>"/></span>-->
            </div>

            <?php
//            include(APPPATH . 'views/side_navbar.php');
            
//            include(APPPATH . 'views/modals/create_post_modal.php');
            include(APPPATH . 'views/modals/create_topic_modal.php');
            ?>
        </div>
    </div>
    <!--back to top and go to bottom script-->
    <?php if(!$mobile): ?>

    <script>
        window.addEventListener('load', function (){
            scrollFunction();
        });

        window.onscroll = function() {scrollFunction();};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("topbut").style.display = "block";
                document.getElementById('topbut').className = 'balloon';
            } else {
                document.getElementById("topbut").style.display = "none";
                document.getElementById('topbut').className = '';
            }
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                document.getElementById("botbut").style.display = "none";
            }
            else {
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
                var fallrock = new Audio('<?php echo base_url('images/falling rocks.mp3'); ?>');
                window.scroll({
                  top: 100000000,
                  behavior: 'smooth' 
                });
                fallrock.play();
            }
        </script>

        <script type="text/javascript" src="<?php echo base_url("/js/search.js"); ?>"></script>
        <!--back to top and go to bottom buttons-->

        
            <div onclick="topFunction()" id="topbut" style="text-align:center;"><p style="padding-top:50%;cursor:pointer;">Up!</p></div>
            <div onclick="botFunction()" id="botbut"><img class="rock1 goingdown" src = "<?php echo base_url('images/rock bottom.png'); ?>"/><p class="centeredbot">Bottom!</p></div>

    <?php endif;?>

    <script type="text/javascript" src="<?php echo base_url("/js/post.js"); ?>"></script>

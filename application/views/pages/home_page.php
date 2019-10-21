
<?php
include(APPPATH . 'views/header.php');
?>

<body>
    <?php
    include(APPPATH . 'views/navigation_bar.php');
    include(APPPATH . 'views/topic_side_bar.php');
    $logged_user = $_SESSION['logged_user'];

    ?>
<!--    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>-->
    <div class = "container page">
        <div class = "row">
            <div class = "col-md-9 home-container">
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
                    <center>
                                <a onmouseenter="playclip()" id="crettop" class ="btn btn-primary buttonsbgcolor textoutliner" href="#create-topic-modal" data-toggle = "modal" style="margin:1%"><img  src = "<?php echo base_url('icons/pencil.png'); ?>" style="width:10%;height:auto;cursor: pointer"/> My Room</a>
                                <a onmouseenter="playclip()" id="crettop" class="btn btn-primary buttonsbgcolor textoutliner" href="<?php echo base_url('topic') ?>" style="margin:1%"><img  src = "<?php echo base_url('icons/topics.png'); ?>" style="width:15%;height:auto;cursor: pointer"/> My Roomies</a>                   
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
                    <div class = "col-sm-12 content-container" style="border-radius:20px;">
                        
                            <!-- POST PREVIEW -->
                            <?php
                            if (!empty($posts)):
                                foreach ($posts as $post):
                                    ?>
                                    <div class = "col-xs-12 no-padding post-container ptopcolor" style = "margin-bottom: 20px;border-radius:20px;">
<!--                                        <div class = "whitebg2 no-margin " style="border-radius:20px;">
                                            <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                
                                                    <img class = "img-circle" style = "margin: 10px 0px;" width = "65px" height = "65px" src = "<?php echo $post->profile_url ? base_url($post->profile_url) : base_url('images/default.jpg'); ?>"/>
                                               
                                                <strong><?php echo $post->first_name . " " . $post->last_name; ?></strong>
                                            </a> 
                                            <span>talked in</span> <span class = "text-muted pull-right"> <i style = "font-size: 16px"><?php echo date("F d, Y", strtotime($post->date_created)); ?></i></span>
                                            <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                                <strong ><?php echo utf8_decode($post->topic_name); ?></strong>
                                            </a><h4 style="display:inline"></h4><br>
                                            <p class = "home-content-body whitebg2" style = "border-right: none;white-space: pre-wrap;max-width: 714px;"><?php echo utf8_decode($post->topic_description); ?><br></p>
                                                <button class = "btn btn-primary pull-right" id="text2speak" style = "margin-right: 3px;border-radius: 20px;" onclick="readcontent('<?php $stringy = utf8_decode($post->topic_description); $stringy1 = str_replace('\'', '`', $stringy); echo trim(preg_replace('/[^A-Za-z0-9()#,%\/?@$*.:+=_~`-]/', ' ', $stringy1)); ?>')"><i class="glyphicon glyphicon-volume-up" style="padding-top: 5px;"></i></button>
                                                &emsp;&emsp;&emsp;&emsp;&emsp;<br><br>
                                        </div>-->

                                        <div class = "col-xs-12 whitebg2 no-padding">
                                            <!-- Left -->
                                            <div class = "col-xs-1 text-center no-padding" style = "padding-left: 10px;">
                                                <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                    <img class = "img-circle" style = "margin: 10px 0px;" width = "65px" height = "65px" src = "<?php echo $post->profile_url ? base_url($post->profile_url) : base_url('images/default.jpg'); ?>"/>
                                                </a><br>
                                                  
                                                
<!--                                                <button class = "downvote-btn btn btn-link btn-xs" value = "<?php echo $post->post_id; ?>">
                                                    <span class = "<?php echo $post->vote_type === '-1' ? 'downvote-text' : '' ?> fa fa-chevron-down vote-text"></span>
                                                </button>-->
                                            </div>

                                            <!-- Right -->
                                            <div class = "col-xs-11" style = "margin-top: 7px;margin-bottom: 10px;">
                                                <i class = "text-muted" style="display:inline">                            
                                                    
                                                        <a class = "btn btn-link btn-xs no-padding text1color" href = "<?php echo base_url('user/profile/' . $post->user_id); ?>">
                                                            <?php echo $post->first_name . " " . $post->last_name ?>
                                                        </a>
                                                    <span>talked in</span>
                                                    <a class = "btn btn-link no-padding text1color" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">
                                                    <strong ><?php echo utf8_decode($post->topic_name); ?></strong>
                                                    </a>
                                                    
                                                      
                                                </i><br>
                                                <span class = "text-muted"> <i style = "font-size: 16px"><?php echo date("F d, Y", strtotime($post->date_posted)); ?></i></span><br>
                                                <div class="ptopcolor" style="padding-bottom:15px !important;">
                                                    <!--<h4 class = "no-padding no-margin text-muted wrap whitebg2" style="display:inline-block"><strong><?php echo utf8_decode($post->post_title); ?></strong></h4>-->
                                                <p class = "home-content-body whitebg2" style = "border-right: none;white-space: pre-wrap;max-width: 714px;"><?php echo utf8_decode($post->post_content); ?></p>
                                                
                                                <span class="whitebg2" style="padding-right: 30px !important;">
                                                <button class = "upvote-btn btn btn-link btn-xs" style = "margin-left: 3px;" value = "<?php echo $post->post_id; ?>">
                                                    <span class = "<?php echo $post->vote_type === '1' ? 'upvote-text' : '' ?> glyphicon glyphicon-star vote-text starroll"></span>
                                                </button>
                                                <span class = "vote-count text-muted" style = "margin-left: 3px;"><?php echo $post->vote_count ? $post->vote_count : '0'; ?></span>
                                                <button class = "btn btn-primary pull-right" id="text2speak" style = "margin-right: 3px;border-radius: 20px;" onclick="readcontent('<?php $stringy = utf8_decode($post->post_content); $stringy1 = str_replace('\'', '`', $stringy); echo trim(preg_replace('/[^A-Za-z0-9()#,%\/?@$*.:+=_~`-]/', ' ', $stringy1)); ?>')"><i class="glyphicon glyphicon-volume-up" style="padding-top: 5px;"></i></button>
                                                </span>
                                                
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class = "user-post-footer no-margin text-right" style="border-radius:20px;">
                                            
                                            <a class = "btn btn-user-post-footer no-up-down-pad" href = "<?php echo base_url('topic/view/' . $post->topic_id); ?>">Visit Room<i class = "fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            else:
                                ?>
                            <h4 class = "text-center text-warning">Your home page looks empty. Try following or creating more topics!</h4>
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

    <script type="text/javascript" src="<?php echo base_url("/js/post.js"); ?>"></script>
    

    <?php
//    include(APPPATH . 'views/chat/chat.php');

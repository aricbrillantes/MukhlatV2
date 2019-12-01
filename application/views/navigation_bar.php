<?php

    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
            exit(0);
        }

        $CI =&get_instance();
        $CI->load->model('user_model');
        $CI->load->library('user_agent');

        $mobile=$CI->agent->is_mobile();


        $usertimes = $CI->user_model->get_usertimes($logged_user->user_id);
        // print_r($usertimes->row()->time_setting);

        $restrictions1 = explode(" ",$usertimes->row()->time_setting);
        $restrictions2 = [];
        // print_r($restrictions);

        $sessionLimit = $usertimes->row()->use_limit;

        include(APPPATH . 'views/scripts/restrictions.php');

        // print_r($restrictions2);

        date_default_timezone_set('Asia/Manila');
        $currentTime = date("G").date("i")." ".date("l");

        $currentTimeSlot;

        if( (int)date("i")>=00 && (int)date("i")<=30)
            $currentTimeSlot = date("G")."00"." ".date("l");

        else if( (int)date("i")>=30)
            $currentTimeSlot = date("G")."30"." ".date("l");

        if(in_array($currentTimeSlot,$restrictions2))
        {
            // print("<br>" . $currentTimeSlot);
        }    

        else
        {
            // print("you cant use xd ");
            $restrict = base_url('restrict');
            // header("Location: $restrict");
        }            
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    // include(APPPATH . 'views/header.php');
    include(APPPATH . 'views/modals/birthday_modal.php'); 
    include(APPPATH . 'views/modals/afk_warning_modal.php'); 
?>
<p id="afktimer" style="float: right; display:none;">Time Left: 9999<p>

<!-- scale to device resolution -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" /> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Nav Bar -->

<script type="text/javascript">
    
    /*  
        function to check how many minutes until the child cannot use
        this function reads a PHP array of "timeslots"
        (10:30-11:00 is a timeslot)

        EXAMPLE:
        if the actual current time is 2:15
        and the child can only use until 2:30,

        the "CURRENT timeslot" will be 2:00-2:30
        and the "NEXT timeslot" will be 2:30-3:00

        the function repeatedly checks the current time and once
        it sees that the child cannot use during the current timeslot,
        it will redirect to the restriction page

    */

    var canUseNext = 1;
    var canUse = 1;

    function checkRestriction()
    {
        
        
        //get current time
        var today = new Date();
        var hour, min, day;
        var curTime, curHour, curMinute;

        //for checking time 30 minutes after
        var nextTime, nextHour, nextMinute;

        //convert day to word format
        switch(today.getDay())
        {
            case 0:day="Sunday";break;
            case 1:day="Monday";break;
            case 2:day="Tuesday";break;
            case 3:day="Wednesday";break;
            case 4:day="Thursday";break;
            case 5:day="Friday";break;
            case 6:day="Saturday";break;
        }
        

        //formatting "current timeslot" and "next timeslot"
        if(today.getMinutes()>=0 && today.getMinutes()<=30)
        {
            curHour=today.getHours();
            curMinute=0;

            nextHour=today.getHours();
            nextMinute=30;

            if(curHour==0)
            {
                curTime = "00" + curMinute + " " + day;
                nextTime = "0030 "+day;
            }

            else
            {
                curTime = curHour + "00 " + day;
                nextTime = nextHour+""+nextMinute+" "+day;
            }
        }    

        else if(today.getMinutes()>=30)
        {
            curHour=today.getHours();
            curMinute=30;

            if(curHour==23)
            {
                nextHour=0;
                nextMinute=60;

                switch((today.getDay())+1)
                {
                    case 0:day="Sunday";break;
                    case 1:day="Monday";break;
                    case 2:day="Tuesday";break;
                    case 3:day="Wednesday";break;
                    case 4:day="Thursday";break;
                    case 5:day="Friday";break;
                    case 6:day="Saturday";break;
                }

                curTime = curHour + "" + curMinute + " " + day;
                nextTime = "0000 "+day;
            }

            else
            {
                nextHour=today.getHours()+1;
                nextMinute=60;

                curTime = curHour + "" + curMinute + " " + day;
                nextTime = nextHour+"00 "+day;
            }

        }    

        // alert(curTime);
        // alert(nextTime);


        // get actual current time
        var time = today.getHours() + "" + today.getMinutes() + " " + day;

        // get available times from PHP array that parents set
        var restrictions =  <?php echo json_encode($restrictions2); ?>;
        

        // checks if child cannot use for the current timeslot
        if(!(restrictions.includes(curTime)))
            canUse=0;

        // checks if child cannot use for the next timeslot
        if(!(restrictions.includes(nextTime)))
            canUseNext=0;


        // if child cannot use for the current timeslot
        // redirect to restriction page
        if(canUse==0)
        {
            // alert("You can't use Mukhlat right now!");

            // location.href="<?php echo base_url('restrict');?>"; //uncomment this line for actual testing
        }
        
        // if child cannot use for the next timeslot
        if(canUseNext==0)
        {
            // alert("You have " + (nextMinute-today.getMinutes()) + " minutes left to use Mukhlat!");


            // add the falling numbers function call here
        }    
        
        // repeat function to check every 30 seconds
        setTimeout(checkRestriction, 30000); //seconds x 1000

    }

    checkRestriction();


    function getCookie(cname) 
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) 
        {
            var c = ca[i];
            while (c.charAt(0) === ' ') 
            {
                c = c.substring(1);
            }

            if (c.indexOf(name) === 0) 
            {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    

/*------------------------- AFK Timer Script -------------------------*/
    
    document.cookie = "afk=0;" + ";path=/"; 
    var start = document.getElementById("start");
    var dis = document.getElementById("afktimer");
    var finishTime;
    var timerLength = 600; // 600 seconds or 10 minutes
    var timeoutID;
    dis.innerHTML = "Time Left: " + timerLength;
    
    addEventListener("mousemove", function() {
    
        //reset timer and hide AFK popup
        StartTimer();
//         $('#afkpopup').modal('hide'); 
    });
// $('#afkpopup').modal('show'); 
    document.onscroll = function()
    { 
        StartTimer();
    };
    
    StartTimer();
    
    function StartTimer() 
    {
        localStorage.setItem('myTime', ((new Date()).getTime() + timerLength * 1000));

        if (timeoutID !== undefined) 
            window.clearTimeout(timeoutID);

            Update();
    }

    function Update() 
    {
        finishTime = localStorage.getItem('myTime');
        var timeLeft = (finishTime - new Date());
        dis.innerHTML = "Time Left: " + Math.max(timeLeft/1000,0);
        timeoutID = window.setTimeout(Update, 100);

        if(timeLeft<=120*1000) //display AFK popup after 2 minutes
        {
            // $('#afkpopup').modal('show'); 
        }
        
        if(timeLeft<=10*1000) // logout user if AFK
        {
            document.cookie = "afk=1;" + ";path=/"; 
            location.href="<?php echo base_url('afk');?>";
        }
    }

    var currentDate = new Date();
    var curMonth = currentDate.getMonth()+1;
    var curDay = currentDate.getDate();

    var birthDate = new Date('<?php echo $logged_user->birthdate; ?>');
    var birthMonth = birthDate.getMonth()+1;
    var birthDay = birthDate.getDate(); 
   
    if(birthMonth===curMonth && birthDay===curDay)
    {
        if(!getCookie("birthday") && getCookie("birthday")!==1)
        {
            document.cookie = "birthday=1;" + ";path=/"; 
            $('#birthdaypopup').modal('show');
        }    
    }
    
    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    var randomColor2 = Math.floor(Math.random()*16777215).toString(16);
    var randomColor3 = Math.floor(Math.random()*16777215).toString(16);
    var randomColor4 = Math.floor(Math.random()*16777215).toString(16);
    
    if(getCookie("activaterain")==='1')
    {  
        document.cookie = "NavbarColor=#" + randomColor + ";" + ";path=/"; 
        document.cookie = "ButtonColor=#" + randomColor4 + ";" + ";path=/"; 
        document.cookie = "ButtonHColor=#" + randomColor2 + ";" + ";path=/";
        document.cookie = "ButtonAColor=#" + randomColor3 + ";" + ";path=/";
    }
    
    if(getCookie("ButtonColor")==='')
    {
        document.cookie = "ButtonColor=#1d8f15;" + ";path=/"; 
        document.cookie = "ButtonHColor=#14620f;" + ";path=/"; 
        document.cookie = "ButtonAColor=#185729;" + ";path=/"; 
    }

//    changing custom themes, pointers, effects based on the users choices
    document.write('<style type="text/css">.navbar-font {background:' + getCookie("NavbarColor") + ';}\n\
                    #randtriv1{background: #'+ randomColor2 +';}\n\
                    .soundbg {display:' + getCookie("soundbg1") + ';}\n\
                     body {background' + getCookie("backgroundColor") + ';background-repeat: no-repeat;background-attachment: fixed;font-family:' + getCookie("Fonty") + '}\n\
                    .buttonsbgcolor {background:' + getCookie("ButtonColor") + ';}\n\
                    .buttonsbgcolor:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .text1color{color:' + getCookie("ButtonColor") + ';}\n\
                    .bar1color{background:' + getCookie("ButtonColor") + ';}\n\
                    .text1color:hover{color:' + getCookie("ButtonHColor") + ';}\n\
                    .buttonsbgcolor:focus{background:' + getCookie("ButtonColor") + ';outline:0;}\n\
                    .buttonsbgcolor:active{background:' + getCookie("ButtonAColor")  + '!important;}\n\
                    .modalbg{background:' + getCookie("NavbarColor") + ';}\n\
                    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover { background: ' + getCookie("NavbarColor") + ';}\n\
                    .snowflakebg{display:' + getCookie("snowflakebg1") + '!important;}\n\
                    .sparklesbg{display:' + getCookie("sparklebg1") + ';}\n\
                    .fireworkbg{display:' + getCookie("fireworkbg1") + ';}\n\
                    .navbaricons:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .navbarprofileicon:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .bubblesbg{display:' + getCookie("bubblesbg1") + ';}\n\
                    .navbaricons .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .camerapic .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .playpop .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .audiorec .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .navbarprofileicon .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .search-btn .tooltiptext1{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    #logom .bubbletooltip{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .trail{background:' + getCookie("ButtonAColor") + '!important;}\n\
                    body::-webkit-scrollbar-thumb{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    body ::selection{background:' + getCookie("ButtonHColor") + ';}\n\
                    body{cursor:url(' + getCookie("MousePointer") + '),auto;}\n\
                    :hover{cursor:url(' + getCookie("MousePointer") + '),auto;}\n\
                    .modal-header{background:' + getCookie("NavbarColor") + ';}\n\
                    .charLimitMessage{background:' + getCookie("ButtonHColor") + ';}\n\
                    .topic-grid1{background-color: #'+ randomColor +';}\n\
                    .homepostsborder{border-color:' + getCookie("ButtonColor") + ';}\n\
                    .mystuffpreview{border-color:' + getCookie("ButtonColor") + ';}\n\
                    #backgroundcloud-wrap{display:' + getCookie("cloudbg1") + '!important;}\n\
                    .rainbowwrapper{display:' + getCookie("rainbowbg1") + '!important;}\n\
                    .ptopcolor{background:' + getCookie("ButtonColor") + ';}<\/style>');
    
    if(getCookie("MouseTrail")==='1')
            document.write('<style type="text/css">.trail{display:block;}<\/style>');
        
    if(getCookie("bubblesbg1")==='block')
        document.write('<style type="text/css"> #logom .bubbletooltip{visibility:visible;}<\/style>');
        
   else
        document.write('<style type="text/css"> #logom .bubbletooltip{visibility:hidden;}<\/style>');
        
    if(getCookie("randomcolors")==='1')
    {
        document.write('<style type="text/css">\n\
                    #randtriv1{background: #'+ randomColor2 +';}\n\
                .topic-grid1{background-color: #'+ randomColor +';}<\/style>');
    }
    
    else
    {
        document.write('<style type="text/css">\n\
                    #randtriv1{background:'+ getCookie("ButtonColor") +';}\n\
                    .topic-grid1{background-color:'+ getCookie("ButtonColor") +';}<\/style>');
    }    

    if(getCookie("sparklebg1")==="block")
    {
        document.write('<canvas id="world" class="sparklesbg"></canvas>'); 
    }

    if(getCookie("fireworkbg1")==="block")
    {
        document.write('<canvas id="firework" class="fireworkbg"></canvas>'); 
    }
    
    if(getCookie("dance")==='1')
    {
        document.write('<style type="text/css">\n\
                        .btn{animation: dance 3s infinite;}\n\
                        .navbaricons{animation: dance 3s infinite;}\n\
                        .navbarprofileicon{animation: dance 3s infinite;}\n\
                        #logout-btn{animation: dance 3s infinite;}\n\
                        button{animation: dance 3s infinite;}\n\
                        a{animation: dance 3s infinite;}\n\
                        <\/style>');
    }
       

    //night mode script
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    //different logo on nightmode
    if(hours >= 18 || hours < 6)
    {
        document.write('<style type="text/css">\n\
        #nav-logo{display:none}\n\
        #home2{display:none}\n\
        <\/style>');
    }
    
    else
    {
        document.write('<style type="text/css">\n\
            #nav-logo2{display:none}\n\
            #bed2{display:none}<\/style>');
    }

    //force logout by 8pm to 6am
    //        if(hours >= 20 || hours < 6)
    //        {
    //            location.href="http://localhost/MukhlatV2Beta/signin/logout";
    //        }
    //Warning before 8pm's force logout
    // if(hours === 19 && getCookie("warned")==='0')
    // {
    //     $('#timeoutpopup').modal({backdrop: 'static', keyboard: false});
    //     document.cookie = "warned=1;path=/"; 
        
    // }
       
</script>
<!--<script type="text/javascript" src="https://panzi.github.io/Browser-Ponies/basecfg.js" id="browser-ponies-config"></script>
<script type="text/javascript" src="https://panzi.github.io/Browser-Ponies/browserponies.js" id="browser-ponies-script"></script>-->
<!--<script type="text/javascript">/* <![CDATA[ */ (function (cfg) {BrowserPonies.setBaseUrl(cfg.baseurl);BrowserPonies.loadConfig(BrowserPoniesBaseConfig);BrowserPonies.loadConfig(cfg);})({"baseurl":"https://panzi.github.io/Browser-Ponies/","fadeDuration":500,"volume":1,"fps":25,"speed":3,"audioEnabled":false,"showFps":false,"showLoadProgress":true,"speakProbability":0.1,"spawn":{"winona":1},"autostart":true}); /* ]]> */</script>-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo base_url('sound-mouseover/sound-mouseover.js'); ?>"></script>
    
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('clippy.js-master/build/clippy.css'); ?>" media="all">-->
    <style>
        svg{
        display: block;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: fixed;
        }

        path{
        stroke-linecap: square;
        stroke: white;
        stroke-width: 0.5px;
        }        

    </style>
<!--        <style>/*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/

	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}


        
/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}
</style>--> 

<!--falling time-->
<!--<canvas id="screen"></canvas>-->    
    
<!--rainbow changing background-->
<div class="rainbowwrapper" style="display:none"></div>

<!--moving clouds effect-->
<div id="backgroundcloud-wrap" style="display:none;">
    <div class="x1">
        <div class="cloud"></div>
    </div>

    <div class="x2">
        <div class="cloud"></div>
    </div>

    <div class="x3">
        <div class="cloud"></div>
    </div>

    <div class="x4">
        <div class="cloud"></div>
    </div>

    <div class="x5">
        <div class="cloud"></div>
    </div>
</div>

    <!--snowflakes falling effect-->
<div class="snowflakebg" style="display: none;">       
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
    </div>
</div>    

</head>
    
    
    <!--<script src="/intl/en/chrome/assets/common/js/chrome.min.js"></script>-->     
    
<!--Voice Search Script-->
<script type="text/javascript" src="<?php echo base_url('js/voicesearch.js'); ?>"> </script>

<!--draggability script-->
<script src="<?php echo base_url('draggabilly-master/dist/draggabilly.pkgd.min.js'); ?>"></script>

<!-- Nav Bar -->

<!-- SCM Music Player http://scmplayer.co -->
<!--    <script type="text/javascript" src="<?php echo base_url('scm-music-player-github/script.js'); ?>" 
    data-config="{'skin':'skins/simpleBlack/skin.css','volume':50,'autoplay':false,'shuffle':false,'repeat':0,'placement':'bottom','showplaylist':false,'playlist':[{'title':'Dora The Explorer Theme Song.','url':'<?php echo base_url('assets/music/Dora The Explorer Theme Song.mp3'); ?>'},{'title':'Flight of the Bumble-Bee','url':'<?php echo base_url('assets/music/Flight of the Bumble-Bee.mp3'); ?>'},{'title':'Inhuman Reactions','url':'<?php echo base_url('assets/music/INHUMAN REACTIONS.mp3'); ?>'}]}" >
    </script>-->
    <!-- SCM Music Player script end -->

    <!--night mode-->
<div id="overlay"></div>

<!--bubbles effect-->
<div class="bubblesbg">
<div class="bubble-container">
   <div class="bubble bubble1">
      <div class="bubble-border"></div>
      <div class="bubble-pop">*pop*</div>
   </div>
</div>
<div class="bubble bubble2 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble3 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble4 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble5"><div class="bubble-border"></div><div class="bubble-pop">*ouch*</div></div>
<div class="bubble bubble6"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble7"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble8"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble9"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
</div>

<!--voice command easter egg-->
<div id ="peek" style="display:none;"><img src = "<?php echo base_url('images/green m cat.png'); ?>"/></div>

<!--frequency bar effect-->
    <div class="soundbg" style="float:left;">
        <svg preserveAspectRatio="none" id="visualizer" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <mask id="mask">
                    <g id="maskGroup">
                  </g>
                </mask>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#ff0a0a;stop-opacity:1" />
                    <stop offset="20%" style="stop-color:#f1ff0a;stop-opacity:1" />
                    <stop offset="90%" style="stop-color:#d923b9;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#050d61;stop-opacity:1" />
                </linearGradient>
            </defs>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#gradient)" mask="url(#mask)"></rect>
        </svg>
        <h1></h1>
    </div>

	 
<!--	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
				</div>

				<div class="modal-body">
					
				</div>

			</div> 
		</div> 
	</div>  -->

    <nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "box-shadow: 0px 1px 2px #ccc;">
        <div class = "container-fluid"  style="margin:0.5%;">
            <div class = "navbar-header" style = "margin-left: 50px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a onmouseenter="playclip()" id ="logom" class = "draggable navbar-brand" href = "<?php echo base_url('home') ?>"><img style="cursor: pointer" id = "nav-logo" src = "<?php echo base_url('images/logo/mukhlatlogo on the sideb.png'); ?>"/><img style="cursor: pointer" id = "nav-logo2" src = "<?php echo base_url('images/logo/bed mukhlat.png'); ?>"/><span class="bubbletooltip" id="bubblegame"style="">Score: </span></a>
<!--            <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			Right Sidebar Modal
		</button>-->

            <span id="results" border="1px">
                <span id="final_span3" class="final"></span>
                <span id="interim_span3" class="interim"></span>
            </span>

            </div>
            <div class = "collapse navbar-collapse" id = "nav-collapse">
                <div class = "nav-left-end">
                    <form action = "<?php echo base_url('search'); ?>" class="navbar-left" role = "search" method = "GET" style="width:30%; margin-top:0.555%; margin-left:1%; margin-right:4%;">
                        <span class="input-group">
                            <div class="input-group-btn" style="display: inline-block;">
                                <input required type="text" name = "search-key" class="form-control" placeholder="" id="search" style="width: 400px; font-size: 22px">
                                <!-- <span class="btn btn-default search-btn tooltip1" onclick="voiceDropdown()" id="voice-search-button" style="cursor: pointer"><i class = "fa fa-microphone buttonsgo"style="font-size:16px;cursor: pointer"></i><span class="tooltiptext1" style="width:180px;">Search by voice</span></span> -->
                                <button class="btn btn-default search-btn tooltip1" type="submit" style="width:40px;height:35px">
<!--                                    <i class="glyphicon glyphicon-search buttonsgo" style="cursor: pointer"></i>--> <img  src = "<?php echo base_url('icons/search.png'); ?>" class="buttonsgo" style="width:150%;height:auto;cursor: pointer"/><span class="tooltiptext1" style="width:150px;">Start looking</span>
                                </button> 
                                
                            </div>
                            
                            <!--Hidden DIV for voice search-->
                            <span id="results" border="1px" style="display:none;">
                                <span id="final_span" class="final"></span>
                                <span id="interim_span" class="interim"></span>
                            </span>
                            <span id="results" border="1px">
                                <span id="final_span3" class="final"></span>
                                <span id="interim_span3" class="interim"></span>
                            </span>
                        </span>
                            
                        
                    </form>
                </div>
        <!--voice search-->
            <div id="voicedropdown" class="voice-dropdown-content navbarvoice" style="display:none;">
                                <div class="compact marquee" id="div_language" style="display: inline-block;font-size: 22px">
                                    <select id="select_language">
                                        <option value="0" onclick="resetDictation(event)">English</option>
                                        <option value="1" onclick="resetDictation(event)">Filipino</option>
                                        <option value="2" onclick="resetDictation(event)">French</option>
                                        <option value="3" onclick="resetDictation(event)">Korean</option>
                                        <option value="4" onclick="resetDictation(event)">Italian</option>
                                        <option value="5" onclick="resetDictation(event)">Spanish</option>
                                        <option value="6" onclick="resetDictation(event)">Japanese</option>
                                    </select>
                                </div>                         
                                <div style="display: inline-block;">
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="startDictation(event);" style="color:white;background:green;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-microphone"></i><span class="tooltiptext1">Start</span></a>

                                    <span id="snackbar">Speak to type is on now</span>
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="stopDictation(event)" style="color:white;background: red;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-microphone-slash"></i><span class="tooltiptext1" style="background:red;">Stop</span></a>
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="resetDictation(event);" style="color:black;background:yellow;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-refresh"></i><span class="tooltiptext1" style="background:yellow;color:black">Reset</span></a>
                                   <!--<a href="#" class="voicesearch" id="voicesearch" onclick='responsiveVoice.speak(search.value,"UK English Male",{rate: 0.9, pitch: 1});' >PLAY</a>-->
                                </div>
                            </div>
                            <div class="navbaricons2">
                                <a onclick="window.speechSynthesis.cancel();" onmouseenter="playclip()" id="logout-btn" href="#logout-modal" data-toggle = "modal" class="navbaricons" href="<?php echo base_url('signin/logout'); ?>" style="margin-right:4%;"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/logout.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Bye!></p>
                                <span class="tooltiptext">Goodbye Mukhlat!</span></a>

                                <!-- <a onclick="window.speechSynthesis.cancel();" onmouseenter="playclip()" id="logout-btn" class="navbaricons" href="<?php echo base_url('signin/logout'); ?>" style="margin-right:4%;"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/logout.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Bye!></p>
                                <span class="tooltiptext">Goodbye Mukhlat!</span></a> -->

                            <a onmouseenter="playclip()" class="navbaricons" href="#customize-theme" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/paintbrush.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Style></p>
                                <span class="tooltiptext">Change what you see!</span>
                            </a>
                            
                                    

                            <a onmouseenter="playclip()" class="navbaricons" href="#view-notes-modal" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/parentnotes.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Style></p>
                                <span class="tooltiptext">Guardian's Notes</span>
                            </a>

                            <a onmouseenter="playclip()" class="navbaricons" href="#view-announcements-modal" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/whiteboard.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Style></p>
                                <span class="tooltiptext" style="width:140px">Announcements</span>
                            </a>
                            
<!--                            <a onmouseenter="playclip()" class="navbaricons" id = "notif-btn" href="#notif-modal" data-toggle = "modal" <?php echo (int) $logged_user->unread_notifs > 0 ? "data-value = \"" . $logged_user->unread_notifs . "\"" : "" ?>>
                                    <?php if ((int) $logged_user->unread_notifs > 0): ?>
                                    <span id = "notif-badge" class = "badge" style="float:right;background: red;"><?php echo $logged_user->unread_notifs ?></span>
                                    <?php endif; ?>    
                                    <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/notif.png'); ?>" class="iconin" style="width:100%;height:auto"/><!News>    </p>
                                <span class="tooltiptext">Check what's up!</span>  
                            </a>-->

                            <a onmouseenter="playclip()" class="navbaricons" id = "notif-btn" href="<?php echo base_url('chat') ?>" <?php echo (int) $logged_user->unread_notifs > 0 ? "data-value = \"" . $logged_user->unread_notifs . "\"" : "" ?>>
                                    <?php if ((int) $logged_user->unread_notifs > 0): ?>
                                    <span id = "notif-badge" class = "badge" style="float:right;background: red;"><?php echo $logged_user->unread_notifs ?></span>
                                    <?php endif; ?>    
                                    <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/chat.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Chat>    </p>
                                <span class="tooltiptext">Chit chat!</span>  
                            </a>

                            <div class="vl"  style="margin-right:0.3%;"></div>
 
                            <a onmouseenter="playclip()" class="navbaricons" href="<?php echo base_url('topic') ?>"><p class="iconin" style="font-size:14px !important;text-align: left !important;"> <img  src = "<?php echo base_url('icons/topics.png'); ?>" class="iconin" style="width:100%;height:auto;cursor: pointer"/><!Topics></p><span class="tooltiptext">Visit other rooms!</span></a>
                                <a onmouseenter="playclip()" class="navbaricons" href="<?php echo base_url('home') ?>"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/home.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Home></p><span class="tooltiptext">Go to the homepage</span></a>
                               
                                <a onmouseenter="playclip()" class="navbarprofileicon" href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>" >
                                <img class = "img-circle nav-prof-pic iconin" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/> 
                                <?php echo $logged_user->first_name; ?><span class="tooltiptext">Check your profile!</span></a>

                </div>
            </div>
        </div>
    </nav>
<!--<img class = "draggable mascoti" src = "<?php echo base_url('images/Picture1.png'); ?>"/><span class="mascotitalk">Hello</span>-->

<!--<img class = "draggable mascoti" src = "<?php echo base_url('images/Picture1.png'); ?>"/>-->
<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>
<!--voice search indicator script-->
<script>
function voiceIndicatorON() {
    var VInd = document.getElementById("snackbar");
    VInd.className = "show";
}

function voiceIndicatorOFF() {
    var VInd = document.getElementById("snackbar");
    VInd.className = "hide";
}

</script>

<!--voice commands script-->
<script type="text/javascript">
        var final_transcript3 = '';
        var recognizing3 = true;
        var meow = new Audio('<?php echo base_url('images/catmeow.mp3'); ?>');

        if ('webkitSpeechRecognition' in window) {

          var recognition3 = new webkitSpeechRecognition();
          recognition3.lang = 'en-US';
          recognition3.continuous = true;
          recognition3.interimResults = true;

          recognition3.onstart = function() {
            recognizing3 = true;
          };

          recognition3.onerror = function(event) {
            console.log(event.error);
          };

          recognition3.onend = function() {
            recognizing3 = false;
        };

       recognition3.onresult = function(event) {
                      
            var interim_transcript3 = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
              if (event.results[i].isFinal) {
                final_transcript3 += event.results[i][0].transcript;
              } else {
                interim_transcript3 += event.results[i][0].transcript;
              }
            }
            final_span3.innerHTML = linebreak(final_transcript3);
            interim_span3.innerHTML = linebreak(interim_transcript3);
                
                if(interim_span3.innerHTML.includes("birthday ko") || interim_span3.innerHTML.includes("happy birthday")){
                birthdayPopup();
            }

            if(interim_span3.innerHTML.includes("sawa na ako") || interim_span3.innerHTML.includes("time out")){
                forceTimeout();
            }

            if(interim_span3.innerHTML.includes("sawa na ako") || interim_span3.innerHTML.includes("remove blur")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("remove night mode")){
                document.write('<style type="text/css">#overlay{background-color: rgba(0,0,0,0);}<\/style>');
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("go to home")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("sa home po")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }


            if(interim_span3.innerHTML.includes("go to topics")){
                location.href="http://localhost/MukhlatV2Beta/topic";
            }

            if(interim_span3.innerHTML.includes("sa topics po")){
                location.href="http://localhost/MukhlatV2Beta/topic";
            }

            if(interim_span3.innerHTML.includes("go to profile")){
                location.href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>";
            }

            if(interim_span3.innerHTML.includes("sa profile po")){
                location.href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>";
            }
            
            if(interim_span3.innerHTML.includes("activate camera")){
                $('#camerapopup').modal('show');
            }
            
            if(interim_span3.innerHTML.includes("selfie")){
                takephoto();
                interim_span3.innerHTML = interim_span3.innerHTML.replace("selfie","");
            }

//                if(interim_span3.innerHTML.includes("di siya mahal")){
//                    location.href="https://www.facebook.com/rafael.tanchuan";
//                }

            if(interim_span3.innerHTML.includes("voice search")){
                var x = document.getElementById("voicedropdown");
                if (x.style.display === "none") {
                    x.style.display = "block";
                }
                startDictation(event);
            }

            if(interim_span3.innerHTML.includes("meow")){
               meow.play();
               catpeek();
            }


          };
        }

        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }

        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }

        function startDictation3(event) {
            recognition3.lang = 'fil-PH';
            final_transcript3 = '';
            final_span3.innerHTML = '';
            interim_span3.innerHTML = '';
            
            
            recognition3.start();
        }

        function stopDictation3(event) {
            recognition3.stop();
        }

        function resetDictation3(event) {
            recognition3.stop();
            recognition3.lang = 'fil-PH';
            final_transcript3 = '';
            final_span3.innerHTML = '';
            interim_span3.innerHTML = '';
        }
        
        var languages = new Array(
            'en-US',
            'fil-PH',
            'fr-FR',
            'ko-KR'
        );

        startDictation3(event);
        
        
    </script>
<!--<script src="<?php echo base_url('js/eastereggs.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('js/usagetimer.js'); ?>"></script>-->
<script>var $draggable = $('.draggable').draggabilly();</script>
<script src="<?php echo base_url('js/frequencybars.js'); ?>"></script>
<script src="<?php echo base_url('js/sparkles.js'); ?>"></script>
<!--<script src="<?php echo base_url('js/fireworks.js'); ?>"></script>-->

<!--bubble popping and popped bubbles counter script-->
<script>
    var bubpop = new Audio('<?php echo base_url('images/pop.mp3'); ?>');
    var bubbles = document.querySelectorAll('.bubble');
    var poppedClass = 'bubble--popped';
    var score = Number(getCookie("score"));
    
    document.getElementById("bubblegame").innerHTML='Bubbles Popped: ' + score;
    
    function scoreBubble() {
        score++;
        document.cookie = "score=" + score +";path=/"; 
        document.getElementById("bubblegame").innerHTML='Bubbles Popped: ' + score;
    }
    
    function popBubble(e, bubble) {
       bubble.style.top = e.clientY - e.offsetY + 'px';
       bubble.style.left = e.clientX - e.offsetX + 'px';
       bubble.style.pointerEvents="none";
       bubble.classList.add(poppedClass);
       scoreBubble();
       bubpop.play();
    }

    function resetBubble(bubble) {
       bubble.classList.remove(poppedClass);
       bubble.style.top = '';
       bubble.style.left = '';
       bubble.style.pointerEvents="auto";
    }

    bubbles.forEach(function(bubble) {
       bubble.addEventListener('click', function(e) {
          popBubble(e, this);
       });

       bubble.addEventListener('animationend', function() {
          resetBubble(this);
       });
    });
</script>
<!--<script>//
//var starlike = new Audio('<?php echo base_url('images/SPARKLE EFFECT1.mp3'); ?>');
//function starding(){
//    starlike.play();}
//</script>-->
<script src="<?php echo base_url('js/cursordots.js'); ?>"></script>
<!-- Add these scripts to  the bottom of the page -->
<!-- jQuery 1.7+ --> 
<!--<script src="jquery.1.7.min.js"></script>-->

<!-- Clippy.js -->
<!--<script src="<?php echo base_url('clippy.js-master/build/clippy.min.js'); ?>"></script>

 Init script 
<script type="text/javascript">
    clippy.load('Links', function(agent){
        // do anything with the loaded agent
        agent.show();
        agent.speak('My name is Links.');
    });  
    
</script>-->

<!--mouseover on a button audio-->
<audio>
<source src="<?php echo base_url('sound-mouseover/click.mp3'); ?>">
<source src="<?php echo base_url('sound-mouseover/click.ogg'); ?>">
</audio>
<div id="sounddiv"><bgsound id="sound"></div>

<!--highlighted text reader script-->
<script>
var synth = window.speechSynthesis;
var voices90 = synth.getVoices();

function getSelectionText() { //highlight desired text to read
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type !== "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}

document.addEventListener('keydown', function(e) {
  if (e.keyCode === 16) { //press shift to read higlighted text
    var msg = new SpeechSynthesisUtterance(getSelectionText());
    msg.voice = voices90[2];
    synth.speak(msg);
  }
  if(e.keyCode === 17){ //press ctrl to stop reading
     window.speechSynthesis.cancel();
  }
});

</script>

<!--read post content reader script-->
        <script>
function readcontent(value) { //piles the clicks
   
    var value2 = value.replace(/`/g, "'");
    var reader = new SpeechSynthesisUtterance(value2);
    window.speechSynthesis.speak(reader);
    
  }
  
function readcontent2(value) { //only talks when no more talking
    if(!(speechSynthesis.speaking)){
    var value2 = value.replace(/`/g, "'");
    var reader = new SpeechSynthesisUtterance(value2);
    window.speechSynthesis.speak(reader);
    }
    else{
        window.speechSynthesis.cancel();
    }
  }

</script>
<script>
    ! function ()
{
	"use strict";

	/* ==== screen setup ==== */

	var screen = {
		elem: document.getElementById("screen"),
		width: 0,
		height: 0,
		top: 0,
		left: 0,
		resize: function ()
		{
			var o = screen.elem;
			screen.width = o.offsetWidth;
			screen.height = o.offsetHeight;
			for (screen.left = 0, screen.top = 0; o != null; o = o.offsetParent)
			{
				screen.left += o.offsetLeft;
				screen.top += o.offsetTop;
			}
			screen.elem.width = screen.width;
			screen.elem.height = screen.height;
			if (PHY2D)
			{
				PHY2D.deleteStatic();
				PHY2D.rectangle(screen.width / 2, screen.height + 50, screen.width, 100, 0, 0);
				PHY2D.rectangle(screen.width / 2, -screen.height * 2, screen.width, 100, 0, 0);
				PHY2D.rectangle(-50, 0, 100, screen.height * 4, 0, 0);
				PHY2D.rectangle(screen.width + 50, 0, 100, screen.height * 4, 0, 0);
			}
		}
	}

	screen.elem.onselectstart = function ()
	{
		return false;
	}
	screen.elem.ondrag = function ()
	{
		return false;
	}
	var ctx = screen.elem.getContext("2d");
	window.addEventListener('resize', screen.resize, false);

	/* ==== pointer setup ==== */

	var pointer = {
		pos:
		{
			x: 0,
			y: 0
		},
		active: false,
		down: function (e, touch)
		{
			e.preventDefault();
			var p = touch ? e.touches[0] : e;
			(!touch && document.setCapture) && document.setCapture();
			this.pos.x = p.clientX - screen.left;
			this.pos.y = p.clientY - screen.top;
			this.active = true;
		},
		up: function (e, touch)
		{
			e.preventDefault();
			(!touch && document.releaseCapture) && document.releaseCapture();
			this.active = false;
		},
		move: function (e, touch)
		{
			e.preventDefault();
			var p = touch ? e.touches[0] : e;
			if (this.active)
			{
				this.pos.x = p.clientX - screen.left;
				this.pos.y = p.clientY - screen.top;
			}
		}
	}

	if ('ontouchstart' in window)
	{
		screen.elem.ontouchstart = function (e)
		{
			pointer.down(e, true);
		}.bind(pointer);
		screen.elem.ontouchmove = function (e)
		{
			pointer.move(e, true);
		}.bind(pointer);
		screen.elem.ontouchend = function (e)
		{
			pointer.up(e, true);
		}.bind(pointer);
		screen.elem.ontouchcancel = function (e)
		{
			pointer.up(e, true);
		}.bind(pointer);
	}
	document.addEventListener("mousedown", function (e)
	{
		pointer.down(e, false);
	}.bind(pointer), true);
	document.addEventListener("mousemove", function (e)
	{
		pointer.move(e, false);
	}.bind(pointer), true);
	document.addEventListener("mouseup", function (e)
	{
		pointer.up(e, false);
	}.bind(pointer), true);

	/* ==== vector 2D library ==== */

	function Vector(x, y)
	{
		this.x = x || 0.0;
		this.y = y || 0.0;
	}
	Vector.prototype = {
		set: function (x, y)
		{
			this.x = x;
			this.y = y;
			return this;
		},
		dot: function (v)
		{
			return this.x * v.x + this.y * v.y;
		},
		lenSqr: function ()
		{
			return this.x * this.x + this.y * this.y;
		},
		transform: function (v, m)
		{
			this.x = m.cos * v.x - m.sin * v.y + m.pos.x;
			this.y = m.sin * v.x + m.cos * v.y + m.pos.y;
			return this;
		},
		rotate: function (v, m)
		{
			this.x = m.cos * v.x - m.sin * v.y;
			this.y = m.sin * v.x + m.cos * v.y;
			return this;
		},
		normal: function (a, b)
		{
			var x = a.x - b.x,
				y = a.y - b.y,
				len = Math.sqrt(x * x + y * y);
			this.x = -y / len;
			this.y = x / len;
			return this;
		},
		project: function (a, b, n)
		{
			var x = a.x - b.x,
				y = a.y - b.y,
				len = Math.sqrt(x * x + y * y);
			return (-y / len) * n.x + (x / len) * n.y;
		},
		addScale: function (v1, v2, s)
		{
			this.x = v1.x + (v2.x * s);
			this.y = v1.y + (v2.y * s);
			return this;
		},
		subScale: function (v1, v2, s)
		{
			this.x = v1.x - (v2.x * s);
			this.y = v1.y - (v2.y * s);
			return this;
		},
		add: function (v1, v2)
		{
			this.x = v1.x + v2.x;
			this.y = v1.y + v2.y;
			return this;
		},
		sub: function (v1, v2)
		{
			this.x = v1.x - v2.x;
			this.y = v1.y - v2.y;
			return this;
		},
		scale: function (v1, s)
		{
			this.x = v1.x * s;
			this.y = v1.y * s;
			return this;
		},
		perp: function ()
		{
			var x = this.x;
			this.x = -this.y;
			this.y = x;
			return this;
		},
		inv: function (v1)
		{
			this.x = -v1.x;
			this.y = -v1.y;
			return this;
		},
		clamp: function (v, min, max)
		{
			if (v > max) v = max;
			else if (v < min) v = min;
			return v;
		},
		rotateIntoSpaceOf: function (a, m)
		{
			var dx = -a.x,
				dy = -a.y;
			this.x = dx * m.cos + dy * m.sin;
			this.y = dx * -m.sin + dy * m.cos;
			return this;
		},

		// SIMD Array vectors

		array: function (n, values)
		{
			var array = new Array(n);
			array.min = new Vector();
			array.max = new Vector();
			for (var i = 0; i < n; i++)
			{
				array[i] = new Vector(
					values ? values[i * 2 + 0] : 0.0,
					values ? values[i * 2 + 1] : 0.0
				);
			}
			array.transform = function (v, m)
			{
				for (var i = 0, len = this.length; i < len; i++)
				{
					var vi = v[i],
						elem = this[i];
					var x = m.cos * vi.x - m.sin * vi.y + m.pos.x;
					var y = m.sin * vi.x + m.cos * vi.y + m.pos.y;
					if (x < this.min.x) this.min.x = x;
					if (y < this.min.y) this.min.y = y;
					if (x > this.max.x) this.max.x = x;
					if (y > this.max.y) this.max.y = y;
					elem.x = x;
					elem.y = y;
				}
				return this;
			}
			array.rotate = function (v, m)
			{
				for (var i = 0, len = this.length; i < len; i++)
				{
					var vi = v[i],
						elem = this[i];
					elem.x = m.cos * vi.x - m.sin * vi.y;
					elem.y = m.sin * vi.x + m.cos * vi.y;
				}
				return this;
			}
			array.resetMinmax = function ()
			{
				this.min.x = 100000.0;
				this.min.y = 100000.0;
				this.max.x = -100000.0;
				this.max.y = -100000.0;
			}
			array.normal = function (points)
			{
				for (var i = 0; i < this.length; i++)
				{
					this[i].normal(
						points[(i + 1) % this.length],
						points[i]
					);
				}
				return this;
			}
			return array;
		}
	}

	/* ==== Matrix container ==== */

	function Matrix()
	{
		this.cos = 0.0;
		this.sin = 0.0;
		this.pos = new Vector();
		this.ang = 0.0;
	}

	Matrix.prototype = {
		set: function (a, x, y, w, h)
		{
			this.cos = Math.cos(a);
			this.sin = Math.sin(a);
			this.ang = a;
			this.pos.x = x;
			this.pos.y = y;
			this.w = w;
			this.h = h;
			return this;
		},
		copy: function (matrix)
		{
			this.cos = matrix.cos;
			this.sin = matrix.sin;
			this.ang = matrix.ang;
			this.pos.x = matrix.pos.x;
			this.pos.y = matrix.pos.y;
			return this;
		},
		integrate: function (va, vx, vy, kTimeStep)
		{
			this.pos.x += vx * kTimeStep;
			this.pos.y += vy * kTimeStep;
			this.ang += va * kTimeStep;
			this.cos = Math.cos(this.ang);
			this.sin = Math.sin(this.ang);
			return this;
		}
	}

	/* ==== PHY2D continuous collision engine ==== */

	var PHY2D = function (ctx, pointer, Vector, Matrix)
	{
		var kGravity = 5;
		var kTimeStep = 1 / 60;
		var kFriction = 0.5;
		var objects = [];
		var drag = false;
		var v0 = new Vector();
		var v1 = new Vector();
		var v2 = new Vector();
		var v3 = new Vector();
		var v4 = new Vector();
		var v5 = new Vector();

		// contacts list

		var contacts = [];
		contacts.index = 0;
		contacts.create = function (A, B, pa, pb, nx, ny)
		{
			if (!this[this.index]) this[this.index] = new Contact();
			this[this.index++].set(A, B, pa, pb, nx, ny);
		}

		// AABB container

		function AABB()
		{
			this.x = 0.0;
			this.y = 0.0;
			this.w = 0.0;
			this.h = 0.0;
		}

		// Polygon constructor

		function Polygon(x, y, w, h, vertices, invMass, angle, img)
		{
			this.img = img;
			this.vel = new Vector();
			this.angularVel = 0.0;
			this.invMass = invMass;
			this.matrix = new Matrix().set(angle, x, y, w, h);
			this.aabb = new AABB();
			this.drag = false;
			this.static = false;
			this.length = (vertices.length / 2) | 0;
			this.localSpacePoints = new Vector().array(this.length, vertices);
			this.localSpaceNormals = new Vector().array(this.length).normal(this.localSpacePoints);
			this.worldSpaceNormals = new Vector().array(this.length);
			this.worldSpacePoints = new Vector().array(this.length);
			this.invI = (invMass > 0) ? 1 / ((1 / invMass) * (w * w + h * h) / 3) : 0
			this.c1 = new Vector();
			this.c0 = new Vector();
			objects.push(this);
		}

		Polygon.prototype = {

			// calculate aabb & transform world space points

			motionAABB: function ()
			{
				this.worldSpacePoints.resetMinmax();
				this.worldSpacePoints.transform(this.localSpacePoints, this.matrix);
				this.worldSpaceNormals.rotate(this.localSpaceNormals, this.matrix);
				var min = this.worldSpacePoints.min;
				var max = this.worldSpacePoints.max;
				this.aabb.x = (min.x + max.x) * 0.5;
				this.aabb.y = (min.y + max.y) * 0.5;
				this.aabb.w = (max.x - min.x) * 0.5;
				this.aabb.h = (max.y - min.y) * 0.5;
			},

			// Poly vs poly collision detection (Minkowski Difference)

			contact: function (that)
			{
				var face, vertex, vertexRect, faceRect, fp, va, vb, vc, nx, ny, wsN, wdV0, wdV1, wsV0, wsV1;
				mostSeparated.set(100000, -1, -1, 0, 100000);
				mostPenetrating.set(-100000, -1, -1, 0, 100000);
				this.featurePairJudgement(that, 2);
				that.featurePairJudgement(this, 1);
				
				if (mostSeparated.dist > 0 && mostSeparated.fpc !== 0)
				{
					face = mostSeparated.edge;
					vertex = mostSeparated.closestI;
					fp = mostSeparated.fpc;
				}
				else if (mostPenetrating.dist <= 0)
				{
					face = mostPenetrating.edge;
					vertex = mostPenetrating.closestI;
					fp = mostPenetrating.fpc;
				}
				
				if (fp === 1) vertexRect = this, faceRect = that;
				else vertexRect = that, faceRect = this;
				
				wsN = faceRect.worldSpaceNormals[face];
				va = vertexRect.worldSpacePoints[(vertex - 1 + vertexRect.length) % vertexRect.length];
				vb = vertexRect.worldSpacePoints[vertex];
				vc = vertexRect.worldSpacePoints[(vertex + 1) % vertexRect.length];
				if (v0.project(vb, va, wsN) < v1.project(vc, vb, wsN))
				{
					wdV0 = va;
					wdV1 = vb;
				}
				else
				{
					wdV0 = vb;
					wdV1 = vc;
				}
				wsV0 = faceRect.worldSpacePoints[face];
				wsV1 = faceRect.worldSpacePoints[(face + 1) % faceRect.length];
				if (fp === 1)
				{
					this.projectPointOntoEdge(wsV0, wsV1, wdV0, wdV1);
					that.projectPointOntoEdge(wdV1, wdV0, wsV0, wsV1);
					nx = -wsN.x;
					ny = -wsN.y;
				}
				else
				{
					this.projectPointOntoEdge(wdV1, wdV0, wsV0, wsV1);
					that.projectPointOntoEdge(wsV0, wsV1, wdV0, wdV1);
					nx = wsN.x;
					ny = wsN.y;
				}
				contacts.create(this, that, this.c0, that.c0, nx, ny);
				contacts.create(this, that, this.c1, that.c1, nx, ny);
			},

			featurePairJudgement: function (that, fpc)
			{
				var wsN, closestI, closest, dist;
				for (var edge = 0; edge < this.length; edge++)
				{
					wsN = this.worldSpaceNormals[edge];
					v5.rotateIntoSpaceOf(wsN, that.matrix);
					var closestI = -1,
						closestD = -100000;

					for (var i = 0; i < that.length; i++)
					{
						var d = v5.dot(that.localSpacePoints[i]);
						if (d > closestD)
						{
							closestD = d;
							closestI = i;
						}
					}

					var closest = that.worldSpacePoints[closestI];
					v0.sub(closest, this.worldSpacePoints[edge]);
					var dist = v0.dot(wsN);

					if (dist > 0)
					{
						v1.sub(closest, this.worldSpacePoints[(edge + 1) % this.length]);
						dist = this.projectPointOntoEdgeZero(v0, v1).lenSqr();

						if (dist < mostSeparated.dist)
						{
							mostSeparated.set(dist, closestI, edge, fpc);
						}
					}
					else
					{
						if (dist > mostPenetrating.dist)
						{
							mostPenetrating.set(dist, closestI, edge, fpc);
						}
					}
				}
			},

			projectPointOntoEdge: function (p0, p1, e0, e1)
			{
				var l = v2.sub(e1, e0).lenSqr() + 0.0000001;
				this.c0.addScale(e0, v2, v3.clamp(v3.sub(p0, e0).dot(v2) / l, 0, 1));
				this.c1.addScale(e0, v2, v3.clamp(v3.sub(p1, e0).dot(v2) / l, 0, 1));
			},

			projectPointOntoEdgeZero: function (e0, e1)
			{
				var l = v2.sub(e1, e0).lenSqr() + 0.0000001;
				return this.c0.addScale(e0, v2, v3.clamp(v3.inv(e0).dot(v2) / l, 0, 1));
			},

			// integrate

			integrate: function ()
			{
				if (this.drag)
				{
					this.vel.x += (pointer.pos.x - this.matrix.pos.x);
					this.vel.y += (pointer.pos.y - this.matrix.pos.y);
				}
				else
				{
					if (this.invMass > 0) this.vel.y += kGravity;
				}

				this.matrix.integrate(this.angularVel, this.vel.x, this.vel.y, kTimeStep);

				if (!this.static) this.motionAABB();
				else
				{
					if (this.invMass === 0)
					{
						this.static = true;
						this.motionAABB();
					}
				}
			},

			// draw image

			draw: function ()
			{
				if (this.img)
				{
					var m = this.matrix;
					ctx.save();
					ctx.translate(m.pos.x, m.pos.y);
					ctx.rotate(m.ang);
					ctx.drawImage(this.img, -m.w * 0.5, -m.h * 0.5, m.w, m.h);
					ctx.restore();

					if (pointer.active)
					{
						if (!drag && this.invMass)
						{
							ctx.beginPath();
							for (var j = 0; j < this.length; j++)
							{
								var a = this.worldSpacePoints[j];
								ctx.lineTo(a.x, a.y);
							}
							ctx.closePath();
							if (ctx.isPointInPath(pointer.pos.x, pointer.pos.y))
							{
								this.drag = true;
								drag = true;
							}
						}
					}
					else
					{
						if (drag)
						{
							for (var i = 0; i < objects.length; i++) objects[i].drag = false;
							drag = false;
						}
					}
				}
			}
		}

		// Feature pair container

		function FeaturePair()
		{
			this.dist = 0;
			this.closestI = 0;
			this.edge = 0;
			this.fpc = 0;
		}

		FeaturePair.prototype.set = function (dist, closestI, edge, fpc)
		{
			this.dist = dist;
			this.closestI = closestI;
			this.edge = edge;
			this.fpc = fpc;
		}

		var mostSeparated = new FeaturePair();
		var mostPenetrating = new FeaturePair();

		// Contacts Constructor

		function Contact()
		{
			this.a = null;
			this.b = null;
			this.normal = new Vector();
			this.normalPerp = new Vector();
			this.ra = new Vector();
			this.rb = new Vector();
			this.dist = 0;
			this.impulseN = 0;
			this.impulseT = 0;
			this.invDenom = 0;
			this.invDenomTan = 0;
		}

		Contact.prototype = {

			// set new contact

			set: function (A, B, pa, pb, nx, ny)
			{
				var ran, rbn;
				this.a = A;
				this.b = B;
				this.normal.set(nx, ny);
				this.normalPerp.set(-ny, nx);
				this.dist = v1.sub(pb, pa).dot(this.normal);
				this.impulseN = 0;
				this.impulseT = 0;
				this.ra.sub(pa, A.matrix.pos).perp();
				this.rb.sub(pb, B.matrix.pos).perp();
				ran = this.ra.dot(this.normal);
				rbn = this.rb.dot(this.normal);
				this.invDenom = 1 / (A.invMass + B.invMass + (ran * ran * A.invI) + (rbn * rbn * B.invI));
				ran = this.ra.dot(this.normalPerp);
				rbn = this.rb.dot(this.normalPerp);
				this.invDenomTan = 1 / (A.invMass + B.invMass + (ran * ran * A.invI) + (rbn * rbn * B.invI));
			},

			applyImpulse: function (imp)
			{
				// linear
				this.a.vel.addScale(this.a.vel, imp, this.a.invMass);
				this.b.vel.subScale(this.b.vel, imp, this.b.invMass);

				// angular
				this.a.angularVel += imp.dot(this.ra) * this.a.invI;
				this.b.angularVel -= imp.dot(this.rb) * this.b.invI;
			},

			// solve contacts

			solve: function ()
			{
				var newImpulse, absMag, dv = v1;

				// relative velocities
				dv.sub(
					v2.addScale(this.b.vel, this.rb, this.b.angularVel),
					v3.addScale(this.a.vel, this.ra, this.a.angularVel)
				);

				// new impulse
				newImpulse = (dv.dot(this.normal) + this.dist / kTimeStep) * this.invDenom + this.impulseN;
				if (newImpulse > 0) newImpulse = 0;
				this.applyImpulse(v2.scale(this.normal, newImpulse - this.impulseN));
				this.impulseN = newImpulse;

				// friction impulse
				absMag = Math.abs(this.impulseN) * kFriction;
				newImpulse = v2.clamp(dv.dot(this.normalPerp) * this.invDenomTan + this.impulseT, -absMag, absMag);
				this.applyImpulse(v3.scale(this.normalPerp, newImpulse - this.impulseT));
				this.impulseT = newImpulse;
			}
		}

		function render()
		{
			// aabb broadphase
			
			contacts.index = 0;
			for (var i = 0, len = objects.length; i < len - 1; i++)
			{
				var A = objects[i];
				for (var j = i + 1; j < len; j++)
				{
					var B = objects[j];
					if (A.invMass || B.invMass)
					{
						var a = A.aabb,
							b = B.aabb;
						if (
							Math.abs(b.x - a.x) - (a.w + b.w) < 0 &&
							Math.abs(b.y - a.y) - (a.h + b.h) < 0
						) A.contact(B);
					}

				}
			}

			// solver

			var len = contacts.index;

			for (var j = 0; j < 5; j++)
			{
				for (var i = 0; i < len; i++)
				{
					contacts[i].solve();
				}
			}

			// integration

			for (var i = 0, len = objects.length; i < len; i++)
			{
				objects[i].integrate();
			}

			// draw polygons

			for (var i = 0; i < len; i++)
			{
				var rb = objects[i];
				rb.draw();

			}
		}

		// public interface

		return {

			render: render,

			// create new rectangle

			rectangle: function (x, y, w, h, mass, angle, img)
			{
				var vertices = [
					w / 2, -h / 2, -w / 2, -h / 2, -w / 2, h / 2,
					w / 2, h / 2
				];

				var invMass = mass ? 1 / mass : 0;
				return new Polygon(x, y, w, h, vertices, invMass, angle, img);
			},

			// delete static objects

			deleteStatic: function ()
			{
				var k = objects.length;
				while (k--)
				{

					var p = objects[k];
					if (!p.invMass) objects.splice(k, 1);

				}
			},

			// draw numbers

			number: function (w, h, text)
			{
				var img = document.createElement("canvas");
				var context = img.getContext("2d");
				img.width = w;
				img.height = h;
				context.font = "bold " + (w * 0.92) + "px arial";
				context.fillStyle = hsl;
				context.fillText(text, 0, h * 0.97);
				return img;
			},

			// delete objects

			delete: function (object)
			{
				for (var i = 0, len = objects.length; i < len; i++)
				{

					if (objects[i] === object)
					{
						objects.splice(i, 1);
						return;
					}

				}
			}
		}
	}(ctx, pointer, Vector, Matrix);

	/* ==== clock logic ==== */

	screen.resize();

	function n(n)
	{
		return n > 9 ? "" + n : "0" + n;
	}

	var hb = "",
		mb = "",
		hsl = "",
		hue = 0,
		lum = 0,
		xp = 0;
	var hour, minut, seconds = [];

	function addNumber(w, x, t, m, a)
	{
		var h = (w * 0.69) | 0;
		var img = PHY2D.number(w, h, t);
		return PHY2D.rectangle(x, -w, w, h, m, a, img);

	}

	function toc()
	{
		// what time is it ?

		var t = new Date(),
			hr = n(t.getHours()),
			mn = n(t.getMinutes()),
			sc = n(t.getSeconds()),
			w, h, img, sec;

		// hour

		if (hr != hb)
		{
			hue = (Math.random() * 360) | 0;
			hsl = "hsl(" + hue + ", 70%, 80%)";
			w = (screen.width / 3) | 0;
			PHY2D.delete(hour);
			hour = addNumber(w, w * 1.2, hr, 1, 0);
			hb = hr;
		}

		// minute

		if (mn != mb)
		{
			// new color hue
			hue = (Math.random() * 360) | 0;
			hsl = "hsl(" + hue + ", 70%, 60%)";

			// change hour color
			w = (screen.width / 3) | 0;
			h = (w * 0.69) | 0;
			img = PHY2D.number(w, h, hr);
			hour.img = img;

			// delete old minute and create new one
			w = (screen.width / 5) | 0;
			PHY2D.delete(minut);
			minut = addNumber(w, screen.width - w * 1.2, mn, 1, 0);
			mb = mn;

			// delete old seconds
			for (var i = 0; i < seconds.length; i++)
			{
				setTimeout(function ()
				{
					PHY2D.delete(seconds.shift());
				}, i * 60)
			}
			xp = 0;
		}

		// seconds
		hsl = "hsl(" + hue + ",70%," + ((20 + Math.random() * 80) | 0) + "%)";
		w = (screen.width / 15) | 0;
		sec = addNumber(w, w + (xp * w) % (screen.width - (w * 2)), sc, 0.1, Math.random() * 2 * Math.PI);
		seconds.push(sec);
		xp++;
	}

	toc();
	setInterval(toc, 1000);
	
	/* ==== main loop ==== */

	function run()
	{
		requestAnimationFrame(run);
		ctx.clearRect(0, 0, screen.width, screen.height);
		PHY2D.render();

	}

	requestAnimationFrame(run);

}();
    </script>
<!-- End Nav Bar -->

<?php include(APPPATH . 'views/modals/parent_notes_modal.php'); ?>
<?php include(APPPATH . 'views/modals/teacher_announcements_modal.php'); ?>
<?php include(APPPATH . 'views/modals/logout_confirm_modal.php'); ?>
<?php include(APPPATH . 'views/modals/notifications_modal.php'); ?>
<?php include(APPPATH . 'views/modals/customize_modal.php'); ?>
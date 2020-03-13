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

        exit(0);
    }

    if($CI->user_model->isParent($logged_user->email,$id) == 999)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    //get children for navbar
    $children_display = $CI->user_model->view_child($logged_user->email);

    //get data of child being monitored
    $children = $CI->user_model->view_specific_child($id);
  

    //read data of child 
    //note: foreach is needed even though only one child is being fetched
    foreach ($children->result() as $child): 

    $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));
    
    //testing allowed times
    date_default_timezone_set('Asia/Manila');
    $usertimes = $CI->user_model->get_usertimes($id);

    if ($usertimes) 
    {
        // foreach ($usertimes->result() as $row)
        // {
        //     echo count(explode(" ",$row->time_setting));
        // }
    } 

    $num=-1;

    $CI =&get_instance();
    $CI->load->library('user_agent');

    $mobile=$CI->agent->is_mobile();

?>

<style>
    div.content-container
    {
        border:0px;
        background-color: #f7f7f7;
    }

    .myTable 
    { 
        background-color: #f7f7f7;

        width: 93%;
        text-align: left;
        border-collapse: collapse; 
    }

    .myTable th 
    { 
        background: rgb(100,100,100);
        color: white; 
        padding: 5px;
        border: 1px solid grey; 
    }

    
    .myTable td
    { 
        <?php if ($mobile): ?>
            font-size: 8px;
            width: 10px;
        <?php endif; ?>

        background: rgb(255,255,255);
        
        padding: 3px;
        border: 1px solid; 
    }

    .myTable th 
    { 
        width: 5%;
        padding: 3px;
        border: 1px solid black; 
    }

    td.timecol
    {
        background: rgb(242,242,242);
        font-size: 14px;

        <?php if ($mobile): ?>
            font-size: 8px;
            width: 10px;
        <?php endif; ?>
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus 
    {
        color: white;
        background-color: #228a45;
    }

    .nav > li > a:hover, .nav > li > a:focus 
    {
        text-decoration: none;
        background-color: #ffffff;
        color: #228a45;
    }

</style>

<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";
    document.cookie = "selectedWarning=0;path=/";   
    document.cookie = "selectedLimit=180;path=/"; 
    // document.cookie = "selectedKeep=1;path=/"; 
    var ctr = 0;
    var toggle = 0;
    var m, n;
</script>

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid #CFD8DC;">
    <div class = "container-fluid">
    <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px; border:0" href="<?php echo base_url('parents/activity/' . $child->user_id) ?>">
        <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
            <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                Back
            </strong>
        </h3>
    </a>

   <!--  <span class = "pull-left btn-topic-header" style = "display: inline-block; margin-right: 5px; border:0" href="<?php echo base_url('parents/activity/' . $child->user_id) ?>">
        <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
            <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                Back
            </strong>
        </h3>
    </span> -->
        
        
    <?php if (!$mobile): ?>

        <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px;">
            <li class="dropdown ">

                <a class="dropdown-toggle pull-right" data-toggle="dropdown" href="#">
                    Monitoring: <b><?php echo $child->first_name ?></b>
                    <span class="caret"></span>
                </a>                 
            
                <ul class="dropdown-menu container container-fluid col-md-4 col-xs-4 col-sm-4">

                    <?php foreach ($children_display->result() as $children):$data['user'] = $CI->user_model->get_user(true, true, array('user_id' =>  $children->user_id));?>

                    <li><a href="<?php echo base_url('parents/settings/' . $children->user_id); ?>"><i class = "fa fa-user" style="color:green"></i> <?php echo $children->first_name ?> </a></li>    
                    <?php endforeach; ?>

                    <li><span style="color:white">______</span></li>
                    
                    <li><a href = "<?php echo base_url('signin/logout'); ?>"><i class = "glyphicon glyphicon-log-out" style="color:red;"></i> Log Out</a></li>

                </ul>
            </li>
        </ul>

    <?php else:?>
        <a href="#logout-modal-parents" data-toggle = "modal" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px; background:#c73838; border-color: #c73838;">Log Out</a>
                        
    <?php endif; ?>
        
    </div>
</nav><br><br><br>

<link href="https://fonts.googleapis.com/css?family=Cabin|Muli|Oswald" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if ($logged_user->role_id == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />

<?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url("/css/style_parentview.css"); ?>" />

<?php endif; ?>

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <script>

                function colorchange(id) 
                {
                    var background = document.getElementById(id).style.backgroundColor;
                    var newID = id.replace("-A","");
                    
                    if (background == "rgb(50, 200, 100)" && id.includes("-A")) 
                    {
                        document.getElementById(id).style.background = "rgb(255, 255, 255)";
                        document.getElementById(id).id = id.replace("-A","");
                    } 

                    else if(!id.includes("-A"))
                    {
                        document.getElementById(id).style.background = "rgb(50, 200, 100)";
                        document.getElementById(id).id = id + "-A";
                    }

                    // alert(id); 
                }

                
                function clearTable() 
                {
                    var i, temp; 
                    
                    for(i=1; i<337; i++)
                    {
                        temp = "cell" + i +"-A";

                        if(document.getElementById(temp))
                        {
                            document.getElementById(temp).style.background = "rgb(255, 255, 255)";
                            document.getElementById(temp).id = temp.replace("-A","");
                        }

                    }  

                }

                function fullTable() 
                {
                    clearTable();

                    var i, temp; 
                    
                    for(i=1; i<337; i++)
                    {
                        temp = "cell" + i;
                        if(document.getElementById(temp))
                        {
                            document.getElementById(temp).style.background = "rgb(50, 200, 100)";
                            document.getElementById(temp).id = temp + "-A";
                        }

                    }  

                }

                function defaultTable() 
                {

                    clearTable();

                    // if(document.getElementById("keep").checked == false)
                    //     document.getElementById("keep").checked = true;

                    // document.getElementById("time-limit").options[3].selected = true;

                    // document.getElementById("time-warning").options[2].selected = true;
                    
                    var i, temp, string ="cell133-A cell140-A cell147-A cell154-A cell161-A cell168-A cell188-A cell195-A cell202-A cell209-A cell216-A cell223-A cell230-A cell237-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell259-A cell260-A cell261-A cell262-A cell263-A cell264-A cell266-A cell281-A cell282-A cell283-A cell284-A cell285-A cell286-A cell293-A";

                    var defaultTime = string.split(" ");
                    
                    for(i=1; i<defaultTime.length+1; i++)
                    {
                        temp = defaultTime[i-1].replace("-A","");

                        if(document.getElementById(temp))
                        {
                            document.getElementById(temp).style.background = "rgb(50, 200, 100)";
                            document.getElementById(temp).id = temp + "-A";
                        }
                    }                      
                }

            </script>

            <div class = "col-md-12 col-sm-14 col-xs-16 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 0px;">

                <div class = "content-container container-fluid " style = "margin-bottom: 4.5px;">

                    <div class = "col-xs-12 form-group register-field text-center" style = "">
                        <h3 class = "col-xs-12 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Manage <b><?php echo $child->first_name ?>'s </b>Schedule</h3>
                        
                    </div>

                    <ul class="nav nav-pills nav-justified" style = "margin-bottom:0px; margin-top:0px;">
   
                        <li class = "active text-center">
                            <h4 class = "no-padding text-info" style = "margin-top: 15px;">Session Time Limit</h4>
                                

                            <select style="width:110px; height:20px" id="time-limit" onclick="">
                                <option value="0">None</option>
                                <option value="30">30 minutes</option>
                                <option value="60">1 hour</option>
                                <option value="90">1 hr 30 mins</option>
                                <option value="120">2 hours</option>
                                <option value="150">2 hrs 30 mins</option>
                                <option value="180">3 hours</option>
                            </select>

                            <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">As parents, you can set how long your child can use Mukhlat for each session.<br></p>
                        </li><br>

                        <!-- <li class = "active text-center">
                            <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">Mukhlat has a feature that warns children that they can<br>only use Mukhlat for a limited time, and that their session is about to end.</p>
                        </li> -->


                        <!-- <li class = "active text-center">
                            <h3 class = "no-padding text-info" style = "margin-top: 10px;">Warning</h3>
                            
                            <select style="width:100px; height:20px" id="time-warning" onclick=""> 
                                <option value="0">None</option>
                                <option value="15">15 minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="45">45 minutes</option>
                                <option value="60">1 hour</option>
                            </select>

                            <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">Mukhlat has a feature that warns children that they can<br>only use Mukhlat for a limited time, and that their session is about to end.</p>
                        </li> -->


                    </ul>

                    <div class = "content-container container-fluid col-md-10 col-md-offset-1 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                        <ul class="nav nav-pills nav-justified" style="">
                            <li class="" style="background-color: #f0f0f0"><a style="" data-toggle="pill" href="#timetable-1">12:00 Midnight to 06:00 AM</a></li>
                            <li class="" style="background-color: #f0f0f0"><a style="" data-toggle="pill" href="#timetable-2">06:00 AM to 12:00 Noon</a></li>
                            <li class="active" style="background-color: #f0f0f0"><a style="" data-toggle="pill" href="#timetable-3">12:00 Noon to 06:00 PM</a></li>
                            <li class="" style="background-color: #f0f0f0"><a style="" data-toggle="pill" href="#timetable-4">06:00 PM to 12:00 Midnight</a></li>
                            <!-- <li class="" style="background-color: #f0f0f0"><a style="padding: 10px;" data-toggle="pill" href="#timetable-5">Night</a></li>
                            <li class="" style="background-color: #f0f0f0"><a style="padding: 10px;" data-toggle="pill" href="#timetable-6">Late Night</a></li> -->
                            
                        </ul>
                    </div>

                </div>

                <!-- <ul class="nav nav-pills nav-justified" style="">
                    <li class=""><a data-toggle="pill" href="#timetable-1">12:00 AM - 07:00 AM</a></li>
                    <li class="active"><a data-toggle="pill" href="#timetable-2">07:00 AM - 06:00 PM</a></li>
                    <li class=""><a data-toggle="pill" href="#timetable-3">06:00 PM - 12:00 AM</a></li>
                    <br>
                </ul> -->


                 <!-- The table -->
                 <div id="time-table" class="container-fluid tab-content row">

                    <table id="timetable-1" class="myTable container-fluid tab-pane fade">
                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>12:00<br> to 01:00</center></td>
                            <td id="cell1" onclick="colorchange(this.id)"> </td>
                            <td id="cell2" onclick="colorchange(this.id)"> </td>
                            <td id="cell3" onclick="colorchange(this.id)"> </td>
                            <td id="cell4" onclick="colorchange(this.id)"> </td>
                            <td id="cell5" onclick="colorchange(this.id)"> </td>
                            <td id="cell6" onclick="colorchange(this.id)"> </td>
                            <td id="cell7" onclick="colorchange(this.id)"> </td>
                        </tr>
                        <tr>
                            <!-- <td id="_cell8" class="timecol"><center>12:30</center></td> -->
                            <td id="cell8" onclick="colorchange(this.id)"> </td>
                            <td id="cell9" onclick="colorchange(this.id)"> </td>
                            <td id="cell10" onclick="colorchange(this.id)"> </td>
                            <td id="cell11" onclick="colorchange(this.id)"> </td>
                            <td id="cell12" onclick="colorchange(this.id)"> </td>
                            <td id="cell13" onclick="colorchange(this.id)"> </td>
                            <td id="cell14" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>01:00<br> to 02:00</center></td>
                            <td id="cell15" onclick="colorchange(this.id)"> </td>
                            <td id="cell16" onclick="colorchange(this.id)"> </td>
                            <td id="cell17" onclick="colorchange(this.id)"> </td>
                            <td id="cell18" onclick="colorchange(this.id)"> </td>
                            <td id="cell19" onclick="colorchange(this.id)"> </td>
                            <td id="cell20" onclick="colorchange(this.id)"> </td>
                            <td id="cell21" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td id="_cell22" class="timecol"><center>01:30</center></td> -->
                            <td id="cell22" onclick="colorchange(this.id)"> </td>
                            <td id="cell23" onclick="colorchange(this.id)"> </td>
                            <td id="cell24" onclick="colorchange(this.id)"> </td>
                            <td id="cell25" onclick="colorchange(this.id)"> </td>
                            <td id="cell26" onclick="colorchange(this.id)"> </td>
                            <td id="cell27" onclick="colorchange(this.id)"> </td>
                            <td id="cell28" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>02:00<br> to 03:00</center></td>
                            <td id="cell29" onclick="colorchange(this.id)"> </td>
                            <td id="cell30" onclick="colorchange(this.id)"> </td>
                            <td id="cell31" onclick="colorchange(this.id)"> </td>
                            <td id="cell32" onclick="colorchange(this.id)"> </td>
                            <td id="cell33" onclick="colorchange(this.id)"> </td>
                            <td id="cell34" onclick="colorchange(this.id)"> </td>
                            <td id="cell35" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td id="" class="timecol" ><center>02:30</center></td> -->
                            <td id="cell36" onclick="colorchange(this.id)"> </td>
                            <td id="cell37" onclick="colorchange(this.id)"> </td>
                            <td id="cell38" onclick="colorchange(this.id)"> </td>
                            <td id="cell39" onclick="colorchange(this.id)"> </td>
                            <td id="cell40" onclick="colorchange(this.id)"> </td>
                            <td id="cell41" onclick="colorchange(this.id)"> </td>
                            <td id="cell42" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>03:00<br> to 04:00</center></td>
                            <td id="cell43" onclick="colorchange(this.id)"> </td>
                            <td id="cell44" onclick="colorchange(this.id)"> </td>
                            <td id="cell45" onclick="colorchange(this.id)"> </td>
                            <td id="cell46" onclick="colorchange(this.id)"> </td>
                            <td id="cell47" onclick="colorchange(this.id)"> </td>
                            <td id="cell48" onclick="colorchange(this.id)"> </td>
                            <td id="cell49" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>03:30</center></td> -->
                            <td id="cell50" onclick="colorchange(this.id)"> </td>
                            <td id="cell51" onclick="colorchange(this.id)"> </td>
                            <td id="cell52" onclick="colorchange(this.id)"> </td>
                            <td id="cell53" onclick="colorchange(this.id)"> </td>
                            <td id="cell54" onclick="colorchange(this.id)"> </td>
                            <td id="cell55" onclick="colorchange(this.id)"> </td>
                            <td id="cell56" onclick="colorchange(this.id)"> </td>
                        </tr>


                        <tr>
                            <td rowspan="2" class="timecol row"><center>04:00<br> to 05:00</center></td>
                            <td id="cell57" onclick="colorchange(this.id)"> </td>
                            <td id="cell58" onclick="colorchange(this.id)"> </td>
                            <td id="cell59" onclick="colorchange(this.id)"> </td>
                            <td id="cell60" onclick="colorchange(this.id)"> </td>
                            <td id="cell61" onclick="colorchange(this.id)"> </td>
                            <td id="cell62" onclick="colorchange(this.id)"> </td>
                            <td id="cell63" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>04:30</center></td> -->
                            <td id="cell64" onclick="colorchange(this.id)"> </td>
                            <td id="cell65" onclick="colorchange(this.id)"> </td>
                            <td id="cell66" onclick="colorchange(this.id)"> </td>
                            <td id="cell67" onclick="colorchange(this.id)"> </td>
                            <td id="cell68" onclick="colorchange(this.id)"> </td>
                            <td id="cell69" onclick="colorchange(this.id)"> </td>
                            <td id="cell70" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>05:00<br> to 06:00</center></td>
                            <td id="cell71" onclick="colorchange(this.id)"> </td>
                            <td id="cell72" onclick="colorchange(this.id)"> </td>
                            <td id="cell73" onclick="colorchange(this.id)"> </td>
                            <td id="cell74" onclick="colorchange(this.id)"> </td>
                            <td id="cell75" onclick="colorchange(this.id)"> </td>
                            <td id="cell76" onclick="colorchange(this.id)"> </td>
                            <td id="cell77" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>05:30</center></td> -->
                            <td id="cell78" onclick="colorchange(this.id)"> </td>
                            <td id="cell79" onclick="colorchange(this.id)"> </td>
                            <td id="cell80" onclick="colorchange(this.id)"> </td>
                            <td id="cell81" onclick="colorchange(this.id)"> </td>
                            <td id="cell82" onclick="colorchange(this.id)"> </td>
                            <td id="cell83" onclick="colorchange(this.id)"> </td>
                            <td id="cell84" onclick="colorchange(this.id)"> </td>
                        </tr>

                    </table>

                    <table id="timetable-2" class="myTable container-fluid tab-pane fade">
                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>06:00<br> to 07:00</center></td>
                            <td id="cell85" onclick="colorchange(this.id)"> </td>
                            <td id="cell86" onclick="colorchange(this.id)"> </td>
                            <td id="cell87" onclick="colorchange(this.id)"> </td>
                            <td id="cell88" onclick="colorchange(this.id)"> </td>
                            <td id="cell89" onclick="colorchange(this.id)"> </td>
                            <td id="cell90" onclick="colorchange(this.id)"> </td>
                            <td id="cell91" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td id="_cell92" class="timecol" ><center>06:30</center></td> -->
                            <td id="cell92" onclick="colorchange(this.id)"> </td>
                            <td id="cell93" onclick="colorchange(this.id)"> </td>
                            <td id="cell94" onclick="colorchange(this.id)"> </td>
                            <td id="cell95" onclick="colorchange(this.id)"> </td>
                            <td id="cell96" onclick="colorchange(this.id)"> </td>
                            <td id="cell97" onclick="colorchange(this.id)"> </td>
                            <td id="cell98" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>07:00<br> to 08:00</center></td>
                            <td id="cell99" onclick="colorchange(this.id)"> </td>
                            <td id="cell100" onclick="colorchange(this.id)"> </td>
                            <td id="cell101" onclick="colorchange(this.id)"> </td>
                            <td id="cell102" onclick="colorchange(this.id)"> </td>
                            <td id="cell103" onclick="colorchange(this.id)"> </td>
                            <td id="cell104" onclick="colorchange(this.id)"> </td>
                            <td id="cell105" onclick="colorchange(this.id)"> </td>
                        </tr>                        

                        
                        <tr>
                            <!-- <td id="_cell106" class="timecol" onclick=""><center>07:30</center></td> -->
                            <td id="cell106" onclick="colorchange(this.id)"> </td>
                            <td id="cell107" onclick="colorchange(this.id)"> </td>
                            <td id="cell108" onclick="colorchange(this.id)"> </td>
                            <td id="cell109" onclick="colorchange(this.id)"> </td>
                            <td id="cell110" onclick="colorchange(this.id)"> </td>
                            <td id="cell111" onclick="colorchange(this.id)"> </td>
                            <td id="cell112" onclick="colorchange(this.id)"> </td>
                        </tr>
        
                        <tr>
                            <td rowspan="2" class="timecol row"><center>08:00<br> to 09:00</center></td>
                            <td id="cell113" onclick="colorchange(this.id)"> </td>
                            <td id="cell114" onclick="colorchange(this.id)"> </td>
                            <td id="cell115" onclick="colorchange(this.id)"> </td>
                            <td id="cell116" onclick="colorchange(this.id)"> </td>
                            <td id="cell117" onclick="colorchange(this.id)"> </td>
                            <td id="cell118" onclick="colorchange(this.id)"> </td>
                            <td id="cell119" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>08:30</center></td> -->
                            <td id="cell120" onclick="colorchange(this.id)"> </td>
                            <td id="cell121" onclick="colorchange(this.id)"> </td>
                            <td id="cell122" onclick="colorchange(this.id)"> </td>
                            <td id="cell123" onclick="colorchange(this.id)"> </td>
                            <td id="cell124" onclick="colorchange(this.id)"> </td>
                            <td id="cell125" onclick="colorchange(this.id)"> </td>
                            <td id="cell126" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>09:00<br> to 10:00</center></td>
                            <td id="cell127" onclick="colorchange(this.id)"> </td>
                            <td id="cell128" onclick="colorchange(this.id)"> </td>
                            <td id="cell129" onclick="colorchange(this.id)"> </td>
                            <td id="cell130" onclick="colorchange(this.id)"> </td>
                            <td id="cell131" onclick="colorchange(this.id)"> </td>
                            <td id="cell132" onclick="colorchange(this.id)"> </td>
                            <td id="cell133" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>09:30</center></td> -->
                            <td id="cell134" onclick="colorchange(this.id)"> </td>
                            <td id="cell135" onclick="colorchange(this.id)"> </td>
                            <td id="cell136" onclick="colorchange(this.id)"> </td>
                            <td id="cell137" onclick="colorchange(this.id)"> </td>
                            <td id="cell138" onclick="colorchange(this.id)"> </td>
                            <td id="cell139" onclick="colorchange(this.id)"> </td>
                            <td id="cell140" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>10:00<br> to 11:00</center></td>
                            <td id="cell141" onclick="colorchange(this.id)"> </td>
                            <td id="cell142" onclick="colorchange(this.id)"> </td>
                            <td id="cell143" onclick="colorchange(this.id)"> </td>
                            <td id="cell144" onclick="colorchange(this.id)"> </td>
                            <td id="cell145" onclick="colorchange(this.id)"> </td>
                            <td id="cell146" onclick="colorchange(this.id)"> </td>
                            <td id="cell147" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>10:30</center></td> -->
                            <td id="cell148" onclick="colorchange(this.id)"> </td>
                            <td id="cell149" onclick="colorchange(this.id)"> </td>
                            <td id="cell150" onclick="colorchange(this.id)"> </td>
                            <td id="cell151" onclick="colorchange(this.id)"> </td>
                            <td id="cell152" onclick="colorchange(this.id)"> </td>
                            <td id="cell153" onclick="colorchange(this.id)"> </td>
                            <td id="cell154" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>11:00<br> to 12:00</center></td>
                            <td id="cell155" onclick="colorchange(this.id)"> </td>
                            <td id="cell156" onclick="colorchange(this.id)"> </td>
                            <td id="cell157" onclick="colorchange(this.id)"> </td>
                            <td id="cell158" onclick="colorchange(this.id)"> </td>
                            <td id="cell159" onclick="colorchange(this.id)"> </td>
                            <td id="cell160" onclick="colorchange(this.id)"> </td>
                            <td id="cell161" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>11:30</center></td> -->
                            <td id="cell162" onclick="colorchange(this.id)"> </td>
                            <td id="cell163" onclick="colorchange(this.id)"> </td>
                            <td id="cell164" onclick="colorchange(this.id)"> </td>
                            <td id="cell165" onclick="colorchange(this.id)"> </td>
                            <td id="cell166" onclick="colorchange(this.id)"> </td>
                            <td id="cell167" onclick="colorchange(this.id)"> </td>
                            <td id="cell168" onclick="colorchange(this.id)"> </td>
                        </tr>


                    </table>

                    <table id="timetable-3" class="myTable container-fluid tab-pane fade in active">
                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>12:00<br> to 01:00</center></td>
                            <td id="cell169" onclick="colorchange(this.id)"> </td>
                            <td id="cell170" onclick="colorchange(this.id)"> </td>
                            <td id="cell171" onclick="colorchange(this.id)"> </td>
                            <td id="cell172" onclick="colorchange(this.id)"> </td>
                            <td id="cell173" onclick="colorchange(this.id)"> </td>
                            <td id="cell174" onclick="colorchange(this.id)"> </td>
                            <td id="cell175" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>12:30</center></td> -->
                            <td id="cell176" onclick="colorchange(this.id)"> </td>
                            <td id="cell177" onclick="colorchange(this.id)"> </td>
                            <td id="cell178" onclick="colorchange(this.id)"> </td>
                            <td id="cell179" onclick="colorchange(this.id)"> </td>
                            <td id="cell180" onclick="colorchange(this.id)"> </td>
                            <td id="cell181" onclick="colorchange(this.id)"> </td>
                            <td id="cell182" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>01:00<br> to 02:00</center></td>
                            <td id="cell183" onclick="colorchange(this.id)"> </td>
                            <td id="cell184" onclick="colorchange(this.id)"> </td>
                            <td id="cell185" onclick="colorchange(this.id)"> </td>
                            <td id="cell186" onclick="colorchange(this.id)"> </td>
                            <td id="cell187" onclick="colorchange(this.id)"> </td>
                            <td id="cell188" onclick="colorchange(this.id)"> </td>
                            <td id="cell189" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>01:30</center></td> -->
                            <td id="cell190" onclick="colorchange(this.id)"> </td>
                            <td id="cell191" onclick="colorchange(this.id)"> </td>
                            <td id="cell192" onclick="colorchange(this.id)"> </td>
                            <td id="cell193" onclick="colorchange(this.id)"> </td>
                            <td id="cell194" onclick="colorchange(this.id)"> </td>
                            <td id="cell195" onclick="colorchange(this.id)"> </td>
                            <td id="cell196" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>02:00<br> to 03:00</center></td>
                            <td id="cell197" onclick="colorchange(this.id)"> </td>
                            <td id="cell198" onclick="colorchange(this.id)"> </td>
                            <td id="cell199" onclick="colorchange(this.id)"> </td>
                            <td id="cell200" onclick="colorchange(this.id)"> </td>
                            <td id="cell201" onclick="colorchange(this.id)"> </td>
                            <td id="cell202" onclick="colorchange(this.id)"> </td>
                            <td id="cell203" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>02:30</center></td> -->
                            <td id="cell204" onclick="colorchange(this.id)"> </td>
                            <td id="cell205" onclick="colorchange(this.id)"> </td>
                            <td id="cell206" onclick="colorchange(this.id)"> </td>
                            <td id="cell207" onclick="colorchange(this.id)"> </td>
                            <td id="cell208" onclick="colorchange(this.id)"> </td>
                            <td id="cell209" onclick="colorchange(this.id)"> </td>
                            <td id="cell210" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>03:00<br> to 04:00</center></td>
                            <td id="cell211" onclick="colorchange(this.id)"> </td>
                            <td id="cell212" onclick="colorchange(this.id)"> </td>
                            <td id="cell213" onclick="colorchange(this.id)"> </td>
                            <td id="cell214" onclick="colorchange(this.id)"> </td>
                            <td id="cell215" onclick="colorchange(this.id)"> </td>
                            <td id="cell216" onclick="colorchange(this.id)"> </td>
                            <td id="cell217" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>03:30</center></td> -->
                            <td id="cell218" onclick="colorchange(this.id)"> </td>
                            <td id="cell219" onclick="colorchange(this.id)"> </td>
                            <td id="cell220" onclick="colorchange(this.id)"> </td>
                            <td id="cell221" onclick="colorchange(this.id)"> </td>
                            <td id="cell222" onclick="colorchange(this.id)"> </td>
                            <td id="cell223" onclick="colorchange(this.id)"> </td>
                            <td id="cell224" onclick="colorchange(this.id)"> </td>
                        </tr>
                        
                        <tr>
                            <td rowspan="2" class="timecol row"><center>04:00<br> to 05:00</center></td>
                            <td id="cell225" onclick="colorchange(this.id)"> </td>
                            <td id="cell226" onclick="colorchange(this.id)"> </td>
                            <td id="cell227" onclick="colorchange(this.id)"> </td>
                            <td id="cell228" onclick="colorchange(this.id)"> </td>
                            <td id="cell229" onclick="colorchange(this.id)"> </td>
                            <td id="cell230" onclick="colorchange(this.id)"> </td>
                            <td id="cell231" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>04:30</center></td> -->
                            <td id="cell232" onclick="colorchange(this.id)"> </td>
                            <td id="cell233" onclick="colorchange(this.id)"> </td>
                            <td id="cell234" onclick="colorchange(this.id)"> </td>
                            <td id="cell235" onclick="colorchange(this.id)"> </td>
                            <td id="cell236" onclick="colorchange(this.id)"> </td>
                            <td id="cell237" onclick="colorchange(this.id)"> </td>
                            <td id="cell238" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>05:00<br> to 06:00</center></td>
                            <td id="cell239" onclick="colorchange(this.id)"> </td>
                            <td id="cell240" onclick="colorchange(this.id)"> </td>
                            <td id="cell241" onclick="colorchange(this.id)"> </td>
                            <td id="cell242" onclick="colorchange(this.id)"> </td>
                            <td id="cell243" onclick="colorchange(this.id)"> </td>
                            <td id="cell244" onclick="colorchange(this.id)"> </td>
                            <td id="cell245" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>05:30</center></td> -->
                            <td id="cell246" onclick="colorchange(this.id)"> </td>
                            <td id="cell247" onclick="colorchange(this.id)"> </td>
                            <td id="cell248" onclick="colorchange(this.id)"> </td>
                            <td id="cell249" onclick="colorchange(this.id)"> </td>
                            <td id="cell250" onclick="colorchange(this.id)"> </td>
                            <td id="cell251" onclick="colorchange(this.id)"> </td>
                            <td id="cell252" onclick="colorchange(this.id)"> </td>
                        </tr>

                    </table>

                    <table id="timetable-4" class="myTable container-fluid tab-pane fade">
                        
                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>

                        
                        <tr>
                            <td rowspan="2" class="timecol row"><center>06:00<br> to 07:00</center></td>
                            <td id="cell253" onclick="colorchange(this.id)"> </td>
                            <td id="cell254" onclick="colorchange(this.id)"> </td>
                            <td id="cell255" onclick="colorchange(this.id)"> </td>
                            <td id="cell256" onclick="colorchange(this.id)"> </td>
                            <td id="cell257" onclick="colorchange(this.id)"> </td>
                            <td id="cell258" onclick="colorchange(this.id)"> </td>
                            <td id="cell259" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>06:30</center></td> -->
                            <td id="cell260" onclick="colorchange(this.id)"> </td>
                            <td id="cell261" onclick="colorchange(this.id)"> </td>
                            <td id="cell262" onclick="colorchange(this.id)"> </td>
                            <td id="cell263" onclick="colorchange(this.id)"> </td>
                            <td id="cell264" onclick="colorchange(this.id)"> </td>
                            <td id="cell265" onclick="colorchange(this.id)"> </td>
                            <td id="cell266" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>07:00<br> to 08:00</center></td>
                            <td id="cell267" onclick="colorchange(this.id)"> </td>
                            <td id="cell268" onclick="colorchange(this.id)"> </td>
                            <td id="cell269" onclick="colorchange(this.id)"> </td>
                            <td id="cell270" onclick="colorchange(this.id)"> </td>
                            <td id="cell271" onclick="colorchange(this.id)"> </td>
                            <td id="cell272" onclick="colorchange(this.id)"> </td>
                            <td id="cell273" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>07:30</center></td> -->
                            <td id="cell274" onclick="colorchange(this.id)"> </td>
                            <td id="cell275" onclick="colorchange(this.id)"> </td>
                            <td id="cell276" onclick="colorchange(this.id)"> </td>
                            <td id="cell277" onclick="colorchange(this.id)"> </td>
                            <td id="cell278" onclick="colorchange(this.id)"> </td>
                            <td id="cell279" onclick="colorchange(this.id)"> </td>
                            <td id="cell280" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>08:00<br> to 09:00</center></td>
                            <td id="cell281" onclick="colorchange(this.id)"> </td>
                            <td id="cell282" onclick="colorchange(this.id)"> </td>
                            <td id="cell283" onclick="colorchange(this.id)"> </td>
                            <td id="cell284" onclick="colorchange(this.id)"> </td>
                            <td id="cell285" onclick="colorchange(this.id)"> </td>
                            <td id="cell286" onclick="colorchange(this.id)"> </td>
                            <td id="cell287" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>08:30</center></td> -->
                            <td id="cell288" onclick="colorchange(this.id)"> </td>
                            <td id="cell289" onclick="colorchange(this.id)"> </td>
                            <td id="cell290" onclick="colorchange(this.id)"> </td>
                            <td id="cell291" onclick="colorchange(this.id)"> </td>
                            <td id="cell292" onclick="colorchange(this.id)"> </td>
                            <td id="cell293" onclick="colorchange(this.id)"> </td>
                            <td id="cell294" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>09:00<br> to 10:00</center></td>
                            <td id="cell295" onclick="colorchange(this.id)"> </td>
                            <td id="cell296" onclick="colorchange(this.id)"> </td>
                            <td id="cell297" onclick="colorchange(this.id)"> </td>
                            <td id="cell298" onclick="colorchange(this.id)"> </td>
                            <td id="cell299" onclick="colorchange(this.id)"> </td>
                            <td id="cell300" onclick="colorchange(this.id)"> </td>
                            <td id="cell301" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>09:30</center></td> -->
                            <td id="cell302" onclick="colorchange(this.id)"> </td>
                            <td id="cell303" onclick="colorchange(this.id)"> </td>
                            <td id="cell304" onclick="colorchange(this.id)"> </td>
                            <td id="cell305" onclick="colorchange(this.id)"> </td>
                            <td id="cell306" onclick="colorchange(this.id)"> </td>
                            <td id="cell307" onclick="colorchange(this.id)"> </td>
                            <td id="cell308" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>10:00<br> to 11:00</center></td>
                            <td id="cell309" onclick="colorchange(this.id)"> </td>
                            <td id="cell310" onclick="colorchange(this.id)"> </td>
                            <td id="cell311" onclick="colorchange(this.id)"> </td>
                            <td id="cell312" onclick="colorchange(this.id)"> </td>
                            <td id="cell313" onclick="colorchange(this.id)"> </td>
                            <td id="cell314" onclick="colorchange(this.id)"> </td>
                            <td id="cell315" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>10:30</center></td> -->
                            <td id="cell316" onclick="colorchange(this.id)"> </td>
                            <td id="cell317" onclick="colorchange(this.id)"> </td>
                            <td id="cell318" onclick="colorchange(this.id)"> </td>
                            <td id="cell319" onclick="colorchange(this.id)"> </td>
                            <td id="cell320" onclick="colorchange(this.id)"> </td>
                            <td id="cell321" onclick="colorchange(this.id)"> </td>
                            <td id="cell322" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="timecol row"><center>11:00<br> to 12:00</center></td>
                            <td id="cell323" onclick="colorchange(this.id)"> </td>
                            <td id="cell324" onclick="colorchange(this.id)"> </td>
                            <td id="cell325" onclick="colorchange(this.id)"> </td>
                            <td id="cell326" onclick="colorchange(this.id)"> </td>
                            <td id="cell327" onclick="colorchange(this.id)"> </td>
                            <td id="cell328" onclick="colorchange(this.id)"> </td>
                            <td id="cell329" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <!-- <td class="timecol" ><center>11:30</center></td> -->
                            <td id="cell330" onclick="colorchange(this.id)"> </td>
                            <td id="cell331" onclick="colorchange(this.id)"> </td>
                            <td id="cell332" onclick="colorchange(this.id)"> </td>
                            <td id="cell333" onclick="colorchange(this.id)"> </td>
                            <td id="cell334" onclick="colorchange(this.id)"> </td>
                            <td id="cell335" onclick="colorchange(this.id)"> </td>
                            <td id="cell336" onclick="colorchange(this.id)"> </td>
                        </tr>

                    </table>

                    <table id="timetable-5" class="myTable container-fluid tab-pane fade">
                        
                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>
                    </table>

                    <table id="timetable-6" class="myTable container-fluid tab-pane fade">

                        <tr>
                            <?php if ($mobile): ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>

                            <?php else: ?>
                                <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Monday<center></th>
                                <th><center>Tuesday<center></th>
                                <th><center>Wednesday<center></th>
                                <th><center>Thursday<center></th>
                                <th><center>Friday<center></th>
                                <th><center>Saturday<center></th>
                                <th><center>Sunday<center></th>

                            <?php endif; ?>
                        </tr>
                    </table>

                </div>

                <br>

                
                <?php $row = $usertimes->row(); ?>
                
                <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px; margin-top: 10px;">
   
                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: -25px; ">
                            <div class = "text-center col-xs-12 col-md-6 col-sm-offset-2 col-sm-6 form-group register-field" style = "font-size:14px;">
                                
                                <a id = "notif-btn"  href="#">
                                    <h4 class = "no-padding text-info" onclick="clearTable();" style = "margin-top: 10px;">Clear All Timeslots</h4>
                                </a>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">Clear entire table</p>
                                
                                <br>
                            </div>
                        </div>
                    </li>

                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: -25px; ">
                            <div class = "text-center col-xs-12 col-md-6 col-sm-offset-2 col-sm-6 form-group register-field" style = "font-size:14px;">
                                
                                <a id = "notif-btn"  href="#">
                                    <h4 class = "no-padding text-info" onclick="fullTable();" style = "margin-top: 10px;">Fill All Timeslots</h4>
                                </a>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">Fill entire table</p>
                                
                                <br>
                            </div>
                        </div>
                    </li>

                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: 10px; ">
                            <div class = "text-center col-xs-12 col-md-8 col-sm-offset-1 col-sm-8 form-group register-field" style = "font-size:14px;">
                                
                                <!-- <a id = "notif-btn" data-toggle = "modal" href="#default-time-modal">
                                    <h4 class = "no-padding text-info" style = "margin-top: 10px;">Use Default Settings</h4>
                                </a> -->

                                <a id = "notif-btn" href="#">
                                    <h4 class = "no-padding text-info" onclick="defaultTable();" style = "margin-top: 10px;">Use Mukhlat's Default Settings</h4>
                                </a>

                                <!-- <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">Use Mukhlat's default settings of:<br></p> -->
                                    
                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">
                                    <b><u>Monday-Friday:</u> </b><br>05:30PM - 07:30PM<br>08:00PM - 08:30PM
                                </p>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">
                                    <b><u>Saturday:</u> </b><br>01:00PM - 06:00PM<br>08:00PM - 09:00PM
                                </p>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">
                                    <b><u>Sunday:</u> </b><br>09:00AM - 12:00PM<br>05:00PM - 07:00PM
                                </p>
                                    
                                
                            </div>
                        </div>
                    </li>

                    <!-- <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: 10px; margin-top: 0px;">
                            
                            <div class = "text-center col-xs-12 col-md-auto col-sm-offset-1 col-sm-8 form-group register-field" style = "font-size:14px;">
                                
                                <div class="checkbox">
                                    <h4><label class = "text-info"><input type="checkbox" id="keep" value="" >Keep for next week</label></h4>
                                </div>

                                <p class = "no-padding " style = "margin-bottom: 15px; margin-top: 5px;">If you check this setting, Mukhlat will keep these settings for next week.<br><br>If you leave it unchecked, the settings will reset to the default settings at the start of the next week.</p>
                                
                                <br>
                            </div>
                        </div>
                    </li> -->
                </ul>
                    

            <?php //endforeach; ?>

                <div class = "text-center">
                    <a id = "confirm-btn" data-toggle = "modal">
                        <button onclick="updateSummary(); ifEmpty('time-table', 'td', 'cell'); " data-toggle = "modal" class = "btn btn-success container-fluid col-xs-12" style="font-size:24px; margin-top: 10px; margin-bottom: 0px">Save Changes</button>
                    </a>
                </div>
            </div>

        </div>    
    </div>

        <style> 
    
        #cookieConsent 
        {
            background-color: rgba(20,20,20,0.8);
            min-height: 26px;
            font-size: 15px;
            color: #FFFFFF;
            line-height: 26px;
            padding: 8px 0 8px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: none;
            z-index: 9999;
        }

        #cookieConsent a 
        {
            color: #269588;
            text-decoration: none;
        }

        #closeCookieConsent 
        {
            float: right;
            display: inline-block;
            cursor: pointer;
            height: 20px;
            width: 20px;
            margin: -15px 0 0 0;
        }

        #closeCookieConsent:hover 
        {
            color: #FFF;
        }

        #cookieConsent a.cookieConsentOK 
        {
            background-color: #269588;
            color: #FFFFFF;
            display: inline-block;
            border-radius: 5px;
            font-size: 18px;
            padding: 6px 20px;
            cursor: pointer;
            float: center;
        }

        #cookieConsent a.cookieConsentOK:hover 
        {
            background-color: #d6e4e1;
            color: #000000;
        }

    </style>

    

    <div id="cookieConsent" class="text-center">
        <div id="closeCookieConsent">x</div>
        <div class="col-md-10 col-sm-9 col-xs-12">
            To enhance you and your child's user experience, <i>Mukhlat</i> uses cookies.
            By continuing to use the website, you agree that we may store and access cookies on your device.
            You are free to disable cookies in your Web Browser's settings, but some features of Mukhlat may not work properly.<br> 

            <!-- <a href="#" target="_blank">(Click here for more info)</a> -->
        </div>

        <div class="col-md-2 col-sm-3 col-xs-12">
             <a class="cookieConsentOK" onclick="toogleCookieWarning();">I accept!</a>
        </div>
    </div>

    <script>
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

        function toogleCookieWarning()
        {
            if(getCookie("cookiewarning") == 0 || getCookie("cookiewarning")=="0")
            {
                document.cookie = "cookiewarning=1;" + ";path=/"; 
                // document.getElementById("cookiewarning").style.display= "none";
                document.getElementById("cookieConsent").style.display= "none";
                
            }
        }

        if(getCookie("cookiewarning") == 0 || getCookie("cookiewarning")=="0")
        {
            // document.getElementById("cookiewarning").style.display= "block";
            document.getElementById("cookieConsent").style.display= "block";
        }

        if(getCookie("cookiewarning") == 1 || getCookie("cookiewarning")=="1")
        {
            // document.getElementById("cookiewarning").style.display= "none";
            document.getElementById("cookieConsent").style.display= "none";
        }
    </script>

    
    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

</body>
<?php endforeach; ?>

<?php $row = $usertimes->row();?> 
    <script>

        var j;
        var readstring = "<?php echo $row->time_setting; ?>";
        var readarray = readstring.split(" ");
        var string, currentID;
        
        if(readstring!=null && readstring!="" && readstring!=" ")
        {
            for(j=0; j<readarray.length; j++)
            {
                // alert(readarray[j]);

                currentID = readarray[j].replace("-A","");

                document.getElementById(currentID).style.background = "rgb(50, 200, 100)";
                document.getElementById(currentID).id = readarray[j];
            }
        }


        //keep settings
        // var keep = parseInt("<?php echo $row->keep; ?>");

        // if(keep==1)
        //     document.getElementById("keep").checked = true;

        // else
        //     document.getElementById("keep").checked = false;


        //use limit
        var limit = parseInt("<?php echo $row->use_limit; ?>");
        switch(limit)
        {
            case 0:document.getElementById("time-limit").options[0].selected = true;break;
            case 30:document.getElementById("time-limit").options[1].selected = true;break;
            case 60:document.getElementById("time-limit").options[2].selected = true;break;
            case 90:document.getElementById("time-limit").options[3].selected = true;break;
            case 120:document.getElementById("time-limit").options[4].selected = true;break;
            case 150:document.getElementById("time-limit").options[5].selected = true;break;
            case 180:document.getElementById("time-limit").options[6].selected = true;break;
            case 210:document.getElementById("time-limit").options[7].selected = true;break;
            case 240:document.getElementById("time-limit").options[8].selected = true;break;
        }
        

        // var warning = parseInt("<?//php echo $row->warning; ?>");
        // switch(warning)
        // {
        //     case 0:document.getElementById("time-warning").options[0].selected = true;break;
        //     case 15:document.getElementById("time-warning").options[1].selected = true;break;
        //     case 30:document.getElementById("time-warning").options[2].selected = true;break;
        //     case 45:document.getElementById("time-warning").options[3].selected = true;break;
        //     case 60:document.getElementById("time-warning").options[4].selected = true;break;
        // }

        function changeTimeSettings(container, selectorTag, prefix) 
        {
            var i, items = [];
            var cell = document.getElementById(container).getElementsByTagName(selectorTag);
            
            for (var i = 0; i < cell.length; i++) 
            {
                if(cell[i].id.includes("-A"))
                {
                    items.push(cell[i].id);
                    // alert(cell[i].id);
                }
            }

            string = items.join(" ");

            // alert(string);
            document.cookie = "timeSetting=" + string + ";path=/";

            document.cookie = "updatetime=1;path=/";

            // var warning = document.getElementById("time-warning");
            // var selectedWarning = warning.options[warning.selectedIndex].value;
            // document.cookie = "selectedWarning=" + selectedWarning + ";path=/";   

            var limit = document.getElementById("time-limit");
            var selectedLimit = limit.options[limit.selectedIndex].value;
            document.cookie = "selectedLimit=" + selectedLimit + ";path=/"; 


            // if(document.getElementById("keep").checked)
            //     document.cookie = "selectedKeep=1;path=/";

            // else
            //     document.cookie = "selectedKeep=0;path=/";


            if(string==null || string=="" || string==" ")
                alert('empty');

            else
            {
                location.reload();

                <?php 
                    if($_COOKIE["updatetime"])
                        echo $CI->user_model->set_usertimes($child->user_id, 0);
                ?>
            }
            
        }

        
        function ifEmpty(container, selectorTag, prefix) 
        {
            var i, late, items = [];
            var cell = document.getElementById(container).getElementsByTagName(selectorTag);
            
            for (var i = 0; i < cell.length; i++) 
            {
                if(cell[i].id.includes("-A"))
                {
                    items.push(cell[i].id);
                    // alert(cell[i].id);

                    if(parseInt(cell[i].id.replace("cell","").replace("-A","")) < 64 ||  parseInt(cell[i].id.replace("cell","").replace("-A","")) > 294)
                    {
                        late=1;
                        // alert("yo u late");
                    }
                }
            }

            string = items.join(" ");

            // alert(string);

            if(string==null || string=="" || string==" ")
                $("#empty-modal").modal();

            else if(late==1)
            {
                document.getElementById("save-settings").style.display = "block";
                $("#child-settings-summary-modal").modal();

            }

            else
            {
                document.getElementById("save-settings").style.display = "none";
                $("#child-settings-summary-modal").modal();

            }   
        }

    </script>
<?php //endforeach; 

    include(APPPATH . 'views/modals/child_settings_summary_modal.php');
    include(APPPATH . 'views/modals/empty_warning_modal.php');
    include(APPPATH . 'views/modals/late_warning_modal.php');
    include(APPPATH . 'views/modals/default_time_modal.php');
    include(APPPATH . 'views/modals/logout_confirm_modal_parents.php');

?>

</html>
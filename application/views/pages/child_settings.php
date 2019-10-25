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

    if($CI->user_model->isParent($logged_user->user_id,$id) == 999)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    //get children for navbar
    $children_display = $CI->user_model->view_child($logged_user->user_id);

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
        // echo "<b>Successful query!</b><br><b></b>";
        foreach ($usertimes->result() as $row)
        {
            // echo $row->time_setting;
            // echo "<p style='color:white;'>" . $row->start_hour . ":" . $row->start_minute . "-" . $row->end_hour . ":" . $row->end_minute . "</p>";
        }

        // echo "<p style='color:white;'><b>Current time:</b> " . (int) date("G") . ": " . date("i") . "</p> " ;
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
    }

    .myTable 
    { 

        <?php if ($mobile): ?>
            background-color: #f9f9f9;

        <?php else: ?>
            background: rgb(255,255,255);
            
        <?php endif; ?>

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
        border: 2px solid; 
    }

    .myTable th 
    { 
        width: 5%;
        padding: 3px;
        border: 2px solid black; 
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
    document.cookie = "selectedKeep=1;path=/"; 
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

                    <li><span style="margin-left: 10px"> Children: </span>  
                    </li>

                    <?php foreach ($children_display->result() as $children):$data['user'] = $CI->user_model->get_user(true, true, array('user_id' =>  $children->user_id));?>

                    <li><a href="<?php echo base_url('parents/settings/' . $children->user_id); ?>"><i class = "fa fa-user" style="color:green"></i> <?php echo $children->first_name ?> </a></li>    
                    <?php endforeach; ?>

                    <li><span style="color:white">______</span></li>
                    
                    <li><a href="<?php echo base_url('signin/logout');?>"><i class = "glyphicon glyphicon-log-out" style="color:red"></i> Logout</a></li>

                </ul>
            </li>
        </ul>

    <?php else: ?>
        <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>
                        
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


<?php if($mobile):?>
    <!-- <script>alert('mobile!');</script> -->
    <style>

        body.sign-in
        {
            background-image: none;
            background-color: #f9f9f9;
            font-family: 'Cabin', 'Muli', sans-serif;
            height: 500px;
        }


        div.content-container{
            border:0px;
            background-color: #f9f9f9;
        }

    </style>
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

                function defaultTable() 
                {

                    clearTable();

                    if(document.getElementById("keep").checked == false)
                        document.getElementById("keep").checked = true;

                    document.getElementById("time-limit").options[3].selected = true;

                    document.getElementById("time-warning").options[2].selected = true;
                    
                    var i, temp, string ="cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A";

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

            <div class = "col-md-12 col-sm-14 col-xs-16 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 1vw;"><br>

                <div class = "content-container container-fluid " style = "margin-bottom: 4.5px;">

                    <div class = "col-xs-12 form-group register-field" style = "">
                        <h3 class = "col-xs-12 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Settings for <b><?php echo $child->first_name ?></b></strong></h3>
                        
                    </div>

                    <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px; margin-top: 10px;">
   
                    <li class = "active text-center">
                        <h3 class = "no-padding text-info" style = "margin-top: 10px;">Warning</h3>
                        
                        <select style="width:100px; height:20px" id="time-warning" onclick=""> 
                            <option value="0">None</option>
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">1 hour</option>
                        </select>

                        <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">(Set when children will be warned)</p>
                    </li>

                    <li class = "active text-center">
                        <h3 class = "no-padding text-info" style = "margin-top: 15px;">Time Limit</h3>
                            <!-- <?php echo $row->use_limit?> -->

                        <select style="width:110px; height:20px" id="time-limit" onclick="">

                            <option value="30">30 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="90">1 hr 30 mins</option>
                            <option value="120">2 hours</option>
                            <option value="150">2 hrs 30 mins</option>
                            <option value="180">3 hours</option>
                            <option value="210">3 hrs 30 mins</option>
                            <option value="240">4 hours</option>
                        </select>

                        <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">(Set how long children can use Mukhlat)</p>
                    </li>
                </ul><br>

                    <div class = "content-container container-fluid col-md-10 col-md-offset-1 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                        <ul class="nav nav-pills nav-justified" style="">
                            <li class=""><a data-toggle="pill" href="#timetable-1">Early Dawn</a></li>
                            <li class=""><a data-toggle="pill" href="#timetable-2">Early Morning</a></li>
                            <li class="active"><a data-toggle="pill" href="#timetable-3">Morning</a></li>
                            <li class=""><a data-toggle="pill" href="#timetable-4">Afternoon</a></li>
                            <li class=""><a data-toggle="pill" href="#timetable-5">Night</a></li>
                            <li class=""><a data-toggle="pill" href="#timetable-6">Late Night</a></li>
                            
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
                 <div id="time-table" class="container-fluid tab-content col-xs-16">

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
                            <td id="_cell1" class="timecol"><center>12:00</center></td>
                            <td id="cell1" onclick="colorchange(this.id)"> </td>
                            <td id="cell2" onclick="colorchange(this.id)"> </td>
                            <td id="cell3" onclick="colorchange(this.id)"> </td>
                            <td id="cell4" onclick="colorchange(this.id)"> </td>
                            <td id="cell5" onclick="colorchange(this.id)"> </td>
                            <td id="cell6" onclick="colorchange(this.id)"> </td>
                            <td id="cell7" onclick="colorchange(this.id)"> </td>
                        </tr>
                        <tr>
                            <td id="_cell8" class="timecol"><center>12:30</center></td>
                            <td id="cell8" onclick="colorchange(this.id)"> </td>
                            <td id="cell9" onclick="colorchange(this.id)"> </td>
                            <td id="cell10" onclick="colorchange(this.id)"> </td>
                            <td id="cell11" onclick="colorchange(this.id)"> </td>
                            <td id="cell12" onclick="colorchange(this.id)"> </td>
                            <td id="cell13" onclick="colorchange(this.id)"> </td>
                            <td id="cell14" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="_cell15" class="timecol"><center>01:00</center></td>
                            <td id="cell15" onclick="colorchange(this.id)"> </td>
                            <td id="cell16" onclick="colorchange(this.id)"> </td>
                            <td id="cell17" onclick="colorchange(this.id)"> </td>
                            <td id="cell18" onclick="colorchange(this.id)"> </td>
                            <td id="cell19" onclick="colorchange(this.id)"> </td>
                            <td id="cell20" onclick="colorchange(this.id)"> </td>
                            <td id="cell21" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="_cell22" class="timecol"><center>01:30</center></td>
                            <td id="cell22" onclick="colorchange(this.id)"> </td>
                            <td id="cell23" onclick="colorchange(this.id)"> </td>
                            <td id="cell24" onclick="colorchange(this.id)"> </td>
                            <td id="cell25" onclick="colorchange(this.id)"> </td>
                            <td id="cell26" onclick="colorchange(this.id)"> </td>
                            <td id="cell27" onclick="colorchange(this.id)"> </td>
                            <td id="cell28" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="" class="timecol" ><center>02:00</center></td>
                            <td id="cell29" onclick="colorchange(this.id)"> </td>
                            <td id="cell30" onclick="colorchange(this.id)"> </td>
                            <td id="cell31" onclick="colorchange(this.id)"> </td>
                            <td id="cell32" onclick="colorchange(this.id)"> </td>
                            <td id="cell33" onclick="colorchange(this.id)"> </td>
                            <td id="cell34" onclick="colorchange(this.id)"> </td>
                            <td id="cell35" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="" class="timecol" ><center>02:30</center></td>
                            <td id="cell36" onclick="colorchange(this.id)"> </td>
                            <td id="cell37" onclick="colorchange(this.id)"> </td>
                            <td id="cell38" onclick="colorchange(this.id)"> </td>
                            <td id="cell39" onclick="colorchange(this.id)"> </td>
                            <td id="cell40" onclick="colorchange(this.id)"> </td>
                            <td id="cell41" onclick="colorchange(this.id)"> </td>
                            <td id="cell42" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>03:00</center></td>
                            <td id="cell43" onclick="colorchange(this.id)"> </td>
                            <td id="cell44" onclick="colorchange(this.id)"> </td>
                            <td id="cell45" onclick="colorchange(this.id)"> </td>
                            <td id="cell46" onclick="colorchange(this.id)"> </td>
                            <td id="cell47" onclick="colorchange(this.id)"> </td>
                            <td id="cell48" onclick="colorchange(this.id)"> </td>
                            <td id="cell49" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>03:30</center></td>
                            <td id="cell50" onclick="colorchange(this.id)"> </td>
                            <td id="cell51" onclick="colorchange(this.id)"> </td>
                            <td id="cell52" onclick="colorchange(this.id)"> </td>
                            <td id="cell53" onclick="colorchange(this.id)"> </td>
                            <td id="cell54" onclick="colorchange(this.id)"> </td>
                            <td id="cell55" onclick="colorchange(this.id)"> </td>
                            <td id="cell56" onclick="colorchange(this.id)"> </td>
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
                            <td class="timecol" ><center>04:00</center></td>
                            <td id="cell57" onclick="colorchange(this.id)"> </td>
                            <td id="cell58" onclick="colorchange(this.id)"> </td>
                            <td id="cell59" onclick="colorchange(this.id)"> </td>
                            <td id="cell60" onclick="colorchange(this.id)"> </td>
                            <td id="cell61" onclick="colorchange(this.id)"> </td>
                            <td id="cell62" onclick="colorchange(this.id)"> </td>
                            <td id="cell63" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>04:30</center></td>
                            <td id="cell64" onclick="colorchange(this.id)"> </td>
                            <td id="cell65" onclick="colorchange(this.id)"> </td>
                            <td id="cell66" onclick="colorchange(this.id)"> </td>
                            <td id="cell67" onclick="colorchange(this.id)"> </td>
                            <td id="cell68" onclick="colorchange(this.id)"> </td>
                            <td id="cell69" onclick="colorchange(this.id)"> </td>
                            <td id="cell70" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>05:00</center></td>
                            <td id="cell71" onclick="colorchange(this.id)"> </td>
                            <td id="cell72" onclick="colorchange(this.id)"> </td>
                            <td id="cell73" onclick="colorchange(this.id)"> </td>
                            <td id="cell74" onclick="colorchange(this.id)"> </td>
                            <td id="cell75" onclick="colorchange(this.id)"> </td>
                            <td id="cell76" onclick="colorchange(this.id)"> </td>
                            <td id="cell77" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>05:30</center></td>
                            <td id="cell78" onclick="colorchange(this.id)"> </td>
                            <td id="cell79" onclick="colorchange(this.id)"> </td>
                            <td id="cell80" onclick="colorchange(this.id)"> </td>
                            <td id="cell81" onclick="colorchange(this.id)"> </td>
                            <td id="cell82" onclick="colorchange(this.id)"> </td>
                            <td id="cell83" onclick="colorchange(this.id)"> </td>
                            <td id="cell84" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>06:00</center></td>
                            <td id="cell85" onclick="colorchange(this.id)"> </td>
                            <td id="cell86" onclick="colorchange(this.id)"> </td>
                            <td id="cell87" onclick="colorchange(this.id)"> </td>
                            <td id="cell88" onclick="colorchange(this.id)"> </td>
                            <td id="cell89" onclick="colorchange(this.id)"> </td>
                            <td id="cell90" onclick="colorchange(this.id)"> </td>
                            <td id="cell91" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="_cell92" class="timecol" ><center>06:30</center></td>
                            <td id="cell92" onclick="colorchange(this.id)"> </td>
                            <td id="cell93" onclick="colorchange(this.id)"> </td>
                            <td id="cell94" onclick="colorchange(this.id)"> </td>
                            <td id="cell95" onclick="colorchange(this.id)"> </td>
                            <td id="cell96" onclick="colorchange(this.id)"> </td>
                            <td id="cell97" onclick="colorchange(this.id)"> </td>
                            <td id="cell98" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td id="_cell99"  class="timecol" ><center>07:00</center></td>
                            <td id="cell99" onclick="colorchange(this.id)"> </td>
                            <td id="cell100" onclick="colorchange(this.id)"> </td>
                            <td id="cell101" onclick="colorchange(this.id)"> </td>
                            <td id="cell102" onclick="colorchange(this.id)"> </td>
                            <td id="cell103" onclick="colorchange(this.id)"> </td>
                            <td id="cell104" onclick="colorchange(this.id)"> </td>
                            <td id="cell105" onclick="colorchange(this.id)"> </td>
                        </tr>                        

                        
                        <tr>
                            <td id="_cell106" class="timecol" onclick=""><center>07:30</center></td>
                            <td id="cell106" onclick="colorchange(this.id)"> </td>
                            <td id="cell107" onclick="colorchange(this.id)"> </td>
                            <td id="cell108" onclick="colorchange(this.id)"> </td>
                            <td id="cell109" onclick="colorchange(this.id)"> </td>
                            <td id="cell110" onclick="colorchange(this.id)"> </td>
                            <td id="cell111" onclick="colorchange(this.id)"> </td>
                            <td id="cell112" onclick="colorchange(this.id)"> </td>
                        </tr>
    

                    </table>

                    <table id="timetable-3" class="myTable container-fluid tab-pane fade  in active">
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
                            <td class="timecol" ><center>08:00</center></td>
                            <td id="cell113" onclick="colorchange(this.id)"> </td>
                            <td id="cell114" onclick="colorchange(this.id)"> </td>
                            <td id="cell115" onclick="colorchange(this.id)"> </td>
                            <td id="cell116" onclick="colorchange(this.id)"> </td>
                            <td id="cell117" onclick="colorchange(this.id)"> </td>
                            <td id="cell118" onclick="colorchange(this.id)"> </td>
                            <td id="cell119" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>08:30</center></td>
                            <td id="cell120" onclick="colorchange(this.id)"> </td>
                            <td id="cell121" onclick="colorchange(this.id)"> </td>
                            <td id="cell122" onclick="colorchange(this.id)"> </td>
                            <td id="cell123" onclick="colorchange(this.id)"> </td>
                            <td id="cell124" onclick="colorchange(this.id)"> </td>
                            <td id="cell125" onclick="colorchange(this.id)"> </td>
                            <td id="cell126" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>09:00</center></td>
                            <td id="cell127" onclick="colorchange(this.id)"> </td>
                            <td id="cell128" onclick="colorchange(this.id)"> </td>
                            <td id="cell129" onclick="colorchange(this.id)"> </td>
                            <td id="cell130" onclick="colorchange(this.id)"> </td>
                            <td id="cell131" onclick="colorchange(this.id)"> </td>
                            <td id="cell132" onclick="colorchange(this.id)"> </td>
                            <td id="cell133" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>09:30</center></td>
                            <td id="cell134" onclick="colorchange(this.id)"> </td>
                            <td id="cell135" onclick="colorchange(this.id)"> </td>
                            <td id="cell136" onclick="colorchange(this.id)"> </td>
                            <td id="cell137" onclick="colorchange(this.id)"> </td>
                            <td id="cell138" onclick="colorchange(this.id)"> </td>
                            <td id="cell139" onclick="colorchange(this.id)"> </td>
                            <td id="cell140" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>10:00</center></td>
                            <td id="cell141" onclick="colorchange(this.id)"> </td>
                            <td id="cell142" onclick="colorchange(this.id)"> </td>
                            <td id="cell143" onclick="colorchange(this.id)"> </td>
                            <td id="cell144" onclick="colorchange(this.id)"> </td>
                            <td id="cell145" onclick="colorchange(this.id)"> </td>
                            <td id="cell146" onclick="colorchange(this.id)"> </td>
                            <td id="cell147" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>10:30</center></td>
                            <td id="cell148" onclick="colorchange(this.id)"> </td>
                            <td id="cell149" onclick="colorchange(this.id)"> </td>
                            <td id="cell150" onclick="colorchange(this.id)"> </td>
                            <td id="cell151" onclick="colorchange(this.id)"> </td>
                            <td id="cell152" onclick="colorchange(this.id)"> </td>
                            <td id="cell153" onclick="colorchange(this.id)"> </td>
                            <td id="cell154" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>11:00</center></td>
                            <td id="cell155" onclick="colorchange(this.id)"> </td>
                            <td id="cell156" onclick="colorchange(this.id)"> </td>
                            <td id="cell157" onclick="colorchange(this.id)"> </td>
                            <td id="cell158" onclick="colorchange(this.id)"> </td>
                            <td id="cell159" onclick="colorchange(this.id)"> </td>
                            <td id="cell160" onclick="colorchange(this.id)"> </td>
                            <td id="cell161" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>11:30</center></td>
                            <td id="cell162" onclick="colorchange(this.id)"> </td>
                            <td id="cell163" onclick="colorchange(this.id)"> </td>
                            <td id="cell164" onclick="colorchange(this.id)"> </td>
                            <td id="cell165" onclick="colorchange(this.id)"> </td>
                            <td id="cell166" onclick="colorchange(this.id)"> </td>
                            <td id="cell167" onclick="colorchange(this.id)"> </td>
                            <td id="cell168" onclick="colorchange(this.id)"> </td>
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
                            <td class="timecol" ><center>12:00</center></td>
                            <td id="cell169" onclick="colorchange(this.id)"> </td>
                            <td id="cell170" onclick="colorchange(this.id)"> </td>
                            <td id="cell171" onclick="colorchange(this.id)"> </td>
                            <td id="cell172" onclick="colorchange(this.id)"> </td>
                            <td id="cell173" onclick="colorchange(this.id)"> </td>
                            <td id="cell174" onclick="colorchange(this.id)"> </td>
                            <td id="cell175" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>12:30</center></td>
                            <td id="cell176" onclick="colorchange(this.id)"> </td>
                            <td id="cell177" onclick="colorchange(this.id)"> </td>
                            <td id="cell178" onclick="colorchange(this.id)"> </td>
                            <td id="cell179" onclick="colorchange(this.id)"> </td>
                            <td id="cell180" onclick="colorchange(this.id)"> </td>
                            <td id="cell181" onclick="colorchange(this.id)"> </td>
                            <td id="cell182" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>01:00</center></td>
                            <td id="cell183" onclick="colorchange(this.id)"> </td>
                            <td id="cell184" onclick="colorchange(this.id)"> </td>
                            <td id="cell185" onclick="colorchange(this.id)"> </td>
                            <td id="cell186" onclick="colorchange(this.id)"> </td>
                            <td id="cell187" onclick="colorchange(this.id)"> </td>
                            <td id="cell188" onclick="colorchange(this.id)"> </td>
                            <td id="cell189" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>01:30</center></td>
                            <td id="cell190" onclick="colorchange(this.id)"> </td>
                            <td id="cell191" onclick="colorchange(this.id)"> </td>
                            <td id="cell192" onclick="colorchange(this.id)"> </td>
                            <td id="cell193" onclick="colorchange(this.id)"> </td>
                            <td id="cell194" onclick="colorchange(this.id)"> </td>
                            <td id="cell195" onclick="colorchange(this.id)"> </td>
                            <td id="cell196" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>02:00</center></td>
                            <td id="cell197" onclick="colorchange(this.id)"> </td>
                            <td id="cell198" onclick="colorchange(this.id)"> </td>
                            <td id="cell199" onclick="colorchange(this.id)"> </td>
                            <td id="cell200" onclick="colorchange(this.id)"> </td>
                            <td id="cell201" onclick="colorchange(this.id)"> </td>
                            <td id="cell202" onclick="colorchange(this.id)"> </td>
                            <td id="cell203" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>02:30</center></td>
                            <td id="cell204" onclick="colorchange(this.id)"> </td>
                            <td id="cell205" onclick="colorchange(this.id)"> </td>
                            <td id="cell206" onclick="colorchange(this.id)"> </td>
                            <td id="cell207" onclick="colorchange(this.id)"> </td>
                            <td id="cell208" onclick="colorchange(this.id)"> </td>
                            <td id="cell209" onclick="colorchange(this.id)"> </td>
                            <td id="cell210" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>03:00</center></td>
                            <td id="cell211" onclick="colorchange(this.id)"> </td>
                            <td id="cell212" onclick="colorchange(this.id)"> </td>
                            <td id="cell213" onclick="colorchange(this.id)"> </td>
                            <td id="cell214" onclick="colorchange(this.id)"> </td>
                            <td id="cell215" onclick="colorchange(this.id)"> </td>
                            <td id="cell216" onclick="colorchange(this.id)"> </td>
                            <td id="cell217" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>03:30</center></td>
                            <td id="cell218" onclick="colorchange(this.id)"> </td>
                            <td id="cell219" onclick="colorchange(this.id)"> </td>
                            <td id="cell220" onclick="colorchange(this.id)"> </td>
                            <td id="cell221" onclick="colorchange(this.id)"> </td>
                            <td id="cell222" onclick="colorchange(this.id)"> </td>
                            <td id="cell223" onclick="colorchange(this.id)"> </td>
                            <td id="cell224" onclick="colorchange(this.id)"> </td>
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

                        <tr>
                            <td class="timecol" ><center>04:00</center></td>
                            <td id="cell225" onclick="colorchange(this.id)"> </td>
                            <td id="cell226" onclick="colorchange(this.id)"> </td>
                            <td id="cell227" onclick="colorchange(this.id)"> </td>
                            <td id="cell228" onclick="colorchange(this.id)"> </td>
                            <td id="cell229" onclick="colorchange(this.id)"> </td>
                            <td id="cell230" onclick="colorchange(this.id)"> </td>
                            <td id="cell231" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>04:30</center></td>
                            <td id="cell232" onclick="colorchange(this.id)"> </td>
                            <td id="cell233" onclick="colorchange(this.id)"> </td>
                            <td id="cell234" onclick="colorchange(this.id)"> </td>
                            <td id="cell235" onclick="colorchange(this.id)"> </td>
                            <td id="cell236" onclick="colorchange(this.id)"> </td>
                            <td id="cell237" onclick="colorchange(this.id)"> </td>
                            <td id="cell238" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>05:00</center></td>
                            <td id="cell239" onclick="colorchange(this.id)"> </td>
                            <td id="cell240" onclick="colorchange(this.id)"> </td>
                            <td id="cell241" onclick="colorchange(this.id)"> </td>
                            <td id="cell242" onclick="colorchange(this.id)"> </td>
                            <td id="cell243" onclick="colorchange(this.id)"> </td>
                            <td id="cell244" onclick="colorchange(this.id)"> </td>
                            <td id="cell245" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>05:30</center></td>
                            <td id="cell246" onclick="colorchange(this.id)"> </td>
                            <td id="cell247" onclick="colorchange(this.id)"> </td>
                            <td id="cell248" onclick="colorchange(this.id)"> </td>
                            <td id="cell249" onclick="colorchange(this.id)"> </td>
                            <td id="cell250" onclick="colorchange(this.id)"> </td>
                            <td id="cell251" onclick="colorchange(this.id)"> </td>
                            <td id="cell252" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>06:00</center></td>
                            <td id="cell253" onclick="colorchange(this.id)"> </td>
                            <td id="cell254" onclick="colorchange(this.id)"> </td>
                            <td id="cell255" onclick="colorchange(this.id)"> </td>
                            <td id="cell256" onclick="colorchange(this.id)"> </td>
                            <td id="cell257" onclick="colorchange(this.id)"> </td>
                            <td id="cell258" onclick="colorchange(this.id)"> </td>
                            <td id="cell259" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>06:30</center></td>
                            <td id="cell260" onclick="colorchange(this.id)"> </td>
                            <td id="cell261" onclick="colorchange(this.id)"> </td>
                            <td id="cell262" onclick="colorchange(this.id)"> </td>
                            <td id="cell263" onclick="colorchange(this.id)"> </td>
                            <td id="cell264" onclick="colorchange(this.id)"> </td>
                            <td id="cell265" onclick="colorchange(this.id)"> </td>
                            <td id="cell266" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>07:00</center></td>
                            <td id="cell267" onclick="colorchange(this.id)"> </td>
                            <td id="cell268" onclick="colorchange(this.id)"> </td>
                            <td id="cell269" onclick="colorchange(this.id)"> </td>
                            <td id="cell270" onclick="colorchange(this.id)"> </td>
                            <td id="cell271" onclick="colorchange(this.id)"> </td>
                            <td id="cell272" onclick="colorchange(this.id)"> </td>
                            <td id="cell273" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>07:30</center></td>
                            <td id="cell274" onclick="colorchange(this.id)"> </td>
                            <td id="cell275" onclick="colorchange(this.id)"> </td>
                            <td id="cell276" onclick="colorchange(this.id)"> </td>
                            <td id="cell277" onclick="colorchange(this.id)"> </td>
                            <td id="cell278" onclick="colorchange(this.id)"> </td>
                            <td id="cell279" onclick="colorchange(this.id)"> </td>
                            <td id="cell280" onclick="colorchange(this.id)"> </td>
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

                        <tr>
                            <td class="timecol" ><center>08:00</center></td>
                            <td id="cell281" onclick="colorchange(this.id)"> </td>
                            <td id="cell282" onclick="colorchange(this.id)"> </td>
                            <td id="cell283" onclick="colorchange(this.id)"> </td>
                            <td id="cell284" onclick="colorchange(this.id)"> </td>
                            <td id="cell285" onclick="colorchange(this.id)"> </td>
                            <td id="cell286" onclick="colorchange(this.id)"> </td>
                            <td id="cell287" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>08:30</center></td>
                            <td id="cell288" onclick="colorchange(this.id)"> </td>
                            <td id="cell289" onclick="colorchange(this.id)"> </td>
                            <td id="cell290" onclick="colorchange(this.id)"> </td>
                            <td id="cell291" onclick="colorchange(this.id)"> </td>
                            <td id="cell292" onclick="colorchange(this.id)"> </td>
                            <td id="cell293" onclick="colorchange(this.id)"> </td>
                            <td id="cell294" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>09:00</center></td>
                            <td id="cell295" onclick="colorchange(this.id)"> </td>
                            <td id="cell296" onclick="colorchange(this.id)"> </td>
                            <td id="cell297" onclick="colorchange(this.id)"> </td>
                            <td id="cell298" onclick="colorchange(this.id)"> </td>
                            <td id="cell299" onclick="colorchange(this.id)"> </td>
                            <td id="cell300" onclick="colorchange(this.id)"> </td>
                            <td id="cell301" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>09:30</center></td>
                            <td id="cell302" onclick="colorchange(this.id)"> </td>
                            <td id="cell303" onclick="colorchange(this.id)"> </td>
                            <td id="cell304" onclick="colorchange(this.id)"> </td>
                            <td id="cell305" onclick="colorchange(this.id)"> </td>
                            <td id="cell306" onclick="colorchange(this.id)"> </td>
                            <td id="cell307" onclick="colorchange(this.id)"> </td>
                            <td id="cell308" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>10:00</center></td>
                            <td id="cell309" onclick="colorchange(this.id)"> </td>
                            <td id="cell310" onclick="colorchange(this.id)"> </td>
                            <td id="cell311" onclick="colorchange(this.id)"> </td>
                            <td id="cell312" onclick="colorchange(this.id)"> </td>
                            <td id="cell313" onclick="colorchange(this.id)"> </td>
                            <td id="cell314" onclick="colorchange(this.id)"> </td>
                            <td id="cell315" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>10:30</center></td>
                            <td id="cell316" onclick="colorchange(this.id)"> </td>
                            <td id="cell317" onclick="colorchange(this.id)"> </td>
                            <td id="cell318" onclick="colorchange(this.id)"> </td>
                            <td id="cell319" onclick="colorchange(this.id)"> </td>
                            <td id="cell320" onclick="colorchange(this.id)"> </td>
                            <td id="cell321" onclick="colorchange(this.id)"> </td>
                            <td id="cell322" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>11:00</center></td>
                            <td id="cell323" onclick="colorchange(this.id)"> </td>
                            <td id="cell324" onclick="colorchange(this.id)"> </td>
                            <td id="cell325" onclick="colorchange(this.id)"> </td>
                            <td id="cell326" onclick="colorchange(this.id)"> </td>
                            <td id="cell327" onclick="colorchange(this.id)"> </td>
                            <td id="cell328" onclick="colorchange(this.id)"> </td>
                            <td id="cell329" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" ><center>11:30</center></td>
                            <td id="cell330" onclick="colorchange(this.id)"> </td>
                            <td id="cell331" onclick="colorchange(this.id)"> </td>
                            <td id="cell332" onclick="colorchange(this.id)"> </td>
                            <td id="cell333" onclick="colorchange(this.id)"> </td>
                            <td id="cell334" onclick="colorchange(this.id)"> </td>
                            <td id="cell335" onclick="colorchange(this.id)"> </td>
                            <td id="cell336" onclick="colorchange(this.id)"> </td>
                        </tr>
                    </table>


                </div>

                <br><br>

                
                <?php foreach ($usertimes->result() as $row): ?>
                
                <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px; margin-top: 10px;">
   
                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: -25px;  ">
                            <div class = "text-center col-xs-12 col-md-12 form-group register-field" style = "font-size:14px;">
                                
                                <a id = "notif-btn"  href="#">
                                    <h4 class = "no-padding text-info" onclick="clearTable();" style = "margin-top: 10px;">Clear All Timeslots</h4>
                                </a>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">(Clear entire table)</p>
                                
                                <br>
                            </div>
                        </div>
                    </li>

                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: 10px  ">
                            <div class = "text-center col-xs-12 col-md-12 form-group register-field" style = "font-size:14px;">
                                
                                <!-- <a id = "notif-btn" data-toggle = "modal" href="#default-time-modal">
                                    <h4 class = "no-padding text-info" style = "margin-top: 10px;">Use Default Settings</h4>
                                </a> -->

                                <a id = "notif-btn" href="#">
                                    <h4 class = "no-padding text-info" onclick="defaultTable();" style = "margin-top: 10px;">Reset to Default Settings</h4>
                                </a>

                                <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">(Revert to the 8:00 AM - 8:00 PM setting)</p>
                                
                                <br>
                            </div>
                        </div>
                    </li>

                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: 10px; margin-top: 0px;">
                            
                            <div class = "text-center col-xs-12 col-md-12 form-group register-field" style = "font-size:14px;">
                                
                                <div class="checkbox">
                                    <h4><label class = "text-info"><input type="checkbox" id="keep" value="" >Keep for next week</label></h4>
                                </div>

                                <p class = "no-padding " style = "margin-bottom: 15px; margin-top: 5px;">(Carry these settings over to next week)</p>
                                
                                <br>
                            </div>
                        </div>
                    </li>
                </ul>
                    

            <?php endforeach; ?>

                <div class = "text-center">
                    <br>
                    <a id = "confirm-btn" data-toggle = "modal">
                        <button onclick="updateSummary(); ifEmpty('time-table', 'td', 'cell'); " data-toggle = "modal" class = "btn btn-success container-fluid col-xs-12" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">Save Changes</button>
                    </a>
                </div>
            </div>

        </div>    
    </div>
    
    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

</body>
<?php endforeach; ?>

<?php foreach ($usertimes->result() as $row):?>
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
        var keep = parseInt("<?php echo $row->keep; ?>");

        if(keep==1)
            document.getElementById("keep").checked = true;

        else
            document.getElementById("keep").checked = false;


        //use limit
        var limit = parseInt("<?php echo $row->use_limit; ?>");
        switch(limit)
        {
            case 30:document.getElementById("time-limit").options[0].selected = true;break;
            case 60:document.getElementById("time-limit").options[1].selected = true;break;
            case 90:document.getElementById("time-limit").options[2].selected = true;break;
            case 120:document.getElementById("time-limit").options[3].selected = true;break;
            case 150:document.getElementById("time-limit").options[4].selected = true;break;
            case 180:document.getElementById("time-limit").options[5].selected = true;break;
            case 210:document.getElementById("time-limit").options[6].selected = true;break;
            case 240:document.getElementById("time-limit").options[7].selected = true;break;
        }
        

        var warning = parseInt("<?php echo $row->warning; ?>");
        switch(warning)
        {
            case 0:document.getElementById("time-warning").options[0].selected = true;break;
            case 15:document.getElementById("time-warning").options[1].selected = true;break;
            case 30:document.getElementById("time-warning").options[2].selected = true;break;
            case 45:document.getElementById("time-warning").options[3].selected = true;break;
            case 60:document.getElementById("time-warning").options[4].selected = true;break;
        }

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

            var warning = document.getElementById("time-warning");
            var selectedWarning = warning.options[warning.selectedIndex].value;
            document.cookie = "selectedWarning=" + selectedWarning + ";path=/";   

            var limit = document.getElementById("time-limit");
            var selectedLimit = limit.options[limit.selectedIndex].value;
            document.cookie = "selectedLimit=" + selectedLimit + ";path=/"; 


            if(document.getElementById("keep").checked)
                document.cookie = "selectedKeep=1;path=/";

            else
                document.cookie = "selectedKeep=0;path=/";


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
                $("#confirm-modal").modal();

            }

            else
            {
                document.getElementById("save-settings").style.display = "none";
                $("#confirm-modal").modal();

            }   
        }

    </script>
<?php endforeach; 


    include(APPPATH . 'views/modals/confirm_modal.php');
    include(APPPATH . 'views/modals/empty_warning_modal.php');
    include(APPPATH . 'views/modals/late_warning_modal.php');
    include(APPPATH . 'views/modals/default_time_modal.php');


?>

</html>
<?php
    include(APPPATH . 'views/header.php');
    include(APPPATH . 'views/modals/confirm_modal.php');
    include(APPPATH . 'views/modals/empty_warning_modal.php');
    include(APPPATH . 'views/modals/default_time_modal.php');

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

    if($mobile):?>
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
<style>div.content-container{border:0px;}

    .myTable 
    { 
        width: 100%;
        text-align: left;
        background: rgb(249,249,249);
        border-collapse: collapse; 
    }

    .myTable th 
    { 
        background: rgb(100,100,100);
        color: white; 
        padding: 10px;
        border: 1px solid grey; 
    }

    .myTable td
    { 
        background: rgb(249,249,249);
        width: 6%;
        padding: 10px;
        border: 1px solid black; 
    }

    .myTable th 
    { 
        width: 6%;
        padding: 10px;
        border: 1px solid black; 
    }

    td.timecol
    {
        background: rgb(242,242,242);
    }

</style>

<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";
    document.cookie = "selectedWarning=0;path=/";   
    document.cookie = "selectedLimit=180;path=/"; 
    document.cookie = "selectedKeep=1;path=/"; 
    var ctr = 0;
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
                        document.getElementById(id).style.background = "rgb(249, 249, 249)";
                        document.getElementById(id).id = id.replace("-A","");
                    } 

                    else if(!id.includes("-A"))
                    {
                        document.getElementById(id).style.background = "rgb(50, 200, 100)";
                        document.getElementById(id).id = id + "-A";
                    }

                    // alert(id); 
                }

            </script>

            <div class = "col-md-12 col-sm-14 col-xs-16 col-md-offset-0 content-container container-fluid" style = "margin-bottom: 1vw;"><br>

                <div class = " content-container container-fluid" style = "margin-bottom: 4.5px;">

                    <div class = "col-xs-12 form-group register-field" style = "">
                        <h3 class = "col-xs-4 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Settings for <b><?php echo $child->first_name ?></b></strong></h3>

                        
                    </div>

                </div>

                 <!-- The table -->
                 <div class="container-fluid">
                    <table id="time-table" class="myTable container-fluid">
                        <tr >
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                            <th><center>S<center></th>
                            <th><center>M<center></th>
                            <th><center>T<center></th>
                            <th><center>W<center></th>
                            <th><center>T<center></th>
                            <th><center>F<center></th>
                            <th><center>S<center></th>
                        </tr>
                        <tr id="time-table1">
                            <td class="timecol" style="font-size: 12px"><center>06:00-07:00</center></td>
                            <td id="cell1" onclick="colorchange(this.id)"> </td>
                            <td id="cell2" onclick="colorchange(this.id)"> </td>
                            <td id="cell3" onclick="colorchange(this.id)"> </td>
                            <td id="cell4" onclick="colorchange(this.id)"> </td>
                            <td id="cell5" onclick="colorchange(this.id)"> </td>
                            <td id="cell6" onclick="colorchange(this.id)"> </td>
                            <td id="cell7" onclick="colorchange(this.id)"> </td>
                        </tr>
                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>07:00-08:00</center></td>
                            <td id="cell8" onclick="colorchange(this.id)"> </td>
                            <td id="cell9" onclick="colorchange(this.id)"> </td>
                            <td id="cell10" onclick="colorchange(this.id)"> </td>
                            <td id="cell11" onclick="colorchange(this.id)"> </td>
                            <td id="cell12" onclick="colorchange(this.id)"> </td>
                            <td id="cell13" onclick="colorchange(this.id)"> </td>
                            <td id="cell14" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>08:00-09:00</center></td>
                            <td id="cell15" onclick="colorchange(this.id)"> </td>
                            <td id="cell16" onclick="colorchange(this.id)"> </td>
                            <td id="cell17" onclick="colorchange(this.id)"> </td>
                            <td id="cell18" onclick="colorchange(this.id)"> </td>
                            <td id="cell19" onclick="colorchange(this.id)"> </td>
                            <td id="cell20" onclick="colorchange(this.id)"> </td>
                            <td id="cell21" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>09:00-10:00</center></td>
                            <td id="cell22" onclick="colorchange(this.id)"> </td>
                            <td id="cell23" onclick="colorchange(this.id)"> </td>
                            <td id="cell24" onclick="colorchange(this.id)"> </td>
                            <td id="cell25" onclick="colorchange(this.id)"> </td>
                            <td id="cell26" onclick="colorchange(this.id)"> </td>
                            <td id="cell27" onclick="colorchange(this.id)"> </td>
                            <td id="cell28" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>10:00-11:00</center></td>
                            <td id="cell29" onclick="colorchange(this.id)"> </td>
                            <td id="cell30" onclick="colorchange(this.id)"> </td>
                            <td id="cell31" onclick="colorchange(this.id)"> </td>
                            <td id="cell32" onclick="colorchange(this.id)"> </td>
                            <td id="cell33" onclick="colorchange(this.id)"> </td>
                            <td id="cell34" onclick="colorchange(this.id)"> </td>
                            <td id="cell35" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>11:00-12:00</center></td>
                            <td id="cell36" onclick="colorchange(this.id)"> </td>
                            <td id="cell37" onclick="colorchange(this.id)"> </td>
                            <td id="cell38" onclick="colorchange(this.id)"> </td>
                            <td id="cell39" onclick="colorchange(this.id)"> </td>
                            <td id="cell40" onclick="colorchange(this.id)"> </td>
                            <td id="cell41" onclick="colorchange(this.id)"> </td>
                            <td id="cell42" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>12:00-01:00</center></td>
                            <td id="cell43" onclick="colorchange(this.id)"> </td>
                            <td id="cell44" onclick="colorchange(this.id)"> </td>
                            <td id="cell45" onclick="colorchange(this.id)"> </td>
                            <td id="cell46" onclick="colorchange(this.id)"> </td>
                            <td id="cell47" onclick="colorchange(this.id)"> </td>
                            <td id="cell48" onclick="colorchange(this.id)"> </td>
                            <td id="cell49" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>01:00-02:00</center></td>
                            <td id="cell50" onclick="colorchange(this.id)"> </td>
                            <td id="cell51" onclick="colorchange(this.id)"> </td>
                            <td id="cell52" onclick="colorchange(this.id)"> </td>
                            <td id="cell53" onclick="colorchange(this.id)"> </td>
                            <td id="cell54" onclick="colorchange(this.id)"> </td>
                            <td id="cell55" onclick="colorchange(this.id)"> </td>
                            <td id="cell56" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>02:00-03:00</center></td>
                            <td id="cell57" onclick="colorchange(this.id)"> </td>
                            <td id="cell58" onclick="colorchange(this.id)"> </td>
                            <td id="cell59" onclick="colorchange(this.id)"> </td>
                            <td id="cell60" onclick="colorchange(this.id)"> </td>
                            <td id="cell61" onclick="colorchange(this.id)"> </td>
                            <td id="cell62" onclick="colorchange(this.id)"> </td>
                            <td id="cell63" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>03:00-04:00</center></td>
                            <td id="cell64" onclick="colorchange(this.id)"> </td>
                            <td id="cell65" onclick="colorchange(this.id)"> </td>
                            <td id="cell66" onclick="colorchange(this.id)"> </td>
                            <td id="cell67" onclick="colorchange(this.id)"> </td>
                            <td id="cell68" onclick="colorchange(this.id)"> </td>
                            <td id="cell69" onclick="colorchange(this.id)"> </td>
                            <td id="cell70" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>04:00-05:00</center></td>
                            <td id="cell71" onclick="colorchange(this.id)"> </td>
                            <td id="cell72" onclick="colorchange(this.id)"> </td>
                            <td id="cell73" onclick="colorchange(this.id)"> </td>
                            <td id="cell74" onclick="colorchange(this.id)"> </td>
                            <td id="cell75" onclick="colorchange(this.id)"> </td>
                            <td id="cell76" onclick="colorchange(this.id)"> </td>
                            <td id="cell77" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>05:00-06:00</center></td>
                            <td id="cell78" onclick="colorchange(this.id)"> </td>
                            <td id="cell79" onclick="colorchange(this.id)"> </td>
                            <td id="cell80" onclick="colorchange(this.id)"> </td>
                            <td id="cell81" onclick="colorchange(this.id)"> </td>
                            <td id="cell82" onclick="colorchange(this.id)"> </td>
                            <td id="cell83" onclick="colorchange(this.id)"> </td>
                            <td id="cell84" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>06:00-07:00</center></td>
                            <td id="cell85" onclick="colorchange(this.id)"> </td>
                            <td id="cell86" onclick="colorchange(this.id)"> </td>
                            <td id="cell87" onclick="colorchange(this.id)"> </td>
                            <td id="cell88" onclick="colorchange(this.id)"> </td>
                            <td id="cell89" onclick="colorchange(this.id)"> </td>
                            <td id="cell90" onclick="colorchange(this.id)"> </td>
                            <td id="cell91" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>07:00-08:00</center></td>
                            <td id="cell92" onclick="colorchange(this.id)"> </td>
                            <td id="cell93" onclick="colorchange(this.id)"> </td>
                            <td id="cell94" onclick="colorchange(this.id)"> </td>
                            <td id="cell95" onclick="colorchange(this.id)"> </td>
                            <td id="cell96" onclick="colorchange(this.id)"> </td>
                            <td id="cell97" onclick="colorchange(this.id)"> </td>
                            <td id="cell98" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>08:00-08:30</center></td>
                            <td id="cell99" onclick="colorchange(this.id)"> </td>
                            <td id="cell100" onclick="colorchange(this.id)"> </td>
                            <td id="cell101" onclick="colorchange(this.id)"> </td>
                            <td id="cell102" onclick="colorchange(this.id)"> </td>
                            <td id="cell103" onclick="colorchange(this.id)"> </td>
                            <td id="cell104" onclick="colorchange(this.id)"> </td>
                            <td id="cell105" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td class="timecol" style="font-size: 12px"><center>08:30-09:00</center></td>
                            <td id="cell106" onclick="colorchange(this.id)"> </td>
                            <td id="cell107" onclick="colorchange(this.id)"> </td>
                            <td id="cell108" onclick="colorchange(this.id)"> </td>
                            <td id="cell109" onclick="colorchange(this.id)"> </td>
                            <td id="cell110" onclick="colorchange(this.id)"> </td>
                            <td id="cell111" onclick="colorchange(this.id)"> </td>
                            <td id="cell112" onclick="colorchange(this.id)"> </td>
                        </tr>

                    </table>
                </div>

                <br><br>

                
                <?php foreach ($usertimes->result() as $row): ?>
                

                <div class = "text-center form-group register-field container-fluid" style="margin-bottom: -25px;  ">
                    <div class = "text-center col-xs-12 col-md-12 form-group register-field" style = "font-size:14px;">
                        
                        <a id = "notif-btn" data-toggle = "modal" href="#default-time-modal">
                            <h4 class = "no-padding text-info" style = "margin-top: 10px;">Use Default Settings</h4>
                        </a>

                        <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 0px;">(Use the default 8:00 AM - 8:00 PM setting)</p>
                        
                        <br>
                    </div>
                </div>
                    

                <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px; margin-top: 10px;">
   
                    <li class = "active text-center">
                        <h3 class = "no-padding text-info" style = "margin-top: 10px;"><br>Warning</h3>
                        
                        <select style="width:100px; height:20px" id="time-warning" onclick="">
                                
                            <?php if($row->warning != 0 &&$row->warning != 60): ?>
                                <option value="<?php echo $row->warning; ?>"><?php echo $row->warning; ?> minutes</option>
                            <?php endif; ?>

                            <?php if($row->warning == 60): ?>
                                <option value="<?php echo $row->warning; ?>">1 hour</option>
                            <?php endif; ?>

                            <option value="0">None</option>
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">1 hour</option>
                        </select>

                        <p class = "no-padding " style = "margin-bottom: 0px; margin-top: 15px;">(Set when children will be warned)</p>
                    </li>

                    <li class = "active text-center">
                        <h3 class = "no-padding text-info" style = "margin-top: 15px;"><br>Time Limit</h3>
                            <!-- <?php echo $row->use_limit?> -->

                        <select style="width:110px; height:20px" id="time-limit" onclick="">
                                
                            <?php if($row->use_limit== 60): ?>
                                <option value="60">1 hour</option>

                            <?php elseif($row->use_limit== 90): ?>
                                <option value="90">1 hour 30 mins</option>

                            <?php elseif($row->use_limit== 120): ?>
                                <option value="120">2 hours</option>

                            <?php elseif($row->use_limit== 150): ?>
                                <option value="150">2 hours 30 mins</option>

                            <?php elseif($row->use_limit== 180): ?>
                                <option value="180">3 hours</option>

                            <?php elseif($row->use_limit== 210): ?>
                                <option value="210">3 hours 30 mins</option>

                            <?php elseif($row->use_limit== 240): ?>
                                <option value="240">4 hours</option>

                            <?php endif; ?>

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

                    <li class = "active text-center">
                        <div class = "text-center form-group register-field container-fluid" style="margin-bottom: 10px; margin-top: 15px;">
                            <div class = "col-xs-12 col-md-12 form-group register-field" style = "font-size:14px;"><br>
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
                    <br><br><br>
                    <a id = "confirm-btn" data-toggle = "modal">
                        <button onclick="ifEmpty('time-table', 'td', 'cell');" data-toggle = "modal" class = "btn btn-success container-fluid col-xs-12" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">Save Changes</button>
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
        var keep = "<?php echo $row->keep; ?>"
        

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

        // alert(keep);

        if(keep=='1')
            document.getElementById("keep").checked = true;

        else
            document.getElementById("keep").checked = false;
        

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

        function setDefaultTime() 
        {
            var string = "cell15-A cell16-A cell17-A cell18-A cell19-A cell20-A cell21-A cell22-A cell23-A cell24-A cell25-A cell26-A cell27-A cell28-A cell29-A cell30-A cell31-A cell32-A cell33-A cell34-A cell35-A cell36-A cell37-A cell38-A cell39-A cell40-A cell41-A cell42-A cell43-A cell44-A cell45-A cell46-A cell47-A cell48-A cell49-A cell50-A cell51-A cell52-A cell53-A cell54-A cell55-A cell56-A cell57-A cell58-A cell59-A cell60-A cell61-A cell62-A cell63-A cell64-A cell65-A cell66-A cell67-A cell68-A cell69-A cell70-A cell71-A cell72-A cell73-A cell74-A cell75-A cell76-A cell77-A cell78-A cell79-A cell80-A cell81-A cell82-A cell83-A cell84-A cell85-A cell86-A cell87-A cell88-A cell89-A cell90-A cell91-A cell92-A cell93-A cell94-A cell95-A cell96-A cell97-A cell98-A";   

            document.cookie = "timeSetting=" + string + ";path=/";

            document.cookie = "selectedWarning=30;path=/"; 

            document.cookie = "selectedLimit=180;path=/"; 

            document.cookie = "selectedKeep=1;path=/"; 

            document.cookie = "updatetime=1;path=/";

            <?php 
                if($_COOKIE["updatetime"])
                    echo $CI->user_model->set_usertimes($child->user_id, 0);
            ?>

            location.reload();
        }

        function ifEmpty(container, selectorTag, prefix) 
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

            if(string==null || string=="" || string==" ")
                $("#empty-modal").modal();

            else
                $("#confirm-modal").modal();
        }

    </script>
<?php endforeach; ?>

</html>
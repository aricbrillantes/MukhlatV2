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

    // print_r($children_display);

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
        // echo "<b>Successful query!</b><br><b>Allowed times:</b>";
        foreach ($usertimes->result() as $row)
        {
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


<?php 
   
    // parse_str(htmlspecialchars($_COOKIE["sunTime"]));
    // echo $hour;

?>

<style>div.content-container{border:0px;}</style>

<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";
    var ctr = 0;

    document.cookie = "selectedWarning=0;path=/";   

    document.cookie = "selectedHour1-0=0;path=/";   
    document.cookie = "selectedMinute1-0=0;path=/"; 
    document.cookie = "selectedMeridian1-0=0;path=/"; 

    document.cookie = "selectedHour2-0=0;path=/";   
    document.cookie = "selectedMinute2-0=0;path=/"; 
    document.cookie = "selectedMeridian2-0=0;path=/";   

    document.cookie = "basicTime1=0;path=/"; 
    document.cookie = "basicTime2=0;path=/";

    document.cookie = "1_sunTime1=0;path=/"; 
    document.cookie = "1_sunTime2=0;path=/";

    document.cookie = "2_monTime1=0;path=/"; 
    document.cookie = "2_monTime2=0;path=/";

    document.cookie = "3_tueTime1=0;path=/"; 
    document.cookie = "3_tueTime2=0;path=/";

    document.cookie = "4_wedTime1=0;path=/"; 
    document.cookie = "4_wedTime2=0;path=/";

    document.cookie = "5_thuTime1=0;path=/"; 
    document.cookie = "5_thuTime2=0;path=/";

    document.cookie = "6_friTime1=0;path=/"; 
    document.cookie = "6_friTime2=0;path=/";

    document.cookie = "7_satTime1=0;path=/"; 
    document.cookie = "7_satTime2=0;path=/";
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            
            
        <?php if (!$mobile): ?>

            <ul class = "nav navbar-nav navbar-right pull-right" style = "margin-right: 5px;">
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img class = "img-rounded nav-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/> 
                        <?php echo $logged_user->first_name . " " . $logged_user->last_name; ?>
                        
                        <span class="caret"></span>
                    </a>                 
                
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><i class = "fa fa-user"></i> My Profile</a></li> -->
                        
                        <?php foreach ($children_display->result() as $children):$data['user'] = $CI->user_model->get_user(true, true, array('user_id' =>  $children->user_id));?>

                        <li><a href="<?php echo base_url('parents/settings/' . $children->user_id); ?>"><i class = "fa fa-user" style="color:green"></i> <?php echo $children->first_name . " " . $children->last_name ?></a></li>    
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

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 4.5px;"><br>

                <div class = "col-xs-12 form-group register-field" style = "">

                    <h3 class = "col-xs-16 col-sm-4 col-md-4 no-padding text-info "style = "margin-bottom: 0px; margin-top: 0px;">Settings for <strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>

                    <a href="<?php echo base_url('parents/advanced/' . $child->user_id) ?>">
                    
                    <?php if ($mobile): ?>
                        <br><br><h3 class = "col-xs-8 col-sm-4 col-md-4 no-padding text-info"style = "margin-bottom: 0px; margin-top: 0px;"><u>Advanced Settings</u></strong></h3>
                         
                    <?php else: ?>
                        <h3 class = "col-xs-8 col-sm-4 col-md-4 no-padding text-info pull-right"style = "margin-bottom: 0px; margin-top: 0px;"><u>Advanced Settings</u></strong></h3>
                        
                    <?php endif; ?>
                    
                    </a>
                </div>

            </div>

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 1vw;"><br>

                <?php foreach ($usertimes->result() as $row): 
                    
                    // echo print_r($row);

                    $num++;

                    parse_str(str_replace("amp;","",$row->sun_time));

                    $row_meridian1_1 = "AM";
                    $row_meridian1_2 = "AM";
                    
                    // print($starthour1);
                    // print($startminute1);
                ?>

                <script> ctr++; </script>

                <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour1">
                        <option value="<?php echo $starthour1  ?>">
                            <?php echo $starthour1 ?>
                        </option>
                        <option value="12">12</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-minute1" onclick="">
                        <option value="<?php echo $startminute1 ?>">
                            <?php echo $startminute1 ?>
                        </option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                 
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian1" onclick="">
                        <option value="<?php echo $startmeridian1; ?>">
                            <?php echo $startmeridian1; ?>
                        </option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>

                </div>



                <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour2">
                        <option value="<?php echo $endhour1  ?>">
                            <?php echo $endhour1 ?>
                        </option>
                        <option value="12">12</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-minute2" onclick="">
                        <option value="<?php echo $endminute1 ?>">
                            <?php echo $endminute1 ?>
                        </option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian2" onclick="">
                        <option value="<?php echo $endmeridian1 ?>">
                            <?php echo $endmeridian1 ?>
                        </option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <br><br><br>
                </div>

                <div class = "col-xs-12 form-group register-field" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">Warning</h3>
                    <input style="height:50px;display:none;" type = "date" required name = "change-warning" class = "form-control sign-in-field" id="time-form"><br>
                        <select style="width:120px;height:30px" id="time-warning" onclick="">
                            
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
                    </input>
                    <br><br><br>
                </div>
                

            <?php  endforeach; ?>
                <!-- <a id = "notif-btn" href="#notif-modal" data-toggle = "modal">sasasa</a> -->
                <?php include(APPPATH . 'views/modals/confirm_modal.php'); ?>
                <div class = "text-center">
                    <button href="#notif-modal" data-toggle = "modal" class = "btn btn-success container-fluid col-xs-12" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">Save Changes</button>
                </div>

            </div>

            
        </div>    
    </div>
    
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>"/> -->

</body>
<?php endforeach; ?>

<script>
	 function changeTimeSettings()
	 {
        // if(<?php echo $num; ?> == "-1")
        var hour1, minute1, meridian1;
        var hour2, minute2, meridian2;
        var warning;

        var selectedHour1, selectedMinute1, selectedMeridian1;
        var selectedHour2, selectedMinute2, selectedMeridian2;
        var selectedWarning;

        var i;

        for(i = 0; i < ctr; i++)
        {
            warning = document.getElementById("time-warning");

            selectedWarning = warning.options[warning.selectedIndex].value;

            hour1 = document.getElementById("time-hour1");
            minute1 = document.getElementById("time-minute1");
            meridian1 = document.getElementById("time-meridian1");

            hour2 = document.getElementById("time-hour2");
            minute2 = document.getElementById("time-minute2");
            meridian2 = document.getElementById("time-meridian2");

            selectedHour1 = hour1.options[hour1.selectedIndex].value;
            selectedMinute1 = minute1.options[minute1.selectedIndex].value;
            selectedMeridian1 = meridian1.options[meridian1.selectedIndex].value;
            
            selectedHour2 = hour2.options[hour2.selectedIndex].value;
            selectedMinute2 = minute2.options[minute2.selectedIndex].value;
            selectedMeridian2 = meridian2.options[meridian2.selectedIndex].value;

            // alert("i=" + i + " " + selectedHour1 + ":" + selectedMinute1 + " " + selectedMeridian1);
            // alert("i=" + i + " " + selectedHour2 + ":" + selectedMinute2 + " " + selectedMeridian2);

            document.cookie = "selectedWarning=" + selectedWarning + ";path=/";   

            document.cookie = "selectedHour1-" + i + "=" + selectedHour1 + ";" + ";path=/";   
            document.cookie = "selectedMinute1-" + i + "=" + selectedMinute1 + ";" + ";path=/"; 
            document.cookie = "selectedMeridian1-" + i + "=" + selectedMeridian1 + ";" + ";path=/"; 

            document.cookie = "selectedHour2-" + i + "=" + selectedHour2 + ";" + ";path=/";   
            document.cookie = "selectedMinute2-" + i + "=" + selectedMinute2 + ";" + ";path=/"; 
            document.cookie = "selectedMeridian2-" + i + "=" + selectedMeridian2 + ";" + ";path=/";   

            document.cookie = "basicTime1=" + "hour="+ selectedHour1 + "&minute="+  selectedMinute1 + "&meridian="+selectedMeridian1+";path=/"; 
            document.cookie = "basicTime2=" + "hour="+ selectedHour2 + "&minute="+  selectedMinute2 + "&meridian="+selectedMeridian2+";path=/";

            document.cookie = "1_sunTime1=" + "starthour1="+ selectedHour1 + "&startminute1="+  selectedMinute1 + "&startmeridian1="+selectedMeridian1+";path=/"; 
            document.cookie = "1_sunTime2=" + "endhour1="+ selectedHour2 + "&endminute1="+  selectedMinute2 + "&endmeridian1="+selectedMeridian2+";path=/";

            document.cookie = "2_monTime1=" + "starthour2="+ selectedHour1 + "&startminute2="+  selectedMinute1 + "&startmeridian2="+selectedMeridian1+";path=/"; 
            document.cookie = "2_monTime2=" + "endhour2="+ selectedHour2 + "&endminute2="+  selectedMinute2 + "&endmeridian2="+selectedMeridian2+";path=/";

            document.cookie = "3_tueTime1=" + "starthour3="+ selectedHour1 + "&startminute3="+  selectedMinute1 + "&startmeridian3="+selectedMeridian1+";path=/"; 
            document.cookie = "3_tueTime2=" + "endhour3="+ selectedHour2 + "&endminute3="+  selectedMinute2 + "&endmeridian3="+selectedMeridian2+";path=/";

            document.cookie = "4_wedTime1=" + "starthour4="+ selectedHour1 + "&startminute4="+  selectedMinute1 + "&startmeridian4="+selectedMeridian1+";path=/"; 
            document.cookie = "4_wedTime2=" + "endhour4="+ selectedHour2 + "&endminute4="+  selectedMinute2 + "&endmeridian4="+selectedMeridian2+";path=/";

            document.cookie = "5_thuTime1=" + "starthour5="+ selectedHour1 + "&startminute5="+  selectedMinute1 + "&startmeridian5="+selectedMeridian1+";path=/"; 
            document.cookie = "5_thuTime2=" + "endhour5="+ selectedHour2 + "&endminute5="+  selectedMinute2 + "&endmeridian5="+selectedMeridian2+";path=/";

            document.cookie = "6_friTime1=" + "starthour6="+ selectedHour1 + "&startminute6="+  selectedMinute1 + "&startmeridian6="+selectedMeridian1+";path=/"; 
            document.cookie = "6_friTime2=" + "endhour6="+ selectedHour2 + "&endminute6="+  selectedMinute2 + "&endmeridian6="+selectedMeridian2+";path=/";

            document.cookie = "7_satTime1=" + "starthour7="+ selectedHour1 + "&startminute7="+  selectedMinute1 + "&startmeridian7="+selectedMeridian1+";path=/"; 
            document.cookie = "7_satTime2=" + "endhour7="+ selectedHour2 + "&endminute7="+  selectedMinute2 + "&endmeridian7="+selectedMeridian2+";path=/";

            // alert();
        }

        location.reload();

        document.cookie = "updatetime=1;path=/";
        <?php 
            if($_COOKIE["updatetime"])
                echo $CI->user_model->set_usertimes($child->user_id, 0); //set to $num once adding again

        ?>
    }

</script>

</html>
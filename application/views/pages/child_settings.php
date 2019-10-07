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

?>
<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";

    var ctr = 0;
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

        <!-- <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/logo-blue.png'); ?>"/></a> -->
            
            
        <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>

    </div>
</nav>
<br><br><br>

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 4.5px;"><br>

                <div class = "col-xs-12 form-group register-field" style = "">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 0px; margin-top: 0px;">Settings for <strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>

                </div>
            </div>


            <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 1vw;"><br>

             	<?php foreach ($usertimes->result() as $row): 
                    
	              	$num++;

	              	$row_meridian1 = "AM";
	              	$row_meridian2 = "AM";
	              	
	              	if(((int) $row->start_hour) > 12)
              		{
              			switch($row->start_hour)
		               {
								case "13": $row->start_hour="01"; break;
								case "14": $row->start_hour="02"; break;
								case "15": $row->start_hour="03"; break;
								case "16": $row->start_hour="04"; break;
								case "17": $row->start_hour="05"; break;
								case "18": $row->start_hour="06"; break;
								case "19": $row->start_hour="07"; break;
								case "20": $row->start_hour="08"; break;
								case "21": $row->start_hour="09"; break;
								case "22": $row->start_hour="10"; break;
								case "23": $row->start_hour="11"; break;
		               }

		               $row_meridian1 = "PM";
              		}

              		if(((int) $row->end_hour) > 12 )
              		{
		               switch($row->end_hour)
		               {
								case "13": $row->end_hour="01"; break;
								case "14": $row->end_hour="02"; break;
								case "15": $row->end_hour="03"; break;
								case "16": $row->end_hour="04"; break;
								case "17": $row->end_hour="05"; break;
								case "18": $row->end_hour="06"; break;
								case "19": $row->end_hour="07"; break;
								case "20": $row->end_hour="08"; break;
								case "21": $row->end_hour="09"; break;
								case "22": $row->end_hour="10"; break;
								case "23": $row->end_hour="11"; break;
		               }

		               $row_meridian2 = "PM";
              		} 	      
             	?>

                <script> ctr++; </script>

                <div class = "col-xs-12 form-group register-field" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour1-<?php echo $num; ?>">" onclick="">
                        <option value="<?php echo $row->start_hour ?>">
                            <?php echo $row->start_hour ?>
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

                    <select style="width:100px;height:30px" id="time-minute1-<?php echo $num; ?>" onclick="">
                        <option value="<?php echo $row->start_minute?>">
                            <?php echo $row->start_minute ?>
                        </option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                 
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian1-<?php echo $num; ?>" onclick="">
                        <option value="<?php echo $row_meridian1; ?>">
                            <?php echo $row_meridian1; ?>
                        </option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>

                </div>

                <div class = "col-xs-12 form-group register-field" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;"><br>To</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour2-<?php echo $num; ?>" onclick="">
                        <option value="<?php echo $row->end_hour ?>">
                            <?php echo $row->end_hour ?>
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

                    <select style="width:100px;height:30px" id="time-minute2-<?php echo $num; ?>" onclick="">
                        <option value="<?php echo $row->end_minute ?>">
                            <?php echo $row->end_minute ?>
                        </option>
                        <option value="<?php echo $row->start_minute?>">
                            <?php echo $row->start_minute ?>
                        </option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian2-<?php echo $num; ?>" onclick="">
                        <option value="<?php echo $row_meridian2; ?>">
                            <?php echo $row_meridian2; ?>
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
                    <br>
                </div>

            <?php  endforeach; ?>
            	<!-- <a id = "notif-btn" href="#notif-modal" data-toggle = "modal">sasasa</a> -->
            	<?php include(APPPATH . 'views/modals/confirm_modal.php'); ?>
             	<div class = "text-center">
                 	<button href="#notif-modal" data-toggle = "modal" class = "btn btn-success container-fluid" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">Save Changes</button>
             	</div>

            </div>
        </div>    
    </div>
    
    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

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

            hour1 = document.getElementById("time-hour1-" + i);
            minute1 = document.getElementById("time-minute1-" + i);
            meridian1 = document.getElementById("time-meridian1-" + i);

            hour2 = document.getElementById("time-hour2-" + i);
            minute2 = document.getElementById("time-minute2-" + i);
            meridian2 = document.getElementById("time-meridian2-" + i);

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
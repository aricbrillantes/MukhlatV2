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
<style>div.content-container{border:0px;}</style>

<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";
    var ctr = 0;
</script>

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "border-bottom: 1px solid;">
    <div class = "container-fluid">
        
        <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px; border:0" href="<?php echo base_url('parents/settings/' . $child->user_id) ?>">
            <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                    Back
                </strong>
            </h3>
        </a>
            
        <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px; margin-bottom: 10px;">Log Out</a>

    </div>
</nav><br><br><br>

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 4.5px;"><br>

                <div class = "col-xs-12 form-group register-field" style = "">

                    <h3 class = "col-xs-4 col-md-4 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Advanced Settings</strong></h3>

                    <!-- <a href="<?php echo base_url('parents/activity/' . $child->user_id) ?>">
                        <h3 class = "col-xs-4 col-md-4 no-padding text-info pull-right"style = "margin-bottom: 0px; margin-top: 0px;">Advanced Settings</strong></h3>
                    </a> -->

                </div>

            </div>


            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 1vw;"><br>

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

                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a class="col-xs-4 col-md-12" data-toggle="pill" href="#sunday-setting" style="border-radius: 6px;">Sunday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#monday-setting" style="border-radius: 6px;">Monday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#tuesday-setting" style="border-radius: 6px;">Tuesday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#wednesday-setting" style="border-radius: 6px;">Wednesday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#thursday-setting" style="border-radius: 6px;">Thursday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#friday-setting" style="border-radius: 6px;">Friday</a></li>
                    <li><a class="col-xs-4 col-md-12" data-toggle="pill" href="#saturday-setting" style="border-radius: 6px;">Saturday</a></li>
                </ul>
                <br><br>

                <div class="tab-content">
                    <div id="sunday-setting" class = "form-group register-field container-fluid tab-pane fade in active">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-1">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-1" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-1" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-1" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-1" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-1" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="monday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-2">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-2" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-2" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-2" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-2" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-2" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="tuesday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-3">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-3" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-3" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-3" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-3" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-3" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="wednesday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-4">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-4" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-4" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-4" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-4" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-4" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="thursday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-5">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-5" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-5" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-5" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-5" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-5" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="friday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-6">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-6" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-6" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-6" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-6" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-6" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                    <div id="saturday-setting" class = "form-group register-field container-fluid tab-pane fade">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-7">" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute1-7" onclick="">
                                <option value="<?php echo $row->start_minute?>">
                                    <?php echo $row->start_minute ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-7" onclick="">
                                <option value="<?php echo $row_meridian1; ?>">
                                    <?php echo $row_meridian1; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-7" onclick="">
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

                            <select style="width:100px;height:30px" id="time-minute2-7" onclick="">
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

                            <select style="width:100px;height:30px" id="time-meridian2-7" onclick="">
                                <option value="<?php echo $row_meridian2; ?>">
                                    <?php echo $row_meridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <br><br><br>
                        </div>
                    </div>

                </div>



                <div class = "form-group register-field container-fluid">
                    <div class = "col-xs-12 col-md-4 form-group register-field" style = "font-size:14px;">
                        <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">Warning</h3>
                        <div class="checkbox">
                            <label><input type="checkbox" value="">Option 1</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="">Option 2</label>
                        </div>
                        <br>
                    </div>
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

        var selectedHour1_1, selectedMinute1_1, selectedMeridian1_1;
        var selectedHour2_1, selectedMinute2_1, selectedMeridian2_1;

        var selectedHour1_2, selectedMinute1_2, selectedMeridian1_2;
        var selectedHour2_2, selectedMinute2_2, selectedMeridian2_2;

        var selectedHour1_3, selectedMinute1_3, selectedMeridian1_3;
        var selectedHour2_3, selectedMinute2_3, selectedMeridian2_3;

        var selectedHour1_4, selectedMinute1_4, selectedMeridian1_4;
        var selectedHour2_4, selectedMinute2_4, selectedMeridian2_4;

        var selectedHour1_5, selectedMinute1_5, selectedMeridian1_5;
        var selectedHour2_5, selectedMinute2_5, selectedMeridian2_5;

        var selectedHour1_6, selectedMinute1_6, selectedMeridian1_6;
        var selectedHour2_6, selectedMinute2_6, selectedMeridian2_6;

        var selectedHour1_7, selectedMinute1_7, selectedMeridian1_7;
        var selectedHour2_7, selectedMinute2_7, selectedMeridian2_7;

        var selectedHour1, selectedMinute1, selectedMeridian1;
        var selectedHour2, selectedMinute2, selectedMeridian2;

        var selectedWarning;

        var i;

        for(i = 0; i < ctr; i++)
        {
            warning = document.getElementById("time-warning");

            selectedWarning = warning.options[warning.selectedIndex].value;

            hour1_1 = document.getElementById("time-hour1-" + i);
            minute1_1 = document.getElementById("time-minute1-" + i);
            meridian1_1 = document.getElementById("time-meridian1-" + i);

            hour2_1 = document.getElementById("time-hour2-" + i);
            minute2_1 = document.getElementById("time-minute2-" + i);
            meridian2_1 = document.getElementById("time-meridian2-" + i);

            selectedHour1_1 = hour1.options[hour1.selectedIndex].value;
            selectedMinute1_1 = minute1.options[minute1.selectedIndex].value;
            selectedMeridian1_1 = meridian1.options[meridian1.selectedIndex].value;
            
            selectedHour2_1 = hour2.options[hour2.selectedIndex].value;
            selectedMinute2_1 = minute2.options[minute2.selectedIndex].value;
            selectedMeridian2_1 = meridian2.options[meridian2.selectedIndex].value;

            selectedHour1_2 = hour1.options[hour1.selectedIndex].value;
            selectedMinute1_2 = minute1.options[minute1.selectedIndex].value;
            selectedMeridian1_2 = meridian1.options[meridian1.selectedIndex].value;
            
            selectedHour2_2 = hour2.options[hour2.selectedIndex].value;
            selectedMinute2_2 = minute2.options[minute2.selectedIndex].value;
            selectedMeridian2_2 = meridian2.options[meridian2.selectedIndex].value;

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
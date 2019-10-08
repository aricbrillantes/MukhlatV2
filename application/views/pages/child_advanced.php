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
            // echo print_r($row);
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

                    $query = array(); 

                    parse_str(str_replace("amp;","",$row->sun_time));
                    parse_str(str_replace("amp;","",$row->mon_time));
                    parse_str(str_replace("amp;","",$row->tue_time));
                    parse_str(str_replace("amp;","",$row->wed_time));
                    parse_str(str_replace("amp;","",$row->thu_time));
                    parse_str(str_replace("amp;","",$row->fri_time));
                    parse_str(str_replace("amp;","",$row->sat_time));

	      //         	$row_meridian1_1 = "AM";
	      //         	$row_meridian1_2 = "AM";
       //              $row_meridian2_1 = "AM";
       //              $row_meridian2_2 = "AM";
       //              $row_meridian3_1 = "AM";
       //              $row_meridian3_2 = "AM";
       //              $row_meridian4_1 = "AM";
       //              $row_meridian4_2 = "AM";
       //              $row_meridian5_1 = "AM";
       //              $row_meridian5_2 = "AM";
       //              $row_meridian6_1 = "AM";
       //              $row_meridian6_2 = "AM";
       //              $row_meridian7_1 = "AM";
       //              $row_meridian7_2 = "AM";

                    
	      //         	// print($query['startminute1']);
       //              // print_r($query);

       //              print($starthour1);

       //              //sunday
	      //         	if(((int) $starthour1) > 12)
       //        		{
       //    			   switch($starthour1)
		     //           {
							// case "13": $starthour1="01"; break;
							// case "14": $starthour1="02"; break;
							// case "15": $starthour1="03"; break;
							// case "16": $starthour1="04"; break;
							// case "17": $starthour1="05"; break;
							// case "18": $starthour1="06"; break;
							// case "19": $starthour1="07"; break;
							// case "20": $starthour1="08"; break;
							// case "21": $starthour1="09"; break;
							// case "22": $starthour1="10"; break;
							// case "23": $starthour1="11"; break;
		     //           }

		     //           $row_meridian1_1 = "PM";
       //                 print($row_meridian1_1);
       //        		}

       //        		if(((int) $endhour1) > 12 )
       //        		{
       //                  switch($endhour1)
       //                  {
							// case "13": $endhour1="01"; break;
							// case "14": $endhour1="02"; break;
							// case "15": $endhour1="03"; break;
							// case "16": $endhour1="04"; break;
							// case "17": $endhour1="05"; break;
							// case "18": $endhour1="06"; break;
							// case "19": $endhour1="07"; break;
							// case "20": $endhour1="08"; break;
							// case "21": $endhour1="09"; break;
							// case "22": $endhour1="10"; break;
							// case "23": $endhour1="11"; break;
		     //           }

		     //           $row_meridian1_2 = "PM";
       //        		} 	      


       //              //monday
       //              if(((int) $starthour2) > 12)
       //              {
       //                 switch($starthour2)
       //                 {
       //                      case "13": $starthour2="01"; break;
       //                      case "14": $starthour2="02"; break;
       //                      case "15": $starthour2="03"; break;
       //                      case "16": $starthour2="04"; break;
       //                      case "17": $starthour2="05"; break;
       //                      case "18": $starthour2="06"; break;
       //                      case "19": $starthour2="07"; break;
       //                      case "20": $starthour2="08"; break;
       //                      case "21": $starthour2="09"; break;
       //                      case "22": $starthour2="10"; break;
       //                      case "23": $starthour2="11"; break;
       //                 }

       //                 $row_meridian2_1 = "PM";
       //              }

       //              if(((int) $endhour2) > 12 )
       //              {
       //                  switch($endhour2)
       //                  {
       //                      case "13": $endhour2="01"; break;
       //                      case "14": $endhour2="02"; break;
       //                      case "15": $endhour2="03"; break;
       //                      case "16": $endhour2="04"; break;
       //                      case "17": $endhour2="05"; break;
       //                      case "18": $endhour2="06"; break;
       //                      case "19": $endhour2="07"; break;
       //                      case "20": $endhour2="08"; break;
       //                      case "21": $endhour2="09"; break;
       //                      case "22": $endhour2="10"; break;
       //                      case "23": $endhour2="11"; break;
       //                 }

       //                 $row_meridian2_2 = "PM";
       //              }


       //              //tuesday
       //              if(((int) $starthour3) > 12)
       //              {
       //                 switch($starthour3)
       //                 {
       //                      case "13": $starthour3="01"; break;
       //                      case "14": $starthour3="02"; break;
       //                      case "15": $starthour3="03"; break;
       //                      case "16": $starthour3="04"; break;
       //                      case "17": $starthour3="05"; break;
       //                      case "18": $starthour3="06"; break;
       //                      case "19": $starthour3="07"; break;
       //                      case "20": $starthour3="08"; break;
       //                      case "21": $starthour3="09"; break;
       //                      case "22": $starthour3="10"; break;
       //                      case "23": $starthour3="11"; break;
       //                 }

       //                 $row_meridian3_1 = "PM";
       //              }

       //              if(((int) $endhour3) > 12 )
       //              {
       //                  switch($endhour3)
       //                  {
       //                      case "13": $endhour3="01"; break;
       //                      case "14": $endhour3="02"; break;
       //                      case "15": $endhour3="03"; break;
       //                      case "16": $endhour3="04"; break;
       //                      case "17": $endhour3="05"; break;
       //                      case "18": $endhour3="06"; break;
       //                      case "19": $endhour3="07"; break;
       //                      case "20": $endhour3="08"; break;
       //                      case "21": $endhour3="09"; break;
       //                      case "22": $endhour3="10"; break;
       //                      case "23": $endhour3="11"; break;
       //                 }

       //                 $row_meridian3_2 = "PM";
       //              }


       //              //wednesday
       //              if(((int) $starthour4) > 12)
       //              {
       //                 switch($starthour4)
       //                 {
       //                      case "13": $starthour4="01"; break;
       //                      case "14": $starthour4="02"; break;
       //                      case "15": $starthour4="03"; break;
       //                      case "16": $starthour4="04"; break;
       //                      case "17": $starthour4="05"; break;
       //                      case "18": $starthour4="06"; break;
       //                      case "19": $starthour4="07"; break;
       //                      case "20": $starthour4="08"; break;
       //                      case "21": $starthour4="09"; break;
       //                      case "22": $starthour4="10"; break;
       //                      case "23": $starthour4="11"; break;
       //                 }

       //                 $row_meridian4_1 = "PM";
       //              }

       //              if(((int) $endhour4) > 12 )
       //              {
       //                  switch($endhour4)
       //                  {
       //                      case "13": $endhour4="01"; break;
       //                      case "14": $endhour4="02"; break;
       //                      case "15": $endhour4="03"; break;
       //                      case "16": $endhour4="04"; break;
       //                      case "17": $endhour4="05"; break;
       //                      case "18": $endhour4="06"; break;
       //                      case "19": $endhour4="07"; break;
       //                      case "20": $endhour4="08"; break;
       //                      case "21": $endhour4="09"; break;
       //                      case "22": $endhour4="10"; break;
       //                      case "23": $endhour4="11"; break;
       //                 }

       //                 $row_meridian4_2 = "PM";
       //              }


       //              //thursday
       //              if(((int) $starthour5) > 12)
       //              {
       //                 switch($starthour5)
       //                 {
       //                      case "13": $starthour5="01"; break;
       //                      case "14": $starthour5="02"; break;
       //                      case "15": $starthour5="03"; break;
       //                      case "16": $starthour5="04"; break;
       //                      case "17": $starthour5="05"; break;
       //                      case "18": $starthour5="06"; break;
       //                      case "19": $starthour5="07"; break;
       //                      case "20": $starthour5="08"; break;
       //                      case "21": $starthour5="09"; break;
       //                      case "22": $starthour5="10"; break;
       //                      case "23": $starthour5="11"; break;
       //                 }

       //                 $row_meridian5_1 = "PM";
       //              }

       //              if(((int) $endhour5) > 12 )
       //              {
       //                  switch($endhour5)
       //                  {
       //                      case "13": $endhour5="01"; break;
       //                      case "14": $endhour5="02"; break;
       //                      case "15": $endhour5="03"; break;
       //                      case "16": $endhour5="04"; break;
       //                      case "17": $endhour5="05"; break;
       //                      case "18": $endhour5="06"; break;
       //                      case "19": $endhour5="07"; break;
       //                      case "20": $endhour5="08"; break;
       //                      case "21": $endhour5="09"; break;
       //                      case "22": $endhour5="10"; break;
       //                      case "23": $endhour5="11"; break;
       //                 }

       //                 $row_meridian5_2 = "PM";
       //              }


       //              //friday
       //              if(((int) $starthour6) > 12)
       //              {
       //                 switch($starthour6)
       //                 {
       //                      case "13": $starthour6="01"; break;
       //                      case "14": $starthour6="02"; break;
       //                      case "15": $starthour6="03"; break;
       //                      case "16": $starthour6="04"; break;
       //                      case "17": $starthour6="05"; break;
       //                      case "18": $starthour6="06"; break;
       //                      case "19": $starthour6="07"; break;
       //                      case "20": $starthour6="08"; break;
       //                      case "21": $starthour6="09"; break;
       //                      case "22": $starthour6="10"; break;
       //                      case "23": $starthour6="11"; break;
       //                 }

       //                 $row_meridian6_1 = "PM";
       //              }

       //              if(((int) $endhour6) > 12 )
       //              {
       //                  switch($endhour6)
       //                  {
       //                      case "13": $endhour6="01"; break;
       //                      case "14": $endhour6="02"; break;
       //                      case "15": $endhour6="03"; break;
       //                      case "16": $endhour6="04"; break;
       //                      case "17": $endhour6="05"; break;
       //                      case "18": $endhour6="06"; break;
       //                      case "19": $endhour6="07"; break;
       //                      case "20": $endhour6="08"; break;
       //                      case "21": $endhour6="09"; break;
       //                      case "22": $endhour6="10"; break;
       //                      case "23": $endhour6="11"; break;
       //                 }

       //                 $row_meridian6_2 = "PM";
       //              }


       //              //saturday
       //              if(((int) $starthour7) > 12)
       //              {
       //                 switch($starthour7)
       //                 {
       //                      case "13": $starthour7="01"; break;
       //                      case "14": $starthour7="02"; break;
       //                      case "15": $starthour7="03"; break;
       //                      case "16": $starthour7="04"; break;
       //                      case "17": $starthour7="05"; break;
       //                      case "18": $starthour7="06"; break;
       //                      case "19": $starthour7="07"; break;
       //                      case "20": $starthour7="08"; break;
       //                      case "21": $starthour7="09"; break;
       //                      case "22": $starthour7="10"; break;
       //                      case "23": $starthour7="11"; break;
       //                 }

       //                 $row_meridian7_1 = "PM";
       //              }

       //              if(((int) $endhour7) > 12 )
       //              {
       //                  switch($endhour7)
       //                  {
       //                      case "13": $endhour7="01"; break;
       //                      case "14": $endhour7="02"; break;
       //                      case "15": $endhour7="03"; break;
       //                      case "16": $endhour7="04"; break;
       //                      case "17": $endhour7="05"; break;
       //                      case "18": $endhour7="06"; break;
       //                      case "19": $endhour7="07"; break;
       //                      case "20": $endhour7="08"; break;
       //                      case "21": $endhour7="09"; break;
       //                      case "22": $endhour7="10"; break;
       //                      case "23": $endhour7="11"; break;
       //                 }

       //                 $row_meridian7_2 = "PM";
       //              }
                    
             	?>

                <script> ctr++; </script>

                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#sunday-setting" style="border-radius: 6px;">Sunday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#monday-setting" style="border-radius: 6px;">Monday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#tuesday-setting" style="border-radius: 6px;">Tuesday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#wednesday-setting" style="border-radius: 6px;">Wednesday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#thursday-setting" style="border-radius: 6px;">Thursday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#friday-setting" style="border-radius: 6px;">Friday</a></li>
                    <li><a class="col-xs-4 col-md-12 col-sm-9" data-toggle="pill" href="#saturday-setting" style="border-radius: 6px;">Saturday</a></li>
                </ul>
                <br><br>

                <div class="tab-content">
                    <div id="sunday-setting" class = "form-group register-field container-fluid tab-pane fade in active">
                        <div class = "col-xs-12 col-md-6 form-group register-field container-fluid" style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour1-1">
                                <option value="<?php echo $starthour1 ?>">
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

                            <select style="width:100px;height:30px" id="time-minute1-1" onclick="">
                                <option value="<?php echo $startminute1 ?>">
                                    <?php echo  $startminute1 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-1" onclick="">
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

                            <select style="width:120px;height:30px" id="time-hour2-1" onclick="">
                                <option value="<?php echo $endhour1 ?>">
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

                            <select style="width:100px;height:30px" id="time-minute2-1" onclick="">
                                <option value="<?php echo $endminute1 ?>">
                                    <?php echo $endminute1 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-1" onclick="">
                                <option value="<?php echo $endmeridian1; ?>">
                                    <?php echo $endmeridian1; ?>
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
                                <option value="<?php echo $starthour2 ?>">
                                    <?php echo $starthour2 ?>
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
                                <option value="<?php echo $startminute2 ?>">
                                    <?php echo $startminute2 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-2" onclick="">
                                <option value="<?php echo $startmeridian2; ?>">
                                    <?php echo $startmeridian2; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-2" onclick="">
                                <option value="<?php echo $endhour2 ?>">
                                    <?php echo $endhour2 ?>
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
                                <option value="<?php echo $endminute2 ?>">
                                    <?php echo $endminute2 ?>
                                </option>
                                
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-2" onclick="">
                                <option value="<?php echo $endmeridian2; ?>">
                                    <?php echo $endmeridian2; ?>
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
                                <option value="<?php echo $starthour3 ?>">
                                    <?php echo $starthour3 ?>
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
                                <option value="<?php echo $startminute3 ?>">
                                    <?php echo $startminute3 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-3" onclick="">
                                <option value="<?php echo $startmeridian3; ?>">
                                    <?php echo $startmeridian3; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-3" onclick="">
                                <option value="<?php echo $endhour3 ?>">
                                    <?php echo $endhour3 ?>
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
                                <option value="<?php echo $endminute3 ?>">
                                    <?php echo $endminute3 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-3" onclick="">
                                <option value="<?php echo $endmeridian3; ?>">
                                    <?php echo $endmeridian3; ?>
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
                                <option value="<?php echo $starthour4 ?>">
                                    <?php echo $starthour4 ?>
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
                                <option value="<?php echo $startminute4 ?>">
                                    <?php echo $startminute4 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-4" onclick="">
                                <option value="<?php echo $startmeridian4; ?>">
                                    <?php echo $startmeridian4; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-4" onclick="">
                                <option value="<?php echo $endhour4 ?>">
                                    <?php echo $endhour4 ?>
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
                                <option value="<?php echo $endminute4 ?>">
                                    <?php echo $endminute4 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-4" onclick="">
                                <option value="<?php echo $endmeridian4; ?>">
                                    <?php echo $endmeridian4; ?>
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
                                <option value="<?php echo $starthour5 ?>">
                                    <?php echo $starthour5 ?>
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
                                <option value="<?php echo $startminute5?>">
                                    <?php echo $startminute5 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-5" onclick="">
                                <option value="<?php echo $startmeridian5; ?>">
                                    <?php echo $startmeridian5; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-5" onclick="">
                                <option value="<?php echo $endhour5 ?>">
                                    <?php echo $endhour5 ?>
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
                                <option value="<?php echo $endminute5 ?>">
                                    <?php echo $endminute5 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-5" onclick="">
                                <option value="<?php echo $endmeridian5; ?>">
                                    <?php echo $endmeridian5; ?>
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
                                <option value="<?php echo $starthour6 ?>">
                                    <?php echo $starthour6 ?>
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
                                <option value="<?php echo $startminute6 ?>">
                                    <?php echo $startminute6 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-6" onclick="">
                                <option value="<?php echo $startmeridian6; ?>">
                                    <?php echo $startmeridian6; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-6" onclick="">
                                <option value="<?php echo $endhour6 ?>">
                                    <?php echo $endhour6 ?>
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
                                <option value="<?php echo $endminute6 ?>">
                                    <?php echo $endminute6 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-6" onclick="">
                                <option value="<?php echo $endmeridian6; ?>">
                                    <?php echo $endmeridian6; ?>
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
                                <option value="<?php echo $starthour7 ?>">
                                    <?php echo $starthour7 ?>
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
                                <option value="<?php echo $startminute7 ?>">
                                    <?php echo $startminute7 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                         
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian1-7" onclick="">
                                <option value="<?php echo $startmeridian7; ?>">
                                    <?php echo $startmeridian7; ?>
                                </option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>

                        </div>

                        <div class = "col-xs-12 col-md-6 form-group register-field " style = "font-size:14px;">
                            <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">To</h3>

                            <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                            <select style="width:120px;height:30px" id="time-hour2-7" onclick="">
                                <option value="<?php echo $endhour7 ?>">
                                    <?php echo $endhour7 ?>
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
                                <option value="<?php echo $endminute7 ?>">
                                    <?php echo $endminute7 ?>
                                </option>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>

                            <select style="width:100px;height:30px" id="time-meridian2-7" onclick="">
                                <option value="<?php echo $endmeridian7; ?>">
                                    <?php echo $endmeridian7; ?>
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

        var warning;

        var hour1, minute1, meridian1;
        var hour2, minute2, meridian2;

        var hour1_1, minute1_1, meridian1_1;
        var hour2_1, minute2_1, meridian2_1;

        var hour1_2, minute1_2, meridian1_2;
        var hour2_2, minute2_2, meridian2_2;

        var hour1_3, minute1_3, meridian1_3;
        var hour2_3, minute2_3, meridian2_3;

        var hour1_4, minute1_4, meridian1_4;
        var hour2_4, minute2_4, meridian2_4;

        var hour1_5, minute1_5, meridian1_5;
        var hour2_5, minute2_5, meridian2_5;

        var hour1_6, minute1_6, meridian1_6;
        var hour2_6, minute2_6, meridian2_6;

        var hour1_7, minute1_7, meridian1_7;
        var hour2_7, minute2_7, meridian2_7;

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

        var i, j;

        for(i = 0; i < ctr; i++)
        {
            warning = document.getElementById("time-warning");

            // selectedWarning = warning.options[warning.selectedIndex].value;
            selectedWarning = "30";

            hour1 = document.getElementById("time-hour1-1");
            minute1 = document.getElementById("time-minute1-1");
            meridian1 = document.getElementById("time-meridian1-1");

            hour2 = document.getElementById("time-hour2-1");
            minute2 = document.getElementById("time-minute2-1");
            meridian2 = document.getElementById("time-meridian2-1");

            //sunday
            hour1_1 = document.getElementById("time-hour1-1");
            minute1_1 = document.getElementById("time-minute1-1");
            meridian1_1 = document.getElementById("time-meridian1-1");

            hour2_1 = document.getElementById("time-hour2-1");
            minute2_1 = document.getElementById("time-minute2-1");
            meridian2_1 = document.getElementById("time-meridian2-1");

            //monday
            hour1_2 = document.getElementById("time-hour1-2");
            minute1_2 = document.getElementById("time-minute1-2");
            meridian1_2 = document.getElementById("time-meridian1-2");

            hour2_2 = document.getElementById("time-hour2-2");
            minute2_2 = document.getElementById("time-minute2-2");
            meridian2_2 = document.getElementById("time-meridian2-2");

            //tuesday
            hour1_3 = document.getElementById("time-hour1-3");
            minute1_3 = document.getElementById("time-minute1-3");
            meridian1_3 = document.getElementById("time-meridian1-3");

            hour2_3 = document.getElementById("time-hour2-3");
            minute2_3 = document.getElementById("time-minute2-3");
            meridian2_3 = document.getElementById("time-meridian2-3");

            //wednesday
            hour1_4 = document.getElementById("time-hour1-4");
            minute1_4 = document.getElementById("time-minute1-4");
            meridian1_4 = document.getElementById("time-meridian1-4");

            hour2_4 = document.getElementById("time-hour2-4");
            minute2_4 = document.getElementById("time-minute2-4");
            meridian2_4 = document.getElementById("time-meridian2-4");

            //thursday
            hour1_5 = document.getElementById("time-hour1-5");
            minute1_5 = document.getElementById("time-minute1-5");
            meridian1_5 = document.getElementById("time-meridian1-5");

            hour2_5 = document.getElementById("time-hour2-5");
            minute2_5 = document.getElementById("time-minute2-5");
            meridian2_5 = document.getElementById("time-meridian2-5");

            //friday
            hour1_6 = document.getElementById("time-hour1-6");
            minute1_6 = document.getElementById("time-minute1-6");
            meridian1_6 = document.getElementById("time-meridian1-6");

            hour2_6 = document.getElementById("time-hour2-6");
            minute2_6 = document.getElementById("time-minute2-6");
            meridian2_6 = document.getElementById("time-meridian2-6");

            //saturday
            hour1_7 = document.getElementById("time-hour1-7");
            minute1_7 = document.getElementById("time-minute1-7");
            meridian1_7 = document.getElementById("time-meridian1-7");

            hour2_7 = document.getElementById("time-hour2-7");
            minute2_7 = document.getElementById("time-minute2-7");
            meridian2_7 = document.getElementById("time-meridian2-7");

            //basic
            selectedHour1 = hour1.options[hour1.selectedIndex].value;
            selectedMinute1 = minute1.options[minute1.selectedIndex].value;
            selectedMeridian1 = meridian1.options[meridian1.selectedIndex].value;
            
            selectedHour2 = hour2.options[hour2.selectedIndex].value;
            selectedMinute2 = minute2.options[minute2.selectedIndex].value;
            selectedMeridian2 = meridian2.options[meridian2.selectedIndex].value;

            //sunday
            selectedHour1_1 = hour1_1.options[hour1_1.selectedIndex].value;
            selectedMinute1_1 = minute1_1.options[minute1_1.selectedIndex].value;
            selectedMeridian1_1 = meridian1.options[meridian1_1.selectedIndex].value;
            
            selectedHour2_1 = hour2_1.options[hour2_1.selectedIndex].value;
            selectedMinute2_1 = minute2_1.options[minute2_1.selectedIndex].value;
            selectedMeridian2_1 = meridian2_1.options[meridian2_1.selectedIndex].value;

            //monday
            selectedHour1_2 = hour1_2.options[hour1_2.selectedIndex].value;
            selectedMinute1_2 = minute1_2.options[minute1_2.selectedIndex].value;
            selectedMeridian1_2 = meridian1_2.options[meridian1_2.selectedIndex].value;
            
            selectedHour2_2 = hour2_2.options[hour2_2.selectedIndex].value;
            selectedMinute2_2 = minute2_2.options[minute2_2.selectedIndex].value;
            selectedMeridian2_2 = meridian2_2.options[meridian2_2.selectedIndex].value;

            //tuesday
            selectedHour1_3 = hour1_3.options[hour1_3.selectedIndex].value;
            selectedMinute1_3 = minute1_3.options[minute1_3.selectedIndex].value;
            selectedMeridian1_3 = meridian1_3.options[meridian1_3.selectedIndex].value;
            
            selectedHour2_3 = hour2_3.options[hour2_3.selectedIndex].value;
            selectedMinute2_3 = minute2_3.options[minute2_3.selectedIndex].value;
            selectedMeridian2_3 = meridian2_3.options[meridian2_3.selectedIndex].value;

            //wednesday
            selectedHour1_4 = hour1_4.options[hour1_4.selectedIndex].value;
            selectedMinute1_4 = minute1_4.options[minute1_4.selectedIndex].value;
            selectedMeridian1_4 = meridian1_4.options[meridian1_4.selectedIndex].value;
            
            selectedHour2_4 = hour2_4.options[hour2_4.selectedIndex].value;
            selectedMinute2_4 = minute2_4.options[minute2_4.selectedIndex].value;
            selectedMeridian2_4 = meridian2_4.options[meridian2_4.selectedIndex].value;

            //thursday
            selectedHour1_5 = hour1_5.options[hour1_5.selectedIndex].value;
            selectedMinute1_5 = minute1_5.options[minute1_5.selectedIndex].value;
            selectedMeridian1_5 = meridian1_5.options[meridian1_5.selectedIndex].value;
            
            selectedHour2_5 = hour2_5.options[hour2_5.selectedIndex].value;
            selectedMinute2_5 = minute2_5.options[minute2_5.selectedIndex].value;
            selectedMeridian2_5 = meridian2_5.options[meridian2_5.selectedIndex].value;

            //friday
            selectedHour1_6 = hour1_6.options[hour1_6.selectedIndex].value;
            selectedMinute1_6 = minute1_6.options[minute1_6.selectedIndex].value;
            selectedMeridian1_6 = meridian1_6.options[meridian1_6.selectedIndex].value;
            
            selectedHour2_6 = hour2_6.options[hour2_6.selectedIndex].value;
            selectedMinute2_6 = minute2_6.options[minute2_6.selectedIndex].value;
            selectedMeridian2_6 = meridian2_6.options[meridian2_6.selectedIndex].value;
            
            //saturday
            selectedHour1_7 = hour1_7.options[hour1_7.selectedIndex].value;
            selectedMinute1_7 = minute1_7.options[minute1_7.selectedIndex].value;
            selectedMeridian1_7 = meridian1_7.options[meridian1_7.selectedIndex].value;
            
            selectedHour2_7 = hour2_7.options[hour2_7.selectedIndex].value;
            selectedMinute2_7 = minute2_7.options[minute2_7.selectedIndex].value;
            selectedMeridian2_7 = meridian2_7.options[meridian2_7.selectedIndex].value;


            // alert("i=" + i + " " + selectedHour1 + ":" + selectedMinute1 + " " + selectedMeridian1);
            // alert("i=" + i + " " + selectedHour2 + ":" + selectedMinute2 + " " + selectedMeridian2);

            document.cookie = "selectedWarning=" + selectedWarning + ";path=/";   

            document.cookie = "selectedHour1-" + i + "=" + selectedHour1 + ";" + ";path=/";   
            document.cookie = "selectedMinute1-" + i + "=" + selectedMinute1 + ";" + ";path=/"; 
            document.cookie = "selectedMeridian1-" + i + "=" + selectedMeridian1 + ";" + ";path=/"; 

            document.cookie = "selectedHour2-" + i + "=" + selectedHour2 + ";" + ";path=/";   
            document.cookie = "selectedMinute2-" + i + "=" + selectedMinute2 + ";" + ";path=/"; 
            document.cookie = "selectedMeridian2-" + i + "=" + selectedMeridian2 + ";" + ";path=/";   

            document.cookie = "basicTime1=" + "starthour="+ selectedHour1 + "&startminute="+  selectedMinute1 + "&startmeridian="+selectedMeridian1+";path=/"; 
            document.cookie = "basicTime2=" + "endhour="+ selectedHour2 + "&endminute="+  selectedMinute2 + "&endmeridian="+selectedMeridian2+";path=/";

            document.cookie = "1_sunTime1=" + "starthour1="+ selectedHour1_1 + "&startminute1="+  selectedMinute1_1 + "&startmeridian1="+selectedMeridian1_1+";path=/"; 
            document.cookie = "1_sunTime2=" + "endhour1="+ selectedHour2_1 + "&endminute1="+  selectedMinute2_1 + "&endmeridian1="+selectedMeridian2_1+";path=/";

            document.cookie = "2_monTime1=" + "starthour2="+ selectedHour1_2 + "&startminute2="+  selectedMinute1_2 + "&startmeridian2="+selectedMeridian1_2+";path=/"; 
            document.cookie = "2_monTime2=" + "endhour2="+ selectedHour2_2 + "&endminute2="+  selectedMinute2_2 + "&endmeridian2="+selectedMeridian2_2+";path=/";

            document.cookie = "3_tueTime1=" + "starthour3="+ selectedHour1_3 + "&startminute3="+  selectedMinute1_3 + "&startmeridian3="+selectedMeridian1_3+";path=/"; 
            document.cookie = "3_tueTime2=" + "endhour3="+ selectedHour2_3 + "&endminute3="+  selectedMinute2_3 + "&endmeridian3="+selectedMeridian2_3+";path=/";

            document.cookie = "4_wedTime1=" + "starthour4="+ selectedHour1_4 + "&startminute4="+  selectedMinute1_4 + "&startmeridian4="+selectedMeridian1_4+";path=/"; 
            document.cookie = "4_wedTime2=" + "endhour4="+ selectedHour2_4 + "&endminute4="+  selectedMinute2_4 + "&endmeridian4="+selectedMeridian2_4+";path=/";

            document.cookie = "5_thuTime1=" + "starthour5="+ selectedHour1_5 + "&startminute5="+  selectedMinute1_5 + "&startmeridian5="+selectedMeridian1_5+";path=/"; 
            document.cookie = "5_thuTime2=" + "endhour5="+ selectedHour2_5 + "&endminute5="+  selectedMinute2_5 + "&endmeridian5="+selectedMeridian2_5+";path=/";

            document.cookie = "6_friTime1=" + "starthour6="+ selectedHour1_6 + "&startminute6="+  selectedMinute1_6 + "&startmeridian6="+selectedMeridian1_6+";path=/"; 
            document.cookie = "6_friTime2=" + "endhour6="+ selectedHour2_6 + "&endminute6="+  selectedMinute2_6 + "&endmeridian6="+selectedMeridian2_6+";path=/";

            document.cookie = "7_satTime1=" + "starthour7="+ selectedHour1_7 + "&startminute7="+  selectedMinute1_7 + "&startmeridian7="+selectedMeridian1_7+";path=/"; 
            document.cookie = "7_satTime2=" + "endhour7="+ selectedHour2_7 + "&endminute7="+  selectedMinute2_7 + "&endmeridian7="+selectedMeridian2_7+";path=/";
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
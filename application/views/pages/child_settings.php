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

    //get data of child being monitored
    $children = $CI->user_model->view_specific_child($id);
    // $usertimes = $CI->user_model->set_usertimes($logged_user->user_id);

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
            echo "<p style='color:white;'>" . $row->start_hour . ":" . $row->start_minute . "-" . $row->end_hour . ":" . $row->end_minute . "</p>";
        }

        echo "<p style='color:white;'><b>Current time:</b> " . (int) date("G") . ": " . date("i") . "</p> " ;
    } 

    $num=-1;

?>
<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    // document.cookie = "selectedHour1=" + "08" + ";" + ";path=/";   
    // document.cookie = "selectedMinute1=" + "00" + ";" + ";path=/"; 
    // document.cookie = "selectedMeridian1=" + "AM" + ";" + ";path=/"; 

    // document.cookie = "selectedHour2=" + "08" + ";" + ";path=/";   
    // document.cookie = "selectedMinute2=" + "00" + ";" + ";path=/"; 
    // document.cookie = "selectedMeridian2=" + "PM" + ";" + ";path=/";  
    document.cookie = "updatetime=0;path=/";

    var ctr = 0;
</script>

<body class = "sign-in">
    <div class = "container" style = "margin-top: 30px;">
        <div class = "row">
            <div class = "col-md-8 col-md-offset-2 content-container no-padding" style = "margin-bottom: 5px;">
                <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px;" href="<?php echo base_url('parents/activity/' . $child->user_id) ?>">
                    <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                        <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                            Back
                        </strong>
                    </h3>
                </a>
                <h3 class = "text-info no-margin" style = "display: inline-block; padding-left: 10px; margin-top: 5px; padding-top: 10px;">Settings for</h4>

                <h3 class = "text-info no-margin" style = "display: inline-block; padding-left: 5px; margin-top: 5px; padding-top: 10px;"><strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>

                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px;">Log Out</a>
            </div>

            <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;"><br>
                
                <?php foreach ($usertimes->result() as $row): 
                    
                    $num++;
                    $row_meridian = "AM";

                    if((int) $row->start_hour > 12)
                    {
                        switch($row->start_hour)
                        {
                            case "01": $row->start_hour="13"; break;
                            case "02": $row->start_hour="14"; break;
                            case "03": $row->start_hour="15"; break;
                            case "04": $row->start_hour="16"; break;
                            case "05": $row->start_hour="17"; break;
                            case "06": $row->start_hour="18"; break;
                            case "07": $row->start_hour="19"; break;
                            case "08": $row->start_hour="20"; break;
                            case "09": $row->start_hour="21"; break;
                            case "10": $row->start_hour="22"; break;
                            case "11": $row->start_hour="23"; break;
                            case "12": $row->start_hour="24"; break;
                        }
                        $row_meridian = "PM";
                    }

                ?>

                <script> ctr++; </script>

                <div class = "col-xs-7 form-group register-field" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">From</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour1-<?php echo $num; ?>">" onclick="choosetime()">
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

                    <select style="width:100px;height:30px" id="time-minute1-<?php echo $num; ?>" onclick="choosetime()">
                        <option value="<?php echo $row->start_minute ?>">
                            <?php echo $row->start_minute ?>
                        </option>
                        <option value="00">00</option>
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
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian1-<?php echo $num; ?>" onclick="choosetime()">
                        <option value="<?php echo $row_meridian; ?>">
                            <?php echo $row_meridian; ?>
                        </option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>

                </div>

                <div class = "col-xs-7 form-group register-field" style = "font-size:14px;">
                    <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;"><br>To</h3>

                    <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                    <select style="width:120px;height:30px" id="time-hour2-<?php echo $num; ?>" onclick="choosetime()">
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

                    <select style="width:100px;height:30px" id="time-minute2-<?php echo $num; ?>" onclick="choosetime()">
                        <option value="<?php echo $row->end_hour ?>">
                            <?php echo $row->end_minute ?>
                        </option>
                        <option value="M">Minute</option>
                        <option value="00">00</option>
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
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select>

                    <select style="width:100px;height:30px" id="time-meridian2-<?php echo $num; ?>" onclick="choosetime()">
                        <option value="<?php echo $row_meridian; ?>">
                            <?php echo $row_meridian; ?>
                        </option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <br><br><br>
                </div>

                

            <?php  endforeach; ?>

                

                <div class = "text-center">
                    <button onclick="alerttime()" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Save settings</button>
                </div>

            </div>
        </div>    
    </div>
    
    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

</body>
<?php endforeach; ?>

<script>
    var i;
    var time_array;
    for(i = 0; i < ctr; i++)
    {
        
    }
    // alert(i);

    function choosetime()
    {
        var hour1 = document.getElementById("time-hour1");
        var minute1 = document.getElementById("time-minute1");
        var meridian1 = document.getElementById("time-meridian1");

        var hour2 = document.getElementById("time-hour2");
        var minute2 = document.getElementById("time-minute2");
        var meridian2 = document.getElementById("time-meridian2");

        var selectedHour1 = hour1.options[hour1.selectedIndex].value;
        var selectedMinute1 = minute1.options[minute1.selectedIndex].value;
        var selectedMeridian1 = meridian1.options[meridian1.selectedIndex].value;
        
        var selectedHour2 = hour2.options[hour2.selectedIndex].value;
        var selectedMinute2 = minute2.options[minute2.selectedIndex].value;
        var selectedMeridian2 = meridian2.options[meridian2.selectedIndex].value;

        document.cookie = "selectedHour1=" + selectedHour1 + ";" + ";path=/";   
        document.cookie = "selectedMinute1=" + selectedMinute1 + ";" + ";path=/"; 
        document.cookie = "selectedMeridian1=" + selectedMeridian1 + ";" + ";path=/"; 

        document.cookie = "selectedHour2=" + selectedHour2 + ";" + ";path=/";   
        document.cookie = "selectedMinute2=" + selectedMinute2 + ";" + ";path=/"; 
        document.cookie = "selectedMeridian2=" + selectedMeridian2 + ";" + ";path=/";                          
    }

    function alerttime()
    {
        var i;
        for(i = 0; i < ctr; i++)
        {
            alert(i);
        }


        document.cookie = "updatetime=1;path=/";
        location.reload();

        <?php 
            if($_COOKIE["updatetime"])  
                echo $CI->user_model->set_usertimes($child->user_id);
        ?>
    }

</script>

</html>
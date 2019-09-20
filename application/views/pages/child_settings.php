<?php
    include(APPPATH . 'views/header.php');
    
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 3 || $logged_user == null)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    $CI =&get_instance();
    $CI->load->model('user_model');

    $id = $this->uri->segment(3);

    if(!$id)
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    $children = $CI->user_model->view_specific_child($id);

    $CI =&get_instance();
    $CI->load->model('topic_model');

    foreach ($children->result() as $child): 

    $data['user'] = $CI->user_model->get_user(true, true, array('user_id' => $child->user_id));
    
    $user_topics = $CI->topic_model->get_user_topics($child->user_id);
    $user_moderated_topics = $CI->topic_model->get_moderated_topics($child->user_id);
    $user_followed_topics = $CI->topic_model->get_followed_topics($child->user_id);

?>
<script type="text/javascript" src="<?php echo base_url("/js/sign_in.js"); ?>"></script>
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

            <!-- <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                <div class = "col-xs-6 no-padding no-margin">
                    <h3 class = "no-padding text-info" style = "margin-bottom: 10px; margin-top: 10px;">Settings for <strong><?php echo $child->first_name . " " . $child->last_name ?></strong></h3>
                </div>
            </div>     -->

            <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                <br>
                <form id = "sign-up-form" onsubmit = "" method = "post"> <!-- onsubmit = "return sign_up()" -->
                    <div class = "col-xs-7 form-group register-field" style = "font-size:14px;">
                        <h3 class = "no-padding text-info"style = "margin-bottom: 5px; margin-top: 0px;">Select a time:</h3>

                        <input style="height:50px;display:none;" type = "date" required name = "change-time" class = "form-control sign-in-field" id="time-form"><br>

                        <select style="width:120px;height:30px" id="time-hour" onclick="choosetime()">
                            <option>Hour</option>
                            <option value="12">12</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>

                        <select style="width:100px;height:30px" id="time-minute" onclick="choosetime()">
                                <option>Minute</option>
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

                        <select style="width:100px;height:30px" id="time-meridian" onclick="choosetime()">
                                <option>AM/PM</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                        </select>

                    </div>
                    <script>
                        function choosetime()
                        {
                            var hour = document.getElementById("time-hour");
                            var minute = document.getElementById("time-minute");
                            var meridian = document.getElementById("time-meridian");

                            var selectedHour = hour.options[hour.selectedIndex].value;
                            var selectedMinute = minute.options[minute.selectedIndex].value;
                            var selectedMeridian = meridian.options[meridian.selectedIndex].value;
                            
                            document.getElementById("time-form").value = selectedHour +" "+ selectedMinute +" "+ selectedMeridian;
                        }
                    </script>

                    
                    <div class = "text-center">
                        <button onclick="window.scrollTo(0, document.body.scrollHeight);" type = "submit" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Save settings</button>
                    </div>
                    
                </form>
            </div>
        </div>    
    </div>
    
    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

</body>
<?php endforeach; ?>

</html>
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

</style>

<script type="text/javascript" src="<?php echo base_url("/js/user.js"); ?>"></script>

<script>
    document.cookie = "updatetime=0;path=/";
    document.cookie = "selectedWarning=0;path=/";   
    var ctr = 0;

    document.cookie = "defaultTimeSetting=cell8-A cell9-A cell10-A cell11-A cell12-A cell13-A cell14-A cell15-A cell16-A cell17-A cell18-A cell19-A cell20-A cell21-A cell22-A cell23-A cell24-A cell25-A cell26-A cell27-A cell28-A cell29-A cell30-A cell31-A cell32-A cell33-A cell34-A cell35-A cell36-A cell37-A cell38-A cell39-A cell40-A cell41-A cell42-A cell43-A cell44-A cell45-A cell46-A cell47-A cell48-A cell49-A;path=/";   

    document.cookie = "defaultWarningSetting=30;path=/"; 
    
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

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>

<body class = "sign-in">
    <div class = "container" style = "">
        <div class = "row">

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 4.5px;"><br>

                <div class = "col-xs-12 form-group register-field" style = "">

                    <?php if ($mobile): ?>
                        <h3 class = "col-xs-12 col-md-6 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Settings </strong></h3>
                         
                    <?php else: ?>
                        <h3 class = "col-xs-12 col-md-6 no-padding text-info pull-left"style = "margin-bottom: 0px; margin-top: 0px;">Settings for <b><?php echo $child->first_name ?></b></strong></h3>
                        
                    <?php endif; ?>
                    
                    </a>

                </div>

            </div>

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
           

            <div class = "col-md-8 col-md-offset-2 content-container container-fluid" style = "margin-bottom: 1vw;"><br>

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
                            <td style="font-size: 12px"><center>06:00-07:00</center></td>
                            <td id="cell1" onclick="colorchange(this.id)"> </td>
                            <td id="cell2" onclick="colorchange(this.id)"> </td>
                            <td id="cell3" onclick="colorchange(this.id)"> </td>
                            <td id="cell4" onclick="colorchange(this.id)"> </td>
                            <td id="cell5" onclick="colorchange(this.id)"> </td>
                            <td id="cell6" onclick="colorchange(this.id)"> </td>
                            <td id="cell7" onclick="colorchange(this.id)"> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px"><center>07:00-08:00</center></td>
                            <td id="cell8" onclick="colorchange(this.id)"> </td>
                            <td id="cell9" onclick="colorchange(this.id)"> </td>
                            <td id="cell10" onclick="colorchange(this.id)"> </td>
                            <td id="cell11" onclick="colorchange(this.id)"> </td>
                            <td id="cell12" onclick="colorchange(this.id)"> </td>
                            <td id="cell13" onclick="colorchange(this.id)"> </td>
                            <td id="cell14" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>08:00-09:00</center></td>
                            <td id="cell15" onclick="colorchange(this.id)"> </td>
                            <td id="cell16" onclick="colorchange(this.id)"> </td>
                            <td id="cell17" onclick="colorchange(this.id)"> </td>
                            <td id="cell18" onclick="colorchange(this.id)"> </td>
                            <td id="cell19" onclick="colorchange(this.id)"> </td>
                            <td id="cell20" onclick="colorchange(this.id)"> </td>
                            <td id="cell21" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>09:00-10:00</center></td>
                            <td id="cell22" onclick="colorchange(this.id)"> </td>
                            <td id="cell23" onclick="colorchange(this.id)"> </td>
                            <td id="cell24" onclick="colorchange(this.id)"> </td>
                            <td id="cell25" onclick="colorchange(this.id)"> </td>
                            <td id="cell26" onclick="colorchange(this.id)"> </td>
                            <td id="cell27" onclick="colorchange(this.id)"> </td>
                            <td id="cell28" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>10:00-11:00</center></td>
                            <td id="cell29" onclick="colorchange(this.id)"> </td>
                            <td id="cell30" onclick="colorchange(this.id)"> </td>
                            <td id="cell31" onclick="colorchange(this.id)"> </td>
                            <td id="cell32" onclick="colorchange(this.id)"> </td>
                            <td id="cell33" onclick="colorchange(this.id)"> </td>
                            <td id="cell34" onclick="colorchange(this.id)"> </td>
                            <td id="cell35" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>11:00-12:00</center></td>
                            <td id="cell36" onclick="colorchange(this.id)"> </td>
                            <td id="cell37" onclick="colorchange(this.id)"> </td>
                            <td id="cell38" onclick="colorchange(this.id)"> </td>
                            <td id="cell39" onclick="colorchange(this.id)"> </td>
                            <td id="cell40" onclick="colorchange(this.id)"> </td>
                            <td id="cell41" onclick="colorchange(this.id)"> </td>
                            <td id="cell42" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>12:00-01:00</center></td>
                            <td id="cell43" onclick="colorchange(this.id)"> </td>
                            <td id="cell44" onclick="colorchange(this.id)"> </td>
                            <td id="cell45" onclick="colorchange(this.id)"> </td>
                            <td id="cell46" onclick="colorchange(this.id)"> </td>
                            <td id="cell47" onclick="colorchange(this.id)"> </td>
                            <td id="cell48" onclick="colorchange(this.id)"> </td>
                            <td id="cell49" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>01:00-02:00</center></td>
                            <td id="cell50" onclick="colorchange(this.id)"> </td>
                            <td id="cell51" onclick="colorchange(this.id)"> </td>
                            <td id="cell52" onclick="colorchange(this.id)"> </td>
                            <td id="cell53" onclick="colorchange(this.id)"> </td>
                            <td id="cell54" onclick="colorchange(this.id)"> </td>
                            <td id="cell55" onclick="colorchange(this.id)"> </td>
                            <td id="cell56" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>02:00-03:00</center></td>
                            <td id="cell57" onclick="colorchange(this.id)"> </td>
                            <td id="cell58" onclick="colorchange(this.id)"> </td>
                            <td id="cell59" onclick="colorchange(this.id)"> </td>
                            <td id="cell60" onclick="colorchange(this.id)"> </td>
                            <td id="cell61" onclick="colorchange(this.id)"> </td>
                            <td id="cell62" onclick="colorchange(this.id)"> </td>
                            <td id="cell63" onclick="colorchange(this.id)"> </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px"><center>03:00-04:00</center></td>
                            <td id="cell64" onclick="colorchange(this.id)"> </td>
                            <td id="cell65" onclick="colorchange(this.id)"> </td>
                            <td id="cell66" onclick="colorchange(this.id)"> </td>
                            <td id="cell67" onclick="colorchange(this.id)"> </td>
                            <td id="cell68" onclick="colorchange(this.id)"> </td>
                            <td id="cell69" onclick="colorchange(this.id)"> </td>
                            <td id="cell70" onclick="colorchange(this.id)"> </td>
                        </tr>

                        
                    </table>
                </div>

                <br><br>

                
                <?php foreach ($usertimes->result() as $row): ?>
                

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
                    <button onclick="changeTimeSettings('time-table', 'td', 'cell');" data-toggle = "modal" class = "btn btn-success container-fluid col-xs-12" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">Save Changes</button>
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
        // alert(readstring);

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

            location.reload();

            <?php 
                if($_COOKIE["updatetime"])
                    echo $CI->user_model->set_usertimes($child->user_id, 0);
            ?>
        }

    </script>
<?php endforeach; ?>

</html>
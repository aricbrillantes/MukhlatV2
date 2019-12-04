<?php
    include(APPPATH . 'views/header.php');

    // header("Refresh: 60");

    $CI =&get_instance();
    $CI->load->model('attachment_model');

    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }

        $CI =&get_instance();
        $CI->load->model('user_model');
        $usertimes = $CI->user_model->get_usertimes($logged_user->user_id);
        // print_r($usertimes->row()->time_setting);

        $restrictions1 = explode(" ",$usertimes->row()->time_setting);
        $restrictions2 = [];
        // print_r($restrictions);

        include(APPPATH . 'views/scripts/restrictions.php');

        // print_r($restrictions2);

        date_default_timezone_set('Asia/Manila');
        $currentTime = date("G").date("i")." ".date("l");

        $currentTimeSlot; $nextTimeSlot;

        if( (int)date("i")>=00 && (int)date("i")<=30)
        {
            $currentTimeSlot = date("G")."00"." ".date("l");

        }    

        else if( (int)date("i")>=30)
        {
            $currentTimeSlot = date("G")."30"." ".date("l");
        }    

        // print($restrictions2[array_search($currentTimeSlot, $restrictions2)+1]);

        if(in_array($currentTimeSlot,$restrictions2))
        {
            //comment out this line for testing
            $home = base_url('home');
            // header("Location: $home");
        }    

        else if(!in_array($currentTimeSlot,$restrictions2))
        {
            // print("<br>you cant use xd");
            // $restrict = base_url('restrict');
            // header("Location: $restrict");
        }    

        // print("<b>Current time:</b> " . (int) date("G") . ": " . date("i") . " ". date("l"));
        // print("<br>");
        // print($currentTime . "<br>");
        // print($currentTimeSlot . "<br>");
        
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }
?>

<script>
    var restrictions =  <?php echo json_encode($restrictions2); ?>;
    
    function checkRestriction2()
    {
        
        var today = new Date();

        var time = today.getHours() + "" + today.getMinutes() + " " + day;

        var hour, min, day;
        var curTime, curHour, curMinute;

        switch(today.getDay())
        {
            case 0:day="Sunday";break;
            case 1:day="Monday";break;
            case 2:day="Tuesday";break;
            case 3:day="Wednesday";break;
            case 4:day="Thursday";break;
            case 5:day="Friday";break;
            case 6:day="Saturday";break;
        }

        //formatting "current timeslot" and "next timeslot"
        if(today.getMinutes()>=0 && today.getMinutes()<=30)
        {
            curHour=today.getHours();
            curMinute=0;

            if(curHour==0)
                curTime = "00" + curMinute + " " + day;
            

            else
                curTime = curHour + "00 " + day;
            
        }    

        else if(today.getMinutes()>=30)
        {
            curHour=today.getHours();
            curMinute=30;

            if(curHour==23)
            {
                switch((today.getDay())+1)
                {
                    case 0:day="Sunday";break;
                    case 1:day="Monday";break;
                    case 2:day="Tuesday";break;
                    case 3:day="Wednesday";break;
                    case 4:day="Thursday";break;
                    case 5:day="Friday";break;
                    case 6:day="Saturday";break;
                }

                curTime = curHour + "" + curMinute + " " + day;
            }

            else
                curTime = curHour + "" + curMinute + " " + day;
            

        }

        // checks if child cannot use for the current timeslot
        if(restrictions.includes(curTime))
        {

            // location.href="<?php echo base_url('home');?>";
        }

        // alert(curTime);

        setTimeout(checkRestriction2, 10000); //seconds x 1000
    } 

    checkRestriction2();
    

</script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" /> 
<body style="background-color: #f4fff6;">
    <br>
    <div class = "container col-sm-12 col-md-12 col-xs-12">
        <div class = "row">
            <div class = "col-sm-12 col-md-12 col-xs-12 home-container">
                <div class = "col-sm-12 col-md-12 col-xs-12 home-container text-center">
                    <br><br><br><br><br><h1>Hey there! You cannot use Mukhlat right now 😅<br><br>Come back later!</h1><br><br><br><br>

                    <!-- <h2>You can click this green button to check if you can use it again!😊.<br><br></h2>
                    <button class="container btn col-xs-4 col-xs-offset-4 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="background-color: green; color: white; font-size: 24px;" onclick="location.href='<?php echo base_url('home');?>'">Home</button> -->
                    
                    <!-- <h2>Or you can say goodbye for now 👋.</h2> -->
                    <br><br><button class="container btn col-xs-4 col-xs-offset-4 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="background-color: orange; color: white; font-size: 24px;" onclick="location.href='<?php echo base_url('signin/logout');?>'">Goodbye!</button>
                    
                    <!-- <br><br><button class = "btn" data-dismiss="modal" style="background-color: orange; color: black; font-size: 24px">No, take me back!</button> -->
                </div>


            </div>

        </div>
    </div>
</body>

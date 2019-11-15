<?php

    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }

        else if($_COOKIE["afk"] == 1)
        {
            session_destroy();
            // $this->session->sess_destroy();
        }

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
    }

    include(APPPATH . 'views/header.php'); 
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" /> 

<body style="background-color: #f4fff6;"><br>
    <div class = "container col-sm-12 col-md-12 col-xs-12">
        <div class = "row">
            <div class = "col-sm-12 col-md-12 col-xs-12 home-container">
                <br><br><br><br><br><br><br><br><br><br>
                <div class = "col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-12 col-md-offset-0  home-container text-center">
                    <h2>Oops, you were doing nothing for too long.<br><br>Goodbye! 👋<br><br></h2>

                    <button class="container btn col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="background-color: orange; color: white; font-size: 24px;" onclick="location.href='<?php echo base_url('signin/logout');?>'">Goodbye!</button>
                    
                    <!-- <br><br><button class = "btn" data-dismiss="modal" style="background-color: orange; color: black; font-size: 24px">No, take me back!</button> -->
                </div>
            </div>
        </div>
    </div>
</body>

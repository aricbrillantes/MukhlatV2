<?php
    include(APPPATH . 'views/header.php');

    //added an '@' to disable errors
    @$logged_user = $_SESSION['logged_user']; 
    if(!empty($logged_user))
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

?>
<script src="<?php echo base_url('zxcvbn-master/dist/zxcvbn.js'); ?>"></script>
<!-- browser tab icon -->
<link rel="icon" href="<?php echo base_url('./images/logo/mukhlatlogo_icon.png'); ?>" sizes="32x32"> 
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body id = "mainbody" class = "sign-in" style="background: #f2f2f2">
    <div class = "container-fluid ">
        <!-- Logo -->
        <div class = "row sign-in-logo"><img src = "<?php echo base_url('images/logo/mukhlatlogo1.png'); ?>" style="max-width: 30%; height: auto;"></div>

        <!-- Content -->
        <div id="sign-in-div" class = "row sign-in-content content-container container-fluid"  style="width:80% ">
            <!--Sign In-->
            <div class = "col-md-12 col-xs-12 col-md-offset-0 container-fluid" style = "margin-bottom: 30px;">
                <div id = "sign-in-container" class = "col-md-12 content-container no-padding">
                    <div class ="form-group">
                            <h3 class = "sign-in-header no-padding no-margin" style = "padding: 10px;"><strong id="login" >Hello! Welcome to Mukhlat!</strong></h3>
                        </div>

                    <form class = "form-inline text-center" id = "log-in-form" onsubmit = "return log_in()" method = "post">
                        
                        <div class = "row" style = "">
                            <div class = "form-group content-container container-fluid" style = "">
                                <input id = "log-in-email" type = "text" required name = "log_in_email" class = "form-control sign-in-field col-md-6 col-sm-12 col-xs-12" placeholder = "Email"/>
                            </div>
                            <div class = "form-group content-container container-fluid" style = "">
                                <input id = "log-in-password" type = "password" required name = "log_in_password"  class = "form-control sign-in-field col-md-6 col-sm-12col-xs-12" placeholder = "Password"/>
                            </div>
                            
                            <div class = "form-group text-center content-container container-fluid">
                                <button type="submit" class="btn btn-primary buttonsgo col-md-2 col-sm-12 col-xs-12"  id="loginbutton" style = "width: 100%;font-size:24px;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="change-sign-in-1" class="text-center" style="margin-top: 0">
                    <button onclick="changeUI()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;color:black"><br>Are you a parent? Click here!</button>
                </div>
            </div>

            <div id="change-sign-in-2" class="text-center" style="margin-top: 150px;  display: none">
                <button onclick="changeUI()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;color:black ">Are you a child? Click here!</button>
            </div>

            <!--Registration-->
            <div class = "col-md-10 col-md-offset-1" id="sign-up" style="display:none; margin-top: 25px" >

                <div id = "sign-up-container" class = "col-md-12 content-container no-padding">
                    <div class = "col-md-12 sign-in-div">
                        <h3 class = "sign-in-header"><strong>Sign Up for Mukhlat!</strong></h3>
                        <div class = "sign-in-form">
                            <form id = "sign-up-form" onsubmit = "return sign_up()" method = "post">

                                <div class = "col-xs-12 col-sm-2 col-md-12 form-group register-field content-container container-fluid" >
                                    <div class = "col-xs-12 col-sm-2 col-md-1 form-group register-field content-container container-fluid" style="margin-right: 25px">
                                        <p class = "text-muted"><strong>Role: </strong></p>
                                    </div>

                                    <div class = "col-xs-12 col-md-3 form-group register-field content-container container-fluid" >
                                        <select class = "form-control" name = "sign_up_role" id = "sign_up_role">
                                            <option value="2">Child</option>
                                            <option value="1">Administrator</option>
                                            <option value="3">Parent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class = "col-xs-12 col-md-6 form-group content-container container-fluid" style = "">
                                    <input type = "text" required name = "first_name" class = "form-control sign-in-field col-md-4 col-md-offset-0 " placeholder = "First Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid">
                                    <input type = "text" required name = "last_name" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Last Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid">
                                    <input type = "email" required id = "sign_up_email" name = "sign_up_email" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Email Address" maxlength = "45">
                                </div>
                                <div id="birthday-1" class = "col-xs-12 col-sm-auto col-md-2 form-group register-field content-container container-fluid" style="visibility: visible">
                                    <p class = "text-muted"><strong>Birthday: </strong></p>
                                </div>
                                <div id="birthday-2" class = "col-xs-12 col-sm-auto col-md-4 form-group register-field content-container container-fluid" style="visibility: visible">
                                    <input type = "date"  name = "sign_up_birthday" class = "form-control sign-in-field col-md-4 col-md-offset-0">
                                </div>
                                <div class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid">
                                    <input id = "sign-up-password" type = "password" required name = "sign_up_password" class = "form-control sign-in-field col-md-6 col-md-offset-0" placeholder = "Password">
                                </div>
                                <div class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid">
                                    <input id = "sign-up-retype" type = "password" required class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Retype Password">
                                </div>

                                <meter max="4" id="password-strength-meter" style="width:100%;"></meter>
                                <p id="password-strength-text"></p>

                                <div id="parent-email" class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid" style="visibility: visible">
                                    <input type = "email" id = "sign_up_email_parent" name = "sign_up_email_parent" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Parent' Email Address" maxlength = "45">
                                </div><br>
                                                           
                                <div id="sign-up-save" class = "text-center col-xs-12 col-md-12 form-group content-container container-fluid">
                                    <button type = "submit" class = "btn btn-success" style="width:100%;">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <style type="text/css">
        .content-container
        {
            border: 0px;
        }

        button
        {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

    </style>

</body>

<script type="text/javascript" src="<?php echo base_url("/js/sign_in.js"); ?>"></script>

<script>



    document.getElementById('sign_up_role').onchange = function() 
    {
        // alert(this.value);
        if(this.value === "2")
        {
            document.getElementById("parent-email").style.visibility = "visible";
            document.getElementById("sign_up_email_parent").value = document.getElementById("sign_up_email").value;
            document.getElementById("birthday-1").style.visibility = "visible";
            document.getElementById("birthday-2").style.visibility = "visible";
        }

        else
        {
            document.getElementById("parent-email").style.visibility = "hidden";
            document.getElementById("birthday-1").style.visibility = "hidden";
            document.getElementById("birthday-2").style.visibility = "hidden";
        }
    };

    var toggle = 0;

    function changeUI() 
    {
        var background = document.getElementById("mainbody").style.background;
        // alert(background);
        
        if (toggle==1) 
        {
            document.getElementById("mainbody").style.background = "#f2f2f2";
            document.getElementById("sign-up").style.display = "none";
            document.getElementById("change-sign-in-2").style.display = "none";
            document.getElementById("change-sign-in-1").style.display = "block";
            document.getElementById("login").innerHTML = "Hello! Welcome to Mukhlat!";
            toggle=0;
        } 

        else 
        {
            document.getElementById("mainbody").style.background = "#bfcfbf";
            document.getElementById("sign-up").style.display = "block";
            document.getElementById("change-sign-in-1").style.display = "none";
            document.getElementById("change-sign-in-2").style.display = "block";
            document.getElementById("login").innerHTML = "Log In";
            toggle=1;
        }

    }

    var strength =
        {
            0: "Worst",
            1: "Bad",
            2: "Weak",
            3: "Good",
            4: "Strong"
        };

    var password = document.getElementById('sign-up-password');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function ()
    {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "")
        {
            if (strength[result.score] === 'Worst' && password.value.length > 8)
            {
                text.innerHTML = "Strength: " + "<strong style='color:red'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:red'>" + "Your password is too short! Try using more letters and numbers!" + "<br>" + "<br></span";
                document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Worst' && password.value.length < 8)
            {
                text.innerHTML = "Strength: " + "<strong style='color:red'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:red'>" + "Your password is very easy to crack! Try using different letters and numbers!" + "<br>" + "<br></span";
                document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Bad' && password.value.length < 8)
            {
                text.innerHTML = "Strength: " + "<strong style='color:orange'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:orange'>" + "Your password is still easy to crack! Try using different letters and numbers!" + "<br>" + "<br></span";
                document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Weak')
            {
                text.innerHTML = "Strength: " + "<strong style='color:yellow'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:yellow'>" + "Your password is still easy to crack!" + "<br>" + "<br></span";
                document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Good')
            {
                text.innerHTML = "Strength: " + "<strong style='color:green'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:green'>" + "Your password is good!" + "<br>" + "<br></span";
                document.getElementById('sign-up-save').style.visibility = "visible";
            } else if (strength[result.score] === 'Strong')
            {
                text.innerHTML = "Strength: " + "<strong style='color:blue'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:blue'>" + "Your password is strong!" + "<br>" + "<br></span";
                document.getElementById('regisign-up-savester').style.visibility = "visible";
            }
        } else
        {
            text.innerHTML = "";
            document.getElementById('register').style.display = "visible";
        }
    });

</script>



</html>


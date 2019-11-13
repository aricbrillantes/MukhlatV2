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
<link rel="stylesheet" href="<?php echo base_url("/css/sign_in.css"); ?>" />
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
                            <h2 class = "sign-in-header no-padding no-margin" style = "padding: 10px;"><strong id="login" >Hello! Welcome to Mukhlat!</strong></h2>
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
                                <button type="submit" class="btn btn-primary buttonsgo col-md-2 col-sm-12 col-xs-12"  id="loginbutton" style = "width: 100%;font-size:24px;">Log In</button>
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

                                <div id = "sign-up-birthday" class = "col-xs-12 col-md-6 form-group register-field content-container container-fluid">
                                    <input style="height:55px;display:none;" type = "date" required name = "sign_up_birthday" class = "form-control sign-in-field" id="birhdate10">
                                    <select style="width:120px;height:30px" id="DOBMonth" onclick="choosebday()">
                                        <option>Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>

                                    <select style="width:100px;height:30px" id="DOBDay" onclick="choosebday()">
                                        <option>Day</option>
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
                                    </select>

                                    <select style="width:100px;height:30px" id="DOBYear" onclick="choosebday()">
                                        <option>Year</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                    </select>

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
                                    <input type = "email" id = "sign_up_email_parent" name = "sign_up_email_parent" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Parent' Email" maxlength = "45">
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

    function choosebday() 
    {
        var date1 = document.getElementById("DOBDay");
        var month1 = document.getElementById("DOBMonth");
        var year1 = document.getElementById("DOBYear");

        var selectedday = date1.options[date1.selectedIndex].value;
        var selectedmonth = month1.options[month1.selectedIndex].value;
        var selectedyear = year1.options[year1.selectedIndex].value;

        document.getElementById("birhdate10").value = selectedyear + "-" + selectedmonth + "-" + selectedday;
    }

    document.getElementById('sign_up_role').onchange = function() 
    {
        // alert(this.value);
        if(this.value === "2")
        {
            document.getElementById("parent-email").style.visibility = "visible";
            document.getElementById("sign_up_email_parent").value = document.getElementById("sign_up_email").value;
            document.getElementById("sign-up-birthday").style.visibility = "visible";
            // document.getElementById("birthday-2").style.visibility = "visible";
        }

        else
        {
            document.getElementById("parent-email").style.visibility = "hidden";
            document.getElementById("sign-up-birthday").style.visibility = "hidden";
            // document.getElementById("birthday-2").style.visibility = "hidden";
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
                // document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Worst' && password.value.length < 8)
            {
                text.innerHTML = "Strength: " + "<strong style='color:red'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:red'>" + "Your password is very easy to crack! Try using different letters and numbers!" + "<br>" + "<br></span";
                // document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Bad' && password.value.length < 8)
            {
                text.innerHTML = "Strength: " + "<strong style='color:orange'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:orange'>" + "Your password is still easy to crack! Try using different letters and numbers!" + "<br>" + "<br></span";
                // document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Weak')
            {
                text.innerHTML = "Strength: " + "<strong style='color:yellow'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:yellow'>" + "Your password is still easy to crack!" + "<br>" + "<br></span";
                // document.getElementById('sign-up-save').style.visibility = "hidden";
            } else if (strength[result.score] === 'Good')
            {
                text.innerHTML = "Strength: " + "<strong style='color:green'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:green'>" + "Your password is good!" + "<br>" + "<br></span";
                // document.getElementById('sign-up-save').style.visibility = "visible";
            } else if (strength[result.score] === 'Strong')
            {
                text.innerHTML = "Strength: " + "<strong style='color:blue'>" + strength[result.score] + "</strong>" + "<br><span class='feedback' style='color:blue'>" + "Your password is strong!" + "<br>" + "<br></span";
                // document.getElementById('regisign-up-savester').style.visibility = "visible";
            }
        } else
        {
            text.innerHTML = "";
            document.getElementById('register').style.display = "visible";
        }
    });

</script>



</html>


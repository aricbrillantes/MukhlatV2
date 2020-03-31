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

<body id = "mainbody" class = "sign-in" style="background: #daf0eb">
    <div class = "container-fluid col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <!-- Logo -->
        <div class = "row sign-in-logo"><img src = "<?php echo base_url('images/logo/mukhlatlogo1.png'); ?>" style="max-width: 30%; height: auto;"></div>

        <!-- Content -->
        <div id="sign-in-div" class = "row sign-in-content content-container container-fluid col-xs-12 col-md-12 col-sm-12"  style="width:100% ">
            <!--Sign In-->
            <div class = "col-md-12 col-xs-12 col-md-offset-0 container-fluid" style = "margin-bottom: 30px;">
                <div id = "sign-in-container" class = "col-md-12 content-container no-padding">
                    <div class ="form-group">
                            <h2 class = "sign-in-header no-padding no-margin" style = "padding: 10px;"><strong id="login" >Hello! Welcome to Mukhlat!</strong></h2>
                        </div>

                    <form class = "form-inline text-center" id = "log-in-form" onsubmit = "return log_in()" method = "post">

                        <div class = "row" style = "">
                            <div class = "form-group content-container container-fluid" style = "">
                                <input readonly onfocus="this.removeAttribute('readonly');" id = "log-in-email" type = "text" required name = "log_in_email" class = "secure form-control sign-in-field col-md-6 col-sm-12 col-xs-12" placeholder = "Email"/>
                            </div>
                            <div class = "form-group content-container container-fluid" style = "">
                                <input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />
                                <input readonly onfocus="this.removeAttribute('readonly');" id = "log-in-password" type = "password" required name = "log_in_password"  class = "secure form-control sign-in-field col-md-6 col-sm-12col-xs-12" placeholder = "Password"/>
                            </div>

                            <div class = "form-group text-center content-container container-fluid">
                                <button type="submit" class="btn btn-primary buttonsgo col-md-2 col-sm-12 col-xs-12"  id="loginbutton" style = "width: 100%;font-size:24px;">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="change-sign-in-1" class="text-center" style="margin-top: 0">
                    <button onclick="changeUI()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;color:black"><br>Don't have an account? Click here!</button>
                </div>
            </div>

            <div id="change-sign-in-2" class="text-center" style="margin-top: 150px;  display: none">
                <button onclick="changeUI()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;color:black ">Already have an account? Click here!</button>
            </div>

            <!--Registration-->
            <div class = "col-md-10 col-md-offset-1" id="sign-up" style="display:none; margin-top: 25px" >

                <div id = "sign-up-container" class = "col-md-12 content-container no-padding">
                    <div class = "col-md-12 sign-in-div">
                        <h3 class = "sign-in-header"><strong>Sign Up for Mukhlat!</strong></h3>
                        <div class = "sign-in-form">
                            <form id = "sign-up-form" onsubmit = "return sign_up()" method = "post">

                                <div class = "col-xs-12 col-sm-12 col-md-12 form-group register-field content-container container-fluid" >
                                    <div class = "col-xs-12 col-sm-2 col-md-1 form-group register-field content-container container-fluid" style="margin-right: 0px">
                                        <p class = "text-muted"><strong>Role: </strong></p>
                                    </div>

                                    <div class = "col-xs-12 col-sm-3 col-md-3 form-group register-field content-container container-fluid" >
                                        <select class = "form-control" name = "sign_up_role" id = "sign_up_role" style="font-size: 13px">
                                            <option value="2">Child</option>
                                            <option value="1">Teacher</option>
                                            <option value="3">Parent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class = "col-xs-12 col-sm-6 col-md-6  form-group content-container container-fluid" style = "height: 54px">
                                    <input type = "text" required name = "first_name" class = "form-control sign-in-field col-md-4 col-md-offset-0 " placeholder = "First Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid" style = "height: 54px">
                                    <input type = "text" required name = "last_name" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Last Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid" style = "height: 54px">
                                    <input readonly onfocus="this.removeAttribute('readonly');" type = "text" required id = "sign_up_email" name = "sign_up_email" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Username" maxlength = "45">
                                </div>

                                <div id = "sign-up-birthday" class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid row" style = "height:auto; min-height: 54px; margin-left:0px">
                                    <input style="display:none; " type = "date" required name = "sign_up_birthday" class = "form-control sign-in-field" id="birthdate10">

                                    <div class = "col-xs-12 col-sm-2 col-md-2 container-fluid">
                                        <p class = "text-muted no-margin"><strong>Birthdate:</strong></p>
                                    </div>

                                    <div class = "col-xs-12 col-sm-12 col-md-12 content-container container-fluid row" style="margin-left: 5px">
                                        <select class = "form-control col-md-6 col-sm-12 col-xs-12" style="height:auto;max-width:40%;max-height:30px;font-size:12px" id="DOBMonth" onclick="choosebday()">
                                            <option value="00">Month</option>
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

                                        <select class = "form-control col-md-12 col-sm-4 col-xs-4" style="height:auto;max-width:30%;max-height:30px;font-size: 12px" id="DOBDay" onclick="choosebday()">
                                            <option value="00">Day</option>
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

                                        <select class = "form-control col-md-12 col-sm-4 col-xs-4" style="height:auto;max-width:30%;max-height:30px;font-size: 12px" id="DOBYear" onclick="choosebday()">
                                            <option value="0000">Year</option>
                                            <option value="1900">1900</option>
                                            <option value="1901">1901</option>
                                            <option value="1902">1902</option>
                                            <option value="1903">1903</option>
                                            <option value="1904">1904</option>
                                            <option value="1905">1905</option>
                                            <option value="1906">1906</option>
                                            <option value="1907">1907</option>
                                            <option value="1908">1908</option>
                                            <option value="1909">1909</option>
                                            <option value="1910">1910</option>
                                            <option value="1911">1911</option>
                                            <option value="1912">1912</option>
                                            <option value="1913">1913</option>
                                            <option value="1914">1914</option>
                                            <option value="1915">1915</option>
                                            <option value="1916">1916</option>
                                            <option value="1917">1917</option>
                                            <option value="1918">1918</option>
                                            <option value="1919">1919</option>
                                            <option value="1920">1920</option>
                                            <option value="1921">1921</option>
                                            <option value="1922">1922</option>
                                            <option value="1923">1923</option>
                                            <option value="1924">1924</option>
                                            <option value="1925">1925</option>
                                            <option value="1926">1926</option>
                                            <option value="1927">1927</option>
                                            <option value="1928">1928</option>
                                            <option value="1929">1929</option>
                                            <option value="1930">1930</option>
                                            <option value="1931">1931</option>
                                            <option value="1932">1932</option>
                                            <option value="1933">1933</option>
                                            <option value="1934">1934</option>
                                            <option value="1935">1935</option>
                                            <option value="1936">1936</option>
                                            <option value="1937">1937</option>
                                            <option value="1938">1938</option>
                                            <option value="1939">1939</option>
                                            <option value="1940">1940</option>
                                            <option value="1941">1941</option>
                                            <option value="1942">1942</option>
                                            <option value="1943">1943</option>
                                            <option value="1944">1944</option>
                                            <option value="1945">1945</option>
                                            <option value="1946">1946</option>
                                            <option value="1947">1947</option>
                                            <option value="1948">1948</option>
                                            <option value="1949">1949</option>
                                            <option value="1950">1950</option>
                                            <option value="1951">1951</option>
                                            <option value="1952">1952</option>
                                            <option value="1953">1953</option>
                                            <option value="1954">1954</option>
                                            <option value="1955">1955</option>
                                            <option value="1956">1956</option>
                                            <option value="1957">1957</option>
                                            <option value="1958">1958</option>
                                            <option value="1959">1959</option>
                                            <option value="1960">1960</option>
                                            <option value="1961">1961</option>
                                            <option value="1962">1962</option>
                                            <option value="1963">1963</option>
                                            <option value="1964">1964</option>
                                            <option value="1965">1965</option>
                                            <option value="1966">1966</option>
                                            <option value="1967">1967</option>
                                            <option value="1968">1968</option>
                                            <option value="1969">1969</option>
                                            <option value="1970">1970</option>
                                            <option value="1971">1971</option>
                                            <option value="1972">1972</option>
                                            <option value="1973">1973</option>
                                            <option value="1974">1974</option>
                                            <option value="1975">1975</option>
                                            <option value="1976">1976</option>
                                            <option value="1977">1977</option>
                                            <option value="1978">1978</option>
                                            <option value="1979">1979</option>
                                            <option value="1980">1980</option>
                                            <option value="1981">1981</option>
                                            <option value="1982">1982</option>
                                            <option value="1983">1983</option>
                                            <option value="1984">1984</option>
                                            <option value="1985">1985</option>
                                            <option value="1986">1986</option>
                                            <option value="1987">1987</option>
                                            <option value="1988">1988</option>
                                            <option value="1989">1989</option>
                                            <option value="1990">1990</option>
                                            <option value="1991">1991</option>
                                            <option value="1992">1992</option>
                                            <option value="1993">1993</option>
                                            <option value="1994">1994</option>
                                            <option value="1995">1995</option>
                                            <option value="1996">1996</option>
                                            <option value="1997">1997</option>
                                            <option value="1998">1998</option>
                                            <option value="1999">1999</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                        </select>
                                    </div>
                                </div>

                                <div class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid" style = "height: 54px">
                                    <input readonly onfocus="this.removeAttribute('readonly');" id = "sign-up-password" type = "password" required name = "sign_up_password" class = "secure form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Password">
                                </div>
                                <div class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid" style = "height: 54px">
                                    <input readonly onfocus="this.removeAttribute('readonly');" id = "sign-up-retype" type = "password" required class = "secure form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Retype Password">
                                </div>

                                <div id="parent-email" class = "col-xs-12 col-sm-6 col-md-6 form-group register-field content-container container-fluid" style="visibility: visible">
                                    <input readonly onfocus="this.removeAttribute('readonly');" type = "text" id = "sign_up_email_parent" name = "sign_up_email_parent" class = "form-control sign-in-field col-md-4 col-md-offset-0" placeholder = "Parent's Username" maxlength = "45">
                                </div><br> <br>

                                <meter max="4" id="password-strength-meter" style="width:100%;"></meter>
                                <p id="password-strength-text"></p>

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

    document.cookie = "sessionWarning=0;" + ";path=/";
    document.cookie = "cookiewarning=0;" + ";path=/";

   function choosebday()
    {
        var date1 = document.getElementById("DOBDay");
        var month1 = document.getElementById("DOBMonth");
        var year1 = document.getElementById("DOBYear");

        var selectedday = date1.options[date1.selectedIndex].value;
        var selectedmonth = month1.options[month1.selectedIndex].value;
        var selectedyear = year1.options[year1.selectedIndex].value;

        document.getElementById("birthdate10").value = selectedyear + "-" + selectedmonth + "-" + selectedday;
    }

    var i;
    for(i=1;i<101;i++)
        document.getElementById("DOBYear").options[i].style.display= "none";

    document.getElementById('sign_up_role').onchange = function()
    {
        if(this.value === "2")
        {
            document.getElementById("parent-email").style.visibility = "visible";
            document.getElementById("sign_up_email_parent").value = document.getElementById("sign_up_email").value;
            document.getElementById("sign-up-birthday").style.visibility = "visible";
            // document.getElementById("birthday-2").style.visibility = "visible";

            var i;
            for(i=1;i<101;i++)
            {
                document.getElementById("DOBYear").options[i].style.display= "none";
            }

            document.getElementById("DOBMonth").options[0].selected = true;
            document.getElementById("DOBYear").options[0].selected = true;
            document.getElementById("DOBDay").options[0].selected = true;
        }

        else
        {
            document.getElementById("parent-email").style.visibility = "hidden";
            // document.getElementById("sign-up-birthday").style.visibility = "hidden";
            // document.getElementById("birthday-2").style.visibility = "hidden";

            var i;
            for(i=1;i<101;i++)
            {
                document.getElementById("DOBYear").options[i].style.display= "block";
            }

            document.getElementById("DOBYear").options[0].selected = true;

        }
    };

    document.getElementById('DOBMonth').onchange = function()
    {
        if(this.value === "02")
        {
            if(document.getElementById("DOBDay").options[30].selected == true || document.getElementById("DOBDay").options[31].selected == true)
                document.getElementById("DOBDay").options[0].selected = true;

            document.getElementById("DOBDay").options[30].style.display= "none";
            document.getElementById("DOBDay").options[31].style.display= "none";
            // document.getElementById("DOBDay").options[32].style.display= "none";
        }

        else if(this.value === "01" || this.value === "03" || this.value === "05" || this.value === "07"
            || this.value === "08" || this.value === "10" || this.value === "12")
        {
            // document.getElementById("DOBDay").options[0].selected = true;
            document.getElementById("DOBDay").options[30].style.display= "block";
            document.getElementById("DOBDay").options[31].style.display= "block";
            // document.getElementById("DOBDay").options[32].style.display= "block";
        }

        else if(this.value === "00")
        {
            document.getElementById("DOBDay").options[0].selected = true;
            document.getElementById("DOBDay").options[30].style.display= "block";
            document.getElementById("DOBDay").options[31].style.display= "block";
        }

        else
        {
            if(document.getElementById("DOBDay").options[31].selected == true)
                document.getElementById("DOBDay").options[0].selected = true;

            document.getElementById("DOBDay").options[30].style.display= "block";
            document.getElementById("DOBDay").options[31].style.display= "none";
        }
    }

    var toggle = 0;

    function changeUI()
    {
        var background = document.getElementById("mainbody").style.background;
        // alert(background);

        if (toggle==1)
        {
            document.getElementById("mainbody").style.background = "#daf0eb";
            document.getElementById("sign-up").style.display = "none";
            document.getElementById("change-sign-in-2").style.display = "none";
            document.getElementById("change-sign-in-1").style.display = "block";
            // document.getElementById("login").innerHTML = "Hello! Welcome to Mukhlat!";
            toggle=0;
        }

        else
        {
            document.getElementById("mainbody").style.background = "#f2f2f2";
            document.getElementById("sign-up").style.display = "block";
            document.getElementById("change-sign-in-1").style.display = "none";
            document.getElementById("change-sign-in-2").style.display = "block";
            // document.getElementById("login").innerHTML = "Log In";
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


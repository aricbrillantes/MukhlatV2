function log_in() 
{
    $("#sign-in-message").remove();
    $.ajax({
        type: "POST",
        url: "signin/login",
        data: $("#log-in-form").serialize(),
        success: function (data) 
        {
            if (data != '0') 
            {
                window.location.href = "home";
            } 

            else 
            {
                $("<div id = \"sign-in-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px; font-size:24px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Invalid username/password! Please try again.</i></span></div>").hide().appendTo("#sign-in-container").show("fast");
            }
        }
    });

    return false;
}

function sign_up() {
    $("#sign-up-message").remove();

    if (check_values()) 
    {
        $.ajax({
            type: "POST",
            url: "signin/signup",
            data: $("#sign-up-form").serialize(),
            success: function (data) 
            {

                /*
                    0 email taken
                    1 or 2 success
                    3
                    4 birthday empty
                    5 parent email is blank or doesnt exist
                    6
                    7
                    8
                    9 
                */

                if (data == '1' || data == '2') 
                {
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-success\"><i class = \"fa fa-check\"></i> <i>Signing up successful! Your account is pending activation from an Administrator</i></span></div>").hide().appendTo("#sign-up-container").show("fast");
                    $("#sign-up-form").trigger("reset");
                } 

                else if (data == '4')
                {
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Oops! You haven't entered your birth date!</i></span></div>").hide()
                        .appendTo("#sign-up-container").show("fast");
                }

                else if (data == '5')
                {
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Oops! That parent user account does not exist!</i></span></div>").hide()
                        .appendTo("#sign-up-container").show("fast");
                }

                else if (data == '0')
                {
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Oops! The username you entered is already taken!</i></span></div>").hide()
                        .appendTo("#sign-up-container").show("fast");
                }
            }
        });
    } 

    else 
    {
        $(".password-field").addClass("has-error");
        $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Oops! Passwords do not match!</i></span></div>").hide().appendTo("#sign-up-container").show("fast");
    }
    return false;
}

function check_values() 
{
    var pass = document.getElementById("sign-up-password").value;
    var retype = document.getElementById("sign-up-retype").value;

    return pass === retype;
}
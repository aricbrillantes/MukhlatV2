function log_in() {
    $("#sign-in-message").remove();
    $.ajax({
        type: "POST",
        url: "signin/login",
        data: $("#log-in-form").serialize(),
        success: function (data) {
            if (data === '1') {
                window.location.href = "home";
            } else {
                $("<div id = \"sign-in-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px; font-size:24px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Invalid username/password! Please try again.</i></span></div>").hide().appendTo("#sign-in-container").show("fast");
            }
        }
    });

    return false;
}

function sign_up() {
    $("#sign-up-message").remove();
    if (check_values()) {
        $.ajax({
            type: "POST",
            url: "signin/signup",
            data: $("#sign-up-form").serialize(),
            success: function (data) {
                if (data === '1') {
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-success\"><i class = \"fa fa-check\"></i> <i>Signing up successful! Your account is pending activation from an Administrator</i></span></div>").hide().appendTo("#sign-up-container").show("fast");
                    $("#sign-up-form").trigger("reset");
                } else{
                    $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Oops! The e-mail address you entered is already taken!</i></span></div>").hide()
                            .appendTo("#sign-up-container").show("fast");
                }
            }
        });
    } else {
        $(".password-field").addClass("has-error");
        $("<div id = \"sign-up-message\" class = \"col-md-12 text-center\" style = \"padding-bottom: 10px;\"><span class = \"text-warning\"><i class = \"fa fa-warning\"></i> <i>Passwords do not match!</i></span></div>").hide().appendTo("#sign-up-container").show("fast");
    }
    return false;
}

function check_values() {
    var pass = $(".sign-up-password");
    var retype = $("#sign-up-retype");

    return pass.val() === retype.val();
}
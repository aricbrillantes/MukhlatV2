<?php
include(APPPATH . 'views/header.php');
?>
<body class = "sign-in">
    <div class = "container-fluid">
        <!-- Logo -->
        <div class = "row sign-in-logo"><img src = "<?php echo base_url('images/logo/logo-white.png'); ?>"></div>

        <!-- Content -->
        <div class = "row sign-in-content">
            <!--Sign In-->
            <div class = "col-md-10 col-md-offset-1" style = "margin-bottom: 30px;">
                <div id = "sign-in-container" class = "col-md-12 content-container no-padding">
                    <form class = "form-inline" id = "log-in-form" onsubmit = "return log_in()" method = "post">
                        <div class ="form-group">
                            <h3 class = "sign-in-header no-padding no-margin" style = "margin-left: 40px; padding: 10px;"><strong>Log In</strong></h3>
                        </div>
                        <div class = "pull-right" style = "padding-top: 10px; padding-right: 10px; padding-bottom: 10px">
                            <div class = "form-group" style = "margin-right: 5px;">
                                <input id = "log-in-email" type = "text" required name = "log_in_email" class = "form-control sign-in-field" placeholder = "Email"/>
                            </div>
                            <div class = "form-group" style = "margin-right: 5px;">
                                <input id = "log-in-password" type = "password" required name = "log_in_password"  class = "form-control sign-in-field" placeholder = "Password"/>
                            </div>
                            <div class = "form-group text-center">
                                <button type="submit" class="btn btn-primary" style = "width: 100%;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--Registration-->
            <div class = "col-md-10 col-md-offset-1">
                <div id = "sign-up-container" class = "col-md-12 content-container no-padding">
                    <div class = "col-md-12 sign-in-div">
                        <h3 class = "sign-in-header"><strong>Sign Up for GetTogether!</strong></h3>
                        <div class = "sign-in-form">
                            <form id = "sign-up-form" onsubmit = "return sign_up()" method = "post">
                                <div class = "col-xs-6 form-group register-field">
                                    <input type = "text" required name = "first_name" class = "form-control sign-in-field" placeholder = "First Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-6 form-group register-field">
                                    <input type = "text" required name = "last_name" class = "form-control sign-in-field" placeholder = "Last Name" maxlength = "25">
                                </div>
                                <div class = "col-xs-12 form-group register-field">
                                    <input type = "email" required name = "sign_up_email" class = "form-control sign-in-field" placeholder = "Email Address" maxlength = "45">
                                </div>
                                <div class = "col-xs-2 text-center register-field">
                                    <h5 class = "text-muted"><strong>Birthday: </strong></h5>
                                </div>
                                <div class = "col-xs-4 form-group register-field">
                                    <input type = "date" required name = "sign_up_birthday" class = "form-control sign-in-field">
                                </div>
                                <div class = "col-xs-1 text-center register-field">
                                    <h5 class = "text-muted"><strong>Role: </strong></h5>
                                </div>
                                <div class = "col-xs-5 form-group register-field">
                                    <select class = "form-control" name = "sign_up_role">
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class = "password-field col-xs-6 form-group register-field">
                                    <input id = "sign-up-password" type = "password" required name = "sign_up_password" class = "form-control sign-in-field" placeholder = "Password">
                                </div>
                                <div class = "password-field col-xs-6 form-group register-field">
                                    <input id = "sign-up-retype" type = "password" required class = "form-control sign-in-field" placeholder = "Retype Password">
                                </div>
                                <div class = "text-center">
                                    <button type = "submit" class = "btn btn-success" style="width:100%;">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url("/js/sign_in.js"); ?>"></script>
</body>
</html>

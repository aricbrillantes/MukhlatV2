<?php
$logged_user = $_SESSION['logged_user'];
$unanswered = $logged_user->unanswered_invites + $logged_user->unanswered_requests;
?>

<!-- Nav Bar -->
<nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "box-shadow: 0px 1px 2px #ccc;">
    <div class = "container-fluid">
        <div class = "navbar-header" style = "margin-left: 50px;">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class = "navbar-brand" href = "<?php echo base_url('home') ?>"><img id = "nav-logo" src = "<?php echo base_url('images/logo/logo-blue.png'); ?>"/></a>
        </div>
        <div class = "collapse navbar-collapse" id = "nav-collapse">
            <ul class = "nav navbar-nav">
                <li><a href="<?php echo base_url('home') ?>"><strong>Home</strong></a></li>
                <li><a href="<?php echo base_url('topic') ?>"><strong>Topics</strong></a></li>
            </ul>
            <div class = "search-div nav-right-end">
                <form action = "<?php echo base_url('search'); ?>" class="navbar-form navbar-left" role = "search" method = "GET">
                    <div class="input-group">
                        <input required type="text" name = "search-key" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default search-btn" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class = "nav navbar-nav navbar-right" style = "margin-right: 5px;">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <img class = "img-rounded nav-prof-pic" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/> 
                            <?php echo $logged_user->first_name . " " . $logged_user->last_name; ?>
                            <?php if ((int) $logged_user->unread_notifs + $unanswered > 0): ?>
                                <span id = "notif-label" class = "label label-info label-badge"><?php echo $logged_user->unread_notifs + $unanswered ?></span>
                            <?php endif; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>"><i class = "fa fa-user"></i> My Profile</a></li>
                            <li><a href="#invites-modal" data-toggle = "modal">
                                    <i class = "fa fa-users"></i> Invites 
                                    <?php if ((int) $unanswered > 0): ?>
                                        <span class = "badge"><?php echo $unanswered ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li><a id = "notif-btn" href="#notif-modal" data-toggle = "modal" <?php echo (int) $logged_user->unread_notifs > 0 ? "data-value = \"" . $logged_user->unread_notifs . "\"" : "" ?>>
                                    <i class = "glyphicon glyphicon-exclamation-sign"></i> Notifications 
                                    <?php if ((int) $logged_user->unread_notifs > 0): ?>
                                        <span id = "notif-badge" class = "badge"><?php echo $logged_user->unread_notifs ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url('signin/logout'); ?>"><i class = "glyphicon glyphicon-log-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>
<!-- End Nav Bar -->

<?php include(APPPATH . 'views/modals/notifications_modal.php'); ?>
<?php include(APPPATH . 'views/modals/invites_modal.php'); ?>
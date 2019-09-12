<?php
include(APPPATH . 'views/header.php');
$logged_user = $_SESSION['logged_user'];
?>
<body class = "sign-in">
    <div class = "container" style = "margin-top: 30px;">
        <div class = "row">
            <div class = "col-md-8 col-md-offset-2 content-container no-padding" style = "margin-bottom: 5px;">
                <a class = "pull-left btn btn-topic-header" style = "display: inline-block; margin-right: 5px;" href="<?php echo base_url('home') ?>">
                    <h3 class = "pull-left" style = "margin-top: 3px; margin-bottom: 0px; padding: 2px;">
                        <strong class = "text-info"><i class = "fa fa-chevron-left"></i> 
                            Back
                        </strong>
                    </h3>
                </a>
                <h3 class = "text-info no-margin" style = "display: inline-block; padding-left: 10px; margin-top: 5px; padding-top: 10px;"><strong><?php echo $logged_user->first_name . " " . $logged_user->last_name ?></strong></h3>
                <a href = "<?php echo base_url('signin/logout'); ?>" class = "pull-right btn btn-primary btn-md" style = "margin-right: 20px; margin-top: 10px;">Log Out</a>
            </div>
            <div class = "col-md-8 col-md-offset-2 content-container" style = "margin-bottom: 5px;">
                <div class = "col-sm-12 text-center" style = "margin-bottom: 10px;"><h3 id = "network-header" class = "no-margin">Interaction Network Map within GetTogether</h3></div>
                <div id = "network-tools" class = "col-sm-12" style = "margin-bottom: 10px;">
                    <div class = "col-xs-8 col-md-offset-2">
                        <button id = "reset-map" class = "btn btn-block btn-primary">Reset Interaction Map</button>
                    </div>
                </div>
                <div class = "col-sm-12 content-container"><div id = "interaction-network"></div></div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/vis/vis.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/network.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/vis/vis.css"); ?>" />

    <?php
    include(APPPATH . 'views/modals/network_view_modal.php');
    ?>

</body>
</html>
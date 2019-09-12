<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 

    //checks if client is mobile
    //this doesn't need to be in every file, but it ensures consistency
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- scale to device resolution -->


        <link rel="icon" href="<?php echo base_url('./images/logo/mukhlatlogo_NoText.png'); ?>"> <!-- browser tab icon -->
        <link rel="icon" type="image/png" href="<?php echo base_url("/icons/favicon-32x32.png"); ?>" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url("/icons/favicon-16x16.png"); ?>" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url("/icons/manifest.json"); ?>">
        <link rel="mask-icon" href="<?php echo base_url("/icons/safari-pinned-tab.svg"); ?>" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <meta charset="utf-8">
        <title>Mukhlat</title>
        <link href="https://fonts.googleapis.com/css?family=Cabin|Muli|Oswald" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/font-awesome.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-3.1.1.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/fusioncharts/fusioncharts.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/fusioncharts/themes/fusioncharts.theme.ocean.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/fusioncharts/themes/fusioncharts.theme.fint.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/fusioncharts/themes/fusioncharts.theme.zune.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/fusioncharts/themes/fusioncharts.theme.carbon.js"); ?>"></script>
    </head>


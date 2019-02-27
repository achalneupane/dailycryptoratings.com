<?php
defined('BASEPATH') OR exit('No direct script access allowed');

        $this->config =& get_config();
        $base_url = $this->config['base_url'];

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?=$base_url?>include/images/favicon_1.ico">

       
         <title>Employee Attendance System</title>

        <link href="<?= $base_url?>include/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base_url?>include/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base_url?>include/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base_url?>include/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base_url?>include/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base_url?>include/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?=$base_url?>include/js/modernizr.min.js"></script>
        
    </head>
    <body>

    	<div class="account-pages"></div>
		<div class="clearfix"></div>
		
        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">4</span></div>
                <h2>Who0ps! Page not found</h2><br>
                <p class="text-muted">This page cannot found or is missing.</p>
                <p class="text-muted">Use the navigation above or the button below to get back and track.</p>
                <br>
                <a class="btn btn-default waves-effect waves-light" href="<?php echo $base_url;?>"> Return Home</a>
                
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?=$base_url?>include/js/jquery.min.js"></script>
        <script src="<?=$base_url?>include/js/bootstrap.min.js"></script>
        <script src="<?=$base_url?>include/js/detect.js"></script>
        <script src="<?=$base_url?>include/js/fastclick.js"></script>
        <script src="<?=$base_url?>include/js/jquery.slimscroll.js"></script>
        <script src="<?=$base_url?>include/js/jquery.blockUI.js"></script>
        <script src="<?=$base_url?>include/js/waves.js"></script>
        <script src="<?=$base_url?>include/js/wow.min.js"></script>
        <script src="<?=$base_url?>include/js/jquery.nicescroll.js"></script>
        <script src="<?=$base_url?>include/js/jquery.scrollTo.min.js"></script>


        <script src="<?=$base_url?>include/js/jquery.core.js"></script>
        <script src="<?=$base_url?>include/js/jquery.app.js"></script>
	
	</body>
</html>
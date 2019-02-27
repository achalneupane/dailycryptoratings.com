<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Daily Crypto Ratings</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
<!--        <link rel="icon" type="image/png" href="<? base_url() ?>include/images/icons/favicon.ico"/>-->
        <link rel="shortcut icon" href="<?= base_url() ?>include/images/icons/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url() ?>include/images/icons/favicon.ico" type="image/x-icon">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/vendor/perfect-scrollbar/perfect-scrollbar.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/css/util.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>include/css/main.css">
        <!--===============================================================================================-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Enable media queries on older browsers -->
    <!--[if lt IE 9]>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fff;">
            <a class="navbar-brand" href="<?= base_url() ?>"><img alt="Brand" src="<?= base_url() . "include/images/logo.png" ?>" ></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php
                    if ($this->uri->segment(1) == "") {
                        echo 'active';
                    }
                    ?>">
                        <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?php
                    if ($this->uri->segment(1) == "about") {
                        echo 'active';
                    }
                    ?>">
                        <a class="nav-link" href="<?= base_url() . "about" ?>">About</a>
                    </li>
                    <li class="nav-item <?php
                    if ($this->uri->segment(1) == "disclaimer") {
                        echo 'active';
                    }
                    ?>">
                        <a class="nav-link" href="<?= base_url() . "disclaimer" ?>">Disclaimer</a>
                    </li>
                    <li class="nav-item <?php
                    if ($this->uri->segment(1) == "contact") {
                        echo 'active';
                    }
                    ?>">
                        <a class="nav-link" href="<?= base_url() . "contact" ?>">Contact</a>
                    </li>
                    <li class="nav-item ">
                        <form id="coinSearch" class="form-inline" action="<?=  base_url()?>" method="GET">
                            <input id="suggest" class="form-control mr-sm-2" type="text" name="search" placeholder="Search" required>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </li>
                </ul>



                <?php if ($this->session->userdata('userEmail') != '') { ?>
                    <div class="navBaremail" ><?= $this->session->userdata('userName') ?></div>
                <?php }
                ?>
                <a href="<?php
                if ($this->session->userdata('userEmail') != '') {
                    echo base_url() . "login/logout";
                } else {
                    echo base_url() . "login";
                }
                ?>" class="btn btn-primary btn-login"><?php
                   if ($this->session->userdata('userEmail') != '') {
                       echo "Logout";
                   } else {
                       echo 'Login';
                   }
                   ?></a>
            </div>
        </nav>

        <style>

        </style>

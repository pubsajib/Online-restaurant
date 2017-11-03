
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="Egprojets">
    <meta name="description" content="" />
    <title>Food Lover</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Architects+Daughter" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" />
    <!-- End Google Fonts -->

    <!-- Contribute CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Contribute End CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/assets/customer/css/awesome-check.css">

    <!-- Custom CSS Files -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/responsive.css" />
    <!-- Custom CSS Files -->

    <!-- google map JS Files -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <style>
        .newspaper {
            -webkit-column-count: 3; /* Chrome, Safari, Opera */
            -moz-column-count: 3; /* Firefox */
            column-count: 3;
            -webkit-column-gap: 40px; /* Chrome, Safari, Opera */
            -moz-column-gap: 40px; /* Firefox */
            column-gap: 40px;
            -webkit-column-rule: 1px solid lightblue; /* Chrome, Safari, Opera */
            -moz-column-rule: 1px solid lightblue; /* Firefox */
            column-rule: 1px solid lightblue;
        }

        h2 {
            -webkit-column-span: all; /* Chrome, Safari, Opera */
            column-span: all;
        }

        .processing {
            margin: 350px auto 0 auto;
            height: 50px;
            width: 250px;
            color: #fff;
            font-size: 18px;
            text-align: center;
            line-height: 2.9;
        }
    </style>

</head>

<body>

<!-- Loader Bloc -->
<!--div class="site-loader" style="display: none;">
    <div class="loading"></div>
    <div class="processing">waiting for confirmation</div>
</div-->
<!-- End Loader Bloc -->

<!-- Site Wrapper -->
<div id="site-wrapper">
    <!-- Header -->
    <header id="site-header">
        <div class="nav-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            <?php
                            if (isset($contacts)) {
                                if($contacts['current_opening_time']['is_open']==0){
                                    $opening_hour = "Closed";
                                }
                                else if($contacts['current_opening_time']['times'][0]['start_time']=="24 hours"){
                                    $opening_hour = "24 hours";
                                }
                                else{
                                    $opening_hour = '';
                                    foreach($contacts['current_opening_time']['times'] as $time){
                                        $opening_hour .= $time['start_time']." - ".$time['end_time'].'; ';
                                    }
                                }
                            }

                            ?>
                            <li><i class="fa fa-envira"></i>Open hour - <?php if (isset($opening_hour)) echo $opening_hour;?></li>
                            <li><i class="fa fa-phone"></i><?php if (isset($contacts)) echo $contacts['header_phone1'];?></li>
                            <li><a href=""><i class="fa fa-envelope"></i><?php if (isset($contacts)) echo $contacts['header_email1'];?></a></li>
                            <li class="social-bloc">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-skype"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <?php if (\App\controller\BaseController::isCustomerLogged()) { ?>
                            <li class="signOutBtn">
                                <a href="<?php echo BASE_URL?>/logout" class="btn button-golden sign-in-button hidden-xs">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    Sign Out
                                </a>
                            </li>
                            <?php }?>
                            
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="navbar" role="navigation">
            <div class="container">
                <div class="row">
                    <a href="<?php echo BASE_URL?>/" title="FoodLover" class="logo">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/logo.png" alt="" width="170">
                    </a>
                    <button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="menu-mobile visible-xs">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="<?php echo BASE_URL?>/profile" class="btn button-golden sign-in-button hidden-xs">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        My Account
                    </a>

                    <ul class="nav navbar-nav navbar-collapse collapse">
                        <li><a href="<?php echo BASE_URL?>/" class="<?php if($page == 'index') echo 'active'; ?>" >Home</a></li>
                        <li><a  href="<?php echo BASE_URL?>/about-us" class="<?php if($page == 'about-us') echo 'active'; ?>" >About us</a></li>
                        <li><a href="<?php echo BASE_URL?>/order" class="<?php if($page == 'order') echo 'active'; ?>" >Order Online</a></li>
                        <li><a href="<?php echo BASE_URL?>/contact-us" class="<?php if($page == 'contact-us') echo 'active'; ?>" >Contact us</a></li>
                    </ul>
                    
                    <div class="hidden-lg visible-xs mobile-seccond-nav">
                        <div class="row">
                            <div class="col-xs-7">
                                <!-- <p>
                                    <i class="fa fa-envira"></i>Open hour -<br> <?php echo $opening_hour;?>
                                </p> -->

                                <p class="pull-left">
                                    <i class="fa fa-phone"></i><?php if (isset($contacts)) echo $contacts['header_phone1'];?>
                                </p>

                                <!-- <p>
                                    <a href="">
                                        <i class="fa fa-envelope"></i><?php if (isset($contacts)) echo $contacts['header_email1'];?>
                                    </a>
                                </p> -->
                            </div>

                             <div class="col-xs-5">
                                <a href="<?php echo BASE_URL?>/profile" class="btn button-golden sign-in-button sign-in-btton-xs">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    My Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->
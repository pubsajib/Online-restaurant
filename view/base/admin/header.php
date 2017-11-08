<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Title</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- custom style -->
    <link href="<?php echo BASE_URL?>/assets/admin/dist/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">

    <!-- simple line icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link href="<?php echo BASE_URL?>/assets/sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

    <!-- select CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/dist/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- custom style -->
    <link href="<?php echo BASE_URL?>/assets/admin/custom-style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript 
    <script src="assets/admin/vendor/raphael/raphael.min.js"></script>
    <script src="assets/admin/vendor/morrisjs/morris.min.js"></script>
    <script src="assets/admin/data/morris-data.js"></script-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/dist/js/sb-admin-2.js"></script>

    <!-- datepicker JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/dist/js/moment.js"></script>
    <script src="<?php echo BASE_URL?>/assets/admin/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo BASE_URL?>/assets/sweetalert-master/dist/sweetalert.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <!-- select CSS -->
    <script src="<?php echo BASE_URL?>/assets/admin/dist/js/bootstrap-select.min.js"></script>

    <!-- Custom js -->
    <script src="<?php echo BASE_URL?>/assets/admin/js/custom.js"></script>

</head>

<body>

<div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:;">@it | Admin V1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="javascript:;"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="javascript:;"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= BASE_URL?>/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cutlery fa-fw"></i> Food Menu<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li> <a href="<?= BASE_URL ?>/admin/category">Categories</a> </li>
                                <li> <a href="<?= BASE_URL ?>/admin/products">Items</a> </li> 
                                <li> <a href="<?= BASE_URL ?>/admin/sub_products">Sub Items</a> </li>
                                <li> <a href="<?= BASE_URL ?>/admin/variation">Variations</a> </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/about-us"><i class="fa fa-users fa-fw"></i> About Us</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/contact-details"><i class="fa fa-users fa-fw"></i> Contact Details</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/discounts"><i class="fa fa-users fa-fw"></i> Discounts</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/order-report"><i class="fa fa-bar-chart fa-fw"></i> Order Report</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/banner"><i class="fa fa-users fa-fw"></i> Banner</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> Site Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= BASE_URL?>/admin/opening-hour">Opening Closing Hour</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/post-code">Allowed Postcode</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/delivery-charge">Delivery Charge</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/delivery-minimum">Delivery Minimum</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/delivery-collection">Delivery Collection</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/payment-option">Payment Option</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL?>/admin/estimated-delivery-time">Estimated Delivery/Collection Time</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?= BASE_URL?>/admin/customer-info"><i class="fa fa-users fa-fw"></i> Customer Information</a>
                        </li>
                        
                        <!--li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reporting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="javascript:;">Pending Orders</a>
                                </li>
                                <li>
                                    <a href="javascript:;">Completed Order</a>
                                </li>
                                <li>
                                    <a href="javascript:;">Sales Report</a>
                                </li>
                            </ul>
                        </li-->
                        <!--li>
                            <a href="javascript:;"><i class="fa fa-question fa-fw"></i> Help and Support</a>
                        </li-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
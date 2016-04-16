<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>eElections| Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/dist/css/AdminLTE.css">


        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/plugins/formValidation/css/formValidation.css"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/dist/css/skins/skin-green.css">

        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>includes/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery UI -->
        <script src="<?php echo base_url(); ?>includes/plugins/jQueryUI/jquery-ui.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/formValidation/js/formValidation.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/formValidation/js/framework/bootstrap.js"></script>



    </head>
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url('Admin') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>e</b>E</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">eElection</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">



                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-cogs"></span></a>
                        <ul class="dropdown-menu">


                            <li><a href="<?php echo base_url(); ?>admin/admin_detail"><span class="fa fa-user"></span>View Profile</a></li>
                            <li><a href="<?php echo site_url('Admin/updatePassword'); ?>"><span class="fa fa-unlock"></span>Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo site_url('Admin/logout'); ?>"><span class="fa fa-sign-out"></span>LogOut</a></li>
                        </ul>
                    </li>



                </ul>
            </div>
        </nav>
    </header>
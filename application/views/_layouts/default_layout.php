<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" sizes="16x16" href="<?php echo base_url();?>assets/img/logo_icon.ico">

    <!-- bootstrap & fontawesome & Datatables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" class="theme-stylesheet" id="theme-style" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" />

    <title>RBL &#8226; <?php echo $title;?></title>
    <?php if(isset($page_style)) $this->load->view($page_style); ?>
</head>
 
<body>
	<!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

	<div id="main-wrapper" data-theme="dark" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
		<?php $this->load->view($nav);?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title"><?php echo $title;?></h4>                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- PAGE CONTENT BEGINS -->

                                <?php echo $contents;?>

                                <!-- PAGE CONTENT ENDS -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center" style="font-size: smaller;">
                Copyright © 2021 - <?php echo date("Y"); ?> <a href="https://www.rbl.com/" target="_blank">RBL</a>. All rights reserved.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
 
	<!-- scripts -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"></script>
	<!-- apps -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.min.js"></script>
	<!--Wave Effects -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>

    <!--This page JavaScript -->
    <?php if(isset($page_script)) $this->load->view($page_script); ?>
</body>
</html>

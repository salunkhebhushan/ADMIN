<?php
$request = \Config\Services::request();

// $uri = $request->uri;
// $c = $uri->getSegment(1);
// if (!session('uid')) {
//     header("Location: " . url('auth') . "");
//     exit;
// } 
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from colorlib.com//polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 05 Dec 2018 08:43:55 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>Admindek | Admin Template</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />
	<!--inc_ling.php -->
    <!-- Link start -->
	 <?= view('inc/inc_csslink'); ?>
     <!-- Link end -->
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            <!-- [nav] start-->
			  <!-- [ chat user list ] start -->
			   <!-- [ chat message ] start -->
			 <?= view('inc/inc_header'); ?>
			<!-- [nav] end-->
            <!-- [ chat user list ] end -->
            <!-- [ chat message ] end -->


            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   <!-- [ navigation menu ] start -->
				    <?= view('inc/inc_sidemenu'); ?>
				   <!-- [ navigation menu ] end -->
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                         <?= view('inc/inc_breadcrumb'); ?>
                        <!-- [ breadcrumb ] end -->

                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page main content ] row start -->
										  <?= $this->renderSection('content') ?>
                                       <!-- [ page main content ] row end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ style Customizer ] start -->
                    <div id="styleSelector">
                    </div>
                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Required Jquery start-->
	 <?= view('inc/inc_jslink'); ?>
	 <!-- Required Jquery end-->
 
</body>


<!-- Mirrored from colorlib.com//polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 05 Dec 2018 08:47:34 GMT -->
</html>

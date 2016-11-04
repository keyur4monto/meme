<?php 

include 'db.php';
session_start();
// ADMIN CHECk
$username = $_SESSION['username'];
if(!isset($_SESSION['username']))// make sure user is a admin
{
    session_start();
    session_destroy();
    header("location:login.php");
    die;
}


?>

<!doctype html>
<html class="fixed">
	
<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dashboard | Meme Admin</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->		
        <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.css" />		
        <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.theme.css" />		
        <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />		
        <link rel="stylesheet" href="assets/vendor/morris.js/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>		
		<script src="assets/vendor/style-switcher/style.switcher.localstorage.js"></script>

	</head>
	<body>
		<section class="body">

			<?php
				include('header.php');
			?>

			<div class="inner-wrapper">
			<?php
				include('sidebar.php');
			?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					
					<!-- end: page -->
				</section>
			</div>

			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>		
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		
		<script src="assets/vendor/jquery-cookie/jquery-cookie.js"></script>		
		
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>		
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>		
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		
		<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>		
		<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		
		<script src="assets/vendor/jquery-ui/jquery-ui.js"></script>		
		<script src="assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>		
		<script src="assets/vendor/jquery-appear/jquery-appear.js"></script>		
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		
		<script src="assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>		
		<script src="assets/vendor/flot/jquery.flot.js"></script>		
		<script src="assets/vendor/flot.tooltip/flot.tooltip.js"></script>		
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>		
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>		
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>		
		<script src="assets/vendor/jquery-sparkline/jquery-sparkline.js"></script>		
		<script src="assets/vendor/raphael/raphael.js"></script>		
		<script src="assets/vendor/morris.js/morris.js"></script>		
		<script src="assets/vendor/gauge/gauge.js"></script>		
		<script src="assets/vendor/snap.svg/snap.svg.js"></script>		
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>		
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
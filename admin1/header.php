<!doctype html>
<html class="fixed">
<?php include 'db.php';
session_start();
// ADMIN CHECk
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$count = mysqli_num_rows($result);
if($count != 1) // make sure user is a admin
{
    session_start();
    session_destroy();
    header("location: login.php");
    die;
}
$row = $result->fetch_assoc();
//echo "<pre>"; print_r($row);

?>
<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dashboard | Porto Admin - Responsive HTML5 Template 1.5.4</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/bootstrap/css/bootstrap.css'?>" />

		<link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/font-awesome/css/font-awesome.css'?>" />
		<link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/magnific-popup/magnific-popup.css'?>" />
		<link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css'?>"/>

		<!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/jquery-ui/jquery-ui.css'?>" />		
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/jquery-ui/jquery-ui.theme.css'?>" />		
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css'?>" />
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css'?>" />		
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/morris.js/morris.css'?>" />

		<!-- Theme CSS -->
		
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/select2/css/select2.css'?>" />		
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css'?>" />	
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/vendor/jquery-datatables-bs3/assets/css/datatables.css'?>" />

		<!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo $siteurl.'assets/stylesheets/theme.css'?>" />
		<link rel="stylesheet" href="<?php echo $siteurl.'assets/stylesheets/theme-custom.css'?>">

		<!-- Head Libs -->
		<script src="<?php echo $siteurl.'assets/vendor/modernizr/modernizr.js'?>"></script>
		<script src="<?php echo $siteurl.'assets/vendor/style-switcher/style.switcher.localstorage.js'?>"></script>
        <script src="<?php echo $siteurl.'assets/vendor/jquery/jquery.js'?>"></script>
      
       <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
    
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="<?php echo $siteurl.'assets/javascripts/memegenretor/spectrum.js'?>"></script>
		<script type="text/javascript" src="<?php echo $siteurl.'assets/javascripts/memegenretor/jquery.memegenerator.min.js'?>"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo $siteurl.'assets/stylesheets/memegenretor/jquery.memegenerator.min.css'?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $siteurl.'assets/stylesheets/memegenretor/spectrum.css'?>"/>
		<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <!-- Autocomplete Multiple Values -->
    
    <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 1,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo $siteurl.'search.php'; ?>", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
    });
    </script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo $siteurl; ?>" class="logo">
						<img src="<?php echo $siteurl.'assets/images/logo.png'?>" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="http://preview.oklerthemes.com/porto-admin/1.5.4/pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo $row['image'];?>" alt="<?php echo $row['fname'].' '.$row['lname']; ?>" class="img-circle"/>
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $row['fname'].' '.$row['lname']; ?></span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $siteurl.'profile.php'?>"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $siteurl.'logout.php'?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
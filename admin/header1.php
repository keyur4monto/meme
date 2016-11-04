<!doctype html>
<html class="fixed">

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

			
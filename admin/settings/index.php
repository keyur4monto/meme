<?php

include '../db.php';
session_start();
if(isset($_POST['submitsetting'])){   
  
    $set_aboutme    = mysqli_real_escape_string($conn,$_POST['editor1']);
    $set_terms      = mysqli_real_escape_string($conn,$_POST['editor2']);
    $set_disclaimer = mysqli_real_escape_string($conn,$_POST['editor3']);
    $set_privacy    = mysqli_real_escape_string($conn,$_POST['editor4']); 
    
    $query = "UPDATE admin_setting_option SET `aboutme_page`='$set_aboutme', `terms_page`='$set_terms', `disclaimer_page`='$set_disclaimer', `privacy_page`='$set_privacy' WHERE `id`=1";
    $res=$conn->query($query);         
    if ($res == TRUE) {
        $success_msg = 'Page Setting Update Successfully...';
    }
}              
?>        
<!-- end: header -->
 <?php $query = mysqli_query($conn, "SELECT * FROM admin_setting_option where id=1");
$admin_setting_option = $query->fetch_assoc();
?>

<!doctype html>
<html class="fixed">
<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>User Profile | Meme Admin</title>
		<meta name="keywords" content="" />
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../assets/vendor/modernizr/modernizr.js"></script>		
		<script src="../assets/vendor/style-switcher/style.switcher.localstorage.js"></script>

	</head>
	<body>
		<section class="body">

			<?php
			include('../header.php');
			?>

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>WEBISTE SETTING</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Website Setting</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
                       <?php //$template_update_msg = $_SESSION['pagesetting_update_msg'];
                                if(isset($success_msg)): 
                                            echo '<div class="alert alert-success fade in" id="successmessage">'.$success_msg.'</div>';
                                           // unset($_SESSION['pagesetting_update_msg']);
                                endif; ?>
						<div class="col-md-12">
							<div class="tabs">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#set_header" aria-expanded="true">Header</a>
									</li>
                                    <li class="">
										<a data-toggle="tab" href="#set_banner" aria-expanded="false">Banner</a>
									</li>
                                    <li class="">
										<a data-toggle="tab" href="#set_watermark" aria-expanded="false">Water Mark</a>
									</li>
                                    <li class="">
										<a data-toggle="tab" href="#set_pages" aria-expanded="false">Pages</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#set_footer" aria-expanded="false">Footer</a>
									</li>
                                    
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="set_header">
										<form action="header_setting.php" enctype="multipart/form-data" role="form" method="post" class="form-horizontal">
											<h4 class="mb-xlg">Header Setting</h4>
											<fieldset>
												<div class="form-group">
													<label for="websiteTilte" class="col-md-3 control-label">Website Title</label>
													<div class="col-md-8">
														<input type="text" class="form-control" value="<?php echo $admin_setting_option['website_title'] ?>" name="set_title">
													  </div>
												</div>
                                                <div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">Website Description</label>
													<div class="col-md-8">
														<input type="text" class="form-control" value="<?php echo $admin_setting_option['tagline'] ?>" name="set_description">
													</div>
												</div>
                                                <div class="form-group">
													<label for="profileImage" class="col-md-3 control-label">Logo Image</label>
													<div class="col-md-8">
                                                        <img src="<?php echo $admin_setting_option['logo']; ?>" style="height: 128px; width:128px" />
														<input type="file" name="logo">
													</div>
												</div>
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">Fevicon Setting</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label for="profileImage" class="col-md-3 control-label">Fevicon Image</label>
													<div class="col-md-8">
                                                    <img src="<?php echo $admin_setting_option['fevicon']; ?>" style="height: 32px; width:32px" />
														<input type="file" name="fevicon">
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" value="Update" class="btn btn-primary" name="submit">
													</div>
												</div>
											</div>

										</form>
									</div>
                                    <div class="tab-pane" id="set_banner">
                                    <form action="banner_setting.php" enctype="multipart/form-data" role="form" method="post" class="form-horizontal">
											<h4 class="mb-xlg">Banner Setting</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label">Banner Text</label>
													<div class="col-md-8">
														<input type="text" class="form-control" value="<?php echo $admin_setting_option['banner_text'] ?>" name="set_bannertext">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label">Banner Image</label>
													<div class="col-md-8">
                                                    <img src="<?php echo $admin_setting_option['banner_image'] ?>" style="width:100%" />
														<input type="file" name="banner_image">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label">Set Banner</label>
													<div class="col-md-8">
                                                        <select name="set_banner">
                                                        <option value="text" <?php echo ($admin_setting_option['set_banner']=='text')?'selected':'' ?>>Text</option>
                                                        <option value="image" <?php echo ($admin_setting_option['set_banner']=='image')?'selected':'' ?>>Image</option>
                                                        </select>
													</div>
												</div>
                                                
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" value="Update" class="btn btn-primary" name="submit">
													</div>
												</div>
											</div>

										</form>
                                    </div>
                                    <div class="tab-pane" id="set_watermark">
                                    <form action="watermark_setting.php" enctype="multipart/form-data" role="form" method="post" class="form-horizontal">
											<h4 class="mb-xlg">Water Maark Setting</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label">Text</label>
													<div class="col-md-8">
														<input type="text" class="form-control" value="<?php echo $admin_setting_option['water_mark_text'] ?>" name="set_watermarktext">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label">Image</label>
													<div class="col-md-8">
                                                    <img src="<?php echo $admin_setting_option['water_mark_image'] ?>" style="height: 64px; width:64px" />
														<input type="file" name="watermark_image">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label">Set Water Mark</label>
													<div class="col-md-8">
                                                        <select name="set_watermark">
                                                        <option value="text" <?php echo ($admin_setting_option['set_watermark']=='text')?'selected':'' ?>>Text</option>
                                                        <option value="image" <?php echo ($admin_setting_option['set_watermark']=='image')?'selected':'' ?>>Image</option>
                                                        </select>
													</div>
												</div>
                                                
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" value="Update" class="btn btn-primary" name="submit">
													</div>
												</div>
											</div>

										</form>
                                    </div>
                                    <div class="tab-pane" id="set_pages">
                                    <form enctype="multipart/form-data" role="form" method="post" class="form-horizontal"> 
										 <h4 class="mb-xlg">Page Setting</h4>
											<fieldset>
												<div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">About Me</label>
                                                   
											    	<div class="col-md-8">
                                                    <!--<textarea cols="4" rows="4" class="form-control" name="set_aboutme"></textarea> -->
													<textarea cols="80" id="editor1" name="editor1" rows="10"><?php echo $admin_setting_option['aboutme_page'] ?></textarea>
                                                    </div> 
												</div>
                                                <div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">Terms</label>
													<div class="col-md-8">
                                                      <!--  <textarea cols="4" rows="4" class="form-control" name="set_terms"><?php //echo $admin_setting_option['terms_page'] ?></textarea> -->
                                                       	<textarea cols="80" id="editor2" name="editor2" rows="10"><?php echo $admin_setting_option['terms_page'] ?></textarea>
                                                   	</div>
												</div>
                                                <div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">Disclaimer</label>
													<div class="col-md-8">
                                                       <!-- <textarea cols="4" rows="4" class="form-control" name="set_disclaimer"><?php echo $admin_setting_option['disclaimer_page'] ?></textarea> -->
													   <textarea cols="80" id="editor3" name="editor3" rows="10"><?php echo $admin_setting_option['disclaimer_page'] ?></textarea>
                                                    </div>
												</div>
                                                <div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">Privacy</label>
													<div class="col-md-8">
                                                     <!--   <textarea cols="4" rows="4" class="form-control" name="set_privacy"><?php echo $admin_setting_option['privacy_page'] ?></textarea> -->
                                                        <textarea cols="80" id="editor4" name="editor4" rows="10"><?php echo $admin_setting_option['privacy_page'] ?></textarea>
                                                   	</div>
												</div>   
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
													<input type="submit" value="Update" class="btn btn-primary" name="submitsetting"> 
													<!--	<input type="submit" value="Update" class="btn btn-primary" name="submit11"> -->
												
                                                    </div>
												</div>
											</div>
									</form>
                                    </div>
									<div class="tab-pane" id="set_footer">
										<form  action="footer_setting.php" enctype="multipart/form-data" role="form" method="post" class="form-horizontal">
											<h4 class="mb-xlg">Footer Setting</h4>
											<fieldset>
												<div class="form-group">
													<label for="websiteTilte" class="col-md-3 control-label">Copyright</label>
													<div class="col-md-8">
														<input type="text" class="form-control" value="<?php echo $admin_setting_option['copyright'];?>" name="set_copyright">
													</div>
												</div>
                                                <div class="form-group">
													<label for="websiteDescription" class="col-md-3 control-label">About Us</label>
													<div class="col-md-8">
                                                        <textarea cols="4" rows="4" class="form-control" name="set_aboutus"><?php echo $admin_setting_option['about_us_text'] ?></textarea>
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" id="submit" value="Update" class="btn btn-primary" name="submit">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end: page -->
				</section>
			</div>

		</section>

		<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>		
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		
		<script src="../assets/vendor/jquery-cookie/jquery-cookie.js"></script>		
		<script src="../assets/vendor/style-switcher/style.switcher.js"></script>		
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>		
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>		
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		
		<script src="../assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>		
		<script src="../assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		
		<script src="../assets/vendor/autosize/autosize.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>
        <script src="http://cdn.ckeditor.com/4.5.11/standard-all/ckeditor.js"></script>
        <script>
			setTimeout(function() {
					$('#successmessage').fadeOut('fast');
			}, 5000);
			
			CKEDITOR.replace( 'editor1'); 
			CKEDITOR.replace( 'editor2' ); 
			CKEDITOR.replace( 'editor3' ); 
			CKEDITOR.replace( 'editor4' );
			 
			var editor1 = CKEDITOR.instances.editor1.getData();
			var editor2 = CKEDITOR.instances.editor2.getData();
			var editor3 = CKEDITOR.instances.editor3.getData();
			var editor4 = CKEDITOR.instances.editor4.getData();    
 
</script>
</html>
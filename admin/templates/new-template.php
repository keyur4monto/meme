<?php 

	include '../db.php';
	session_start();
	
	
	//Add Template
	
	if(isset($_REQUEST['savetemplate'])){
		
		$cat_id = $_POST['category'];
		$cat_id = implode(',',$cat_id);
		$tname = $_POST['tname'];
		$tag_name = $_POST['tag_name'];
		$tag_name = implode(',',$tag_name);
		$upload_image = $_POST['upload_template'];
		$query = "INSERT INTO template (admin_id,cat_id,tag_id,template_name,template_image) VALUES ('1','$cat_id','$tag_name','$tname','$upload_image')";
		$ex_query = mysqli_query($conn,$query);
		
							  if ($ex_query) {
								  $last_record = mysqli_query($conn, "SELECT id FROM template ORDER BY id DESC LIMIT 1");
							  $last_record = $last_record->fetch_assoc();
							  header("Location:".$siteurl."templates/meme_generate.php?id=".$last_record['id']);
							  }
	}
	
	

?>


<!doctype html>
<html class="fixed">

<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Template Gallery | Meme Admin</title>
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
        <link rel="stylesheet" href="../assets/vendor/pnotify/pnotify.custom.css" />
        <link rel="stylesheet" href="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />

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

			<!-- start: header -->
			<?php
				include('../header.php');
			?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php
					include('../sidebar.php');
				?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add New Template</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add New Template</span></li>
							</ol>
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    
                    <div class="row">
                    
                    	<div class="col-md-12">
							<section class="panel panel-featured panel-featured-success">
								<header class="panel-heading">

									<h2 class="panel-title">Add New Template</h2>
								</header>
								<div class="panel-body">
								
			<form action="upload_template.php" enctype="multipart/form-data" class="form-horizontal" method="post">

				
				 

				<div class="form-group">
												<label class="col-md-3 control-label">File Upload</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" name="image" id="image" class="form-control" /></span>
															
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
                                                        
                                                           
<span id="lblError" style="color: red;"></span>
                                                        
				
													</div>
												</div>
                                                
                                                <div class="col-md-3">
                                            <button class="btn btn-primary upload-image" onclick="return ValidateExtension()">Upload Image</button>
                                            </div>

											</div>
                                            
                                            <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-6">
                                            <div class="progress" style="display:none">
				  <div class="progress-bar" role="progressbar" aria-valuenow="0"
				  aria-valuemin="0" aria-valuemax="100" style="width:0%">
				    0%
				  </div>
				</div>
                                            </div>
                                            </div>
                                            
                                            <div class="preview row"></div>
                                            
				
			</form>
		
								</div>
							</section>
						</div>
                    	
                    </div>
                    
                   
                   </section>
			     </div>
                 </section>


<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>		
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		
		<script src="../assets/vendor/jquery-cookie/jquery-cookie.js"></script>				
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>		
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>		
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		
		<script src="../assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>		
		<script src="../assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
        <script src="../assets/vendor/pnotify/pnotify.custom.js"></script>
       
        
		
		<!-- Specific Page Vendor -->		
		<script src="../assets/vendor/isotope/isotope.js"></script>
        
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        <script src="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script> 
       
		function ValidateExtension() {
        var allowedFiles = [".jpg", ".jpeg", ".png"];
        var fileUpload = document.getElementById("image");
        var lblError = document.getElementById("lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
            return false;
        }
		else{
        lblError.innerHTML = "";
		var progressbar     = $('.progress-bar');

      
            	$(".form-horizontal").ajaxForm(
				{
					
				  target: '.preview',
				  beforeSend: function() {
					$(".progress").css("display","block");
					progressbar.width('0%');
					progressbar.text('0%');
							},
					uploadProgress: function (event, position, total, percentComplete) {
						progressbar.width(percentComplete + '%');
						progressbar.text(percentComplete + '%');
					 },
					 
		
            	}).submit();
		}
        
    }
	
	
    </script>
   
	</body>
</html>

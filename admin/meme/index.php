<?php

include '../db.php';
session_start();

reload_data();

function reload_data(){
	include '../db.php';
//Selct User
$response = array();
$data = array();
$sel_meme = "SELECT users.username, meme.*
					FROM meme JOIN users
					ON meme.user_id=users.id ORDER BY `id` DESC";
$ex_sel_meme = mysqli_query($conn,$sel_meme) or die(mysqli_error());

if(mysqli_num_rows($ex_sel_meme) > 0){
	
	while($row_sel_meme = mysqli_fetch_array($ex_sel_meme)){
		$meme_id 	= $row_sel_meme['id'];
		$meme_name 	= $row_sel_meme['meme_name'];
		$meme_user 	= $row_sel_meme['username'];
		$meme_tag 	= $row_sel_meme['meme_tag'];
		$meme_lang 	= $row_sel_meme['meme_lang'];
		$template_id = '<a href="#myModal" data-toggle="modal" id="'.$row_sel_meme['template_id'].'" data-target="#view-template">'.$row_sel_meme['template_id'].'</a>';
		$img = $row_sel_meme['meme_image'];
		$meme_image = '<img id="tempImg" src="'.$img.'" alt="'.$meme_name.'" width="50" height="50">';
		$time			= $row_sel_meme['time'];
		
		$template_action 	=  '<a href="#myModal" class="mb-xs mt-xs mr-xs btn btn-danger" data-toggle="modal" id="'.$meme_id.'" data-target="#delete-modal"><i class="fa fa-trash-o"></i></a>';
		
		$data[] = array($meme_id,$meme_name,$meme_user,$template_id,$meme_tag,$meme_lang,$meme_image,$time,$template_action);
	
	}
	
	$response['data'] = $data;
	$fp = fopen('results.txt', 'w');
	fwrite($fp, json_encode($response));
	fclose($fp);
}
}


?>

<!doctype html>
<html class="fixed">
	
<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Meme Management | Meme Admin</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />

		<!-- Specific Page Vendor CSS -->		
        <link rel="stylesheet" href="../assets/vendor/select2/css/select2.css" />		
        <link rel="stylesheet" href="../assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />		
        <link rel="stylesheet" href="../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
        <link rel="stylesheet" href="../assets/vendor/pnotify/pnotify.custom.css" />
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
        <?php
			include('../header.php');
		?>

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>MEME</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Meme</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->
                    <section class="panel">
							<header class="panel-heading">
								
								
							  <h2 class="panel-title">Meme Management</h2>
                             
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none display" id="datatable-category" data-swf-path="../assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
                                        	<th>ID</th>
											<th>Meme Name</th>
                                            <th>Username</th>
                                            <th>Template ID</th>
                                            <th>Tags</th>
                                            <th>Language</th>
                                            <th>Image</th>
                                            <th>Timestamp</th>
                                            <th>Action</th>
										</tr>
									</thead>
									
								</table>
							</div>
						</section>
                         
                        <div id="view-template" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="viewmodal"></div>
                           </div>
                           <div id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="delmodal"></div>
                           </div>
                           
                           <!-- The Modal -->
                        <div id="myModal" class="modal1">
                        
                          <!-- The Close Button -->
                          <span class="close1" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                        
                          <!-- Modal Content (The Image) -->
                          <img class="modal-content1" id="img01" class="img-responsive">
                        
                          <!-- Modal Caption (Image Text) -->
                          <div id="caption"></div>
                        </div>
                    <!-- End: page -->
                 
						
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
		
		<!-- Specific Page Vendor -->		
		<script src="../assets/vendor/select2/js/select2.js"></script>
        <script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		
		<script src="../assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
        
        <script src="../assets/vendor/dropzone/dropzone.js"></script>	
		<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>		
		<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
        <script src="../assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>
		
		<!-- Examples -->
        
		<script src="../assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.tabletools.js"></script>
        
        <script>
			$('#view-template').on('show.bs.modal', function(e) {
				
				var $modal = $(this),
					esseyId = e.relatedTarget.id;
				
				   $.ajax({
					   type: 'POST',
						url: 'ajax/ajax.php',
					   data: 'view_id='+esseyId,
					  success: function(data) 
					  {
							$("#viewmodal").html(data);
							$modal.find('.edit-content').html(esseyId);
					   }
				 });
			 });
			 

			 
			 $('#delete-modal').on('show.bs.modal', function(e) {
            
				var $modal = $(this),
					esseyId = e.relatedTarget.id;
				
				   $.ajax({
					   type: 'POST',
						url: 'ajax/ajax.php',
					   data: 'del_id='+esseyId,
					  success: function(data) 
					  {
						  $("#delmodal").html(data);
							$modal.find('.edit-content').html(esseyId);
					   }
				 });
			});
			
			
			
			
			// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('tempImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

$(document).on('click', '#tempImg', function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}); 


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
			
			
				
    	</script>
        
        <?php
		//Update User Details


if(isset($_REQUEST['delete'])){
	$del_meme = $_REQUEST['del_meme'];
	
	$sel_meme = "SELECT `template_id`,`meme_image` FROM `meme` WHERE `id`='$del_meme'";
	$ex_sel_meme = mysqli_query($conn,$sel_meme) or die(mysqli_error($conn));
	$row_sel_meme = mysqli_fetch_array($ex_sel_meme);
	$temp_id = $row_sel_meme['template_id'];
	$image = $row_sel_meme['meme_image'];
	$image = str_replace('..', '', $image);
	$path = $_SERVER['DOCUMENT_ROOT'].'/admin'.$image;
	
	$del = "DELETE FROM `meme` WHERE `id`='$del_meme'";
	$ex_del = mysqli_query($conn,$del);
	
	$updt_temp = "UPDATE `template` SET `template_count` = template_count - 1 WHERE `id`='$temp_id'";
	$ex_updt_temp = mysqli_query($conn,$updt_temp);
	
	
	
	
	if($ex_del){
		unlink($path);
		reload_data();
		
		?>
        <script>
				$( document ).ready(function(){
					new PNotify({
						title: 'Success',
						text: 'Delete Successfully!',
						type: 'success',
					});
					setTimeout(function() {
						PNotify.removeAll();
					}, 3000);
				
				});
		</script>
        <?php
	}
	else{
		?>
        	<script>
				$( document ).ready(function(){
				new PNotify({
					title: 'Fail',
					text: 'Something were wrong!',
					type: 'error'
				});
				setTimeout(function() {
						PNotify.removeAll();
					}, 3000);
			});
			</script>
        <?php
	}
}


		
		?>
        
        
      
        
    </body>
 </html>

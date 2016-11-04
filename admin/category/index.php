<?php
include '../db.php';
session_start();

reload_data();

function reload_data(){
	include '../db.php';
//Selct User
$response = array();
$data = array();
$sel_cat = "SELECT * FROM `category`";
$ex_sel_cat = mysqli_query($conn,$sel_cat) or die(mysqli_error());

if(mysqli_num_rows($ex_sel_cat) > 0){
	
	while($row_sel_cat = mysqli_fetch_array($ex_sel_cat)){
		$cat_id 	= $row_sel_cat['id'];
		$cat_name 	= $row_sel_cat['cat_name'];
		$cat_icon 	= $row_sel_cat['icon'];
		$cat_time 	= $row_sel_cat['time'];
		$cat_status = $row_sel_cat['status'];
		
		$cat_action 	=  '<a href="#myModal" class="mb-xs mt-xs mr-xs btn btn-success" data-toggle="modal" id="'.$cat_id.'" data-target="#edit-modal"><i class="fa fa-pencil"></i></a><a href="#myModal" class="mb-xs mt-xs mr-xs btn btn-danger" data-toggle="modal" id="'.$cat_id.'" data-target="#delete-modal"><i class="fa fa-trash-o"></i></a>';
		
		$data[] = array($cat_id,$cat_name,$cat_icon,$cat_time,$cat_status,$cat_action);
	
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

		<title>Category Management | Meme Admin</title>
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
						<h2>USERS</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Category</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->
                    <section class="panel">
							<header class="panel-heading">
								
								
							  <h2 class="panel-title">Category Management</h2>
                              <a href="#myModal" class="mb-xs mt-xs mr-xs btn btn-success" data-toggle="modal" id="add-cat1" data-target="#add-cat"><i class="fa fa-plus"></i>Add New</a>
                              	
                             
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none display" id="datatable-category" data-swf-path="../assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
                                        	<th>ID</th>
											<th>Category Name</th>
                                            <th>Icon</th>
                                            <th>Timestamp</th>
                                            <th>Status</th>
                                            <th>Action</th>
										</tr>
									</thead>
									
								</table>
							</div>
						</section>
                         <div id="add-cat" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="addnew"></div>
                           </div>
                        <div id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="editmodal"></div>
                           </div>
                           <div id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="delmodal"></div>
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
			$('#edit-modal').on('show.bs.modal', function(e) {
				
				var $modal = $(this),
					esseyId = e.relatedTarget.id;
				
				   $.ajax({
					   type: 'POST',
						url: 'ajax/ajax.php',
					   data: 'cat_id='+esseyId,
					  success: function(data) 
					  {
							$("#editmodal").html(data);
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
			
			
			$('#add-cat').on('show.bs.modal', function(e) {
            
				var $modal = $(this),
					esseyId = e.relatedTarget.id;
				
				   $.ajax({
					   type: 'POST',
						url: 'ajax/ajax.php',
					   data: 'add='+esseyId,
					  success: function(data) 
					  {
						  $("#addnew").html(data);
							$modal.find('.edit-content').html(esseyId);
					   }
				 });
			});
			
			
			
			
			
				
    	</script>
        
        <?php
		//Update User Details
		
		

if(isset($_REQUEST['update'])){
	
	$updt_id 	= $_REQUEST['cat_id'];
	$updt_cat_name = $_REQUEST['cat_name'];
	$updt_cat_icon = $_REQUEST['cat_icon'];
	$updt_status = $_REQUEST['status'];
	
	
	if($updt_status == ''){
		$updt_status = 0;
	}
	
	$updt_cat = "UPDATE `category` SET `cat_name`='$updt_cat_name',`icon`='$updt_cat_icon',`status`='$updt_status' WHERE `id`='$updt_id'";
	
	$ex_updt_cat = mysqli_query($conn,$updt_cat);
	
	if($ex_updt_cat){
		
		reload_data();
		
		?>
        <script>
				$( document ).ready(function(){
					new PNotify({
						title: 'Success',
						text: 'Update Successfully!',
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
			});
			</script>
        <?php
		
	}
}


if(isset($_REQUEST['delete'])){
	$del_cat = $_REQUEST['del_cat'];
	
	$del = "DELETE FROM `category` WHERE `id`='$del_cat'";
	$ex_del = mysqli_query($conn,$del);
	
	if($ex_del){
		
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


//Add New Category

if(isset($_REQUEST['add_new_cat'])){
	
	$c_name 	= $_REQUEST['cat_name'];
	$c_icon		= $_REQUEST['cat_icon'];
	$c_status	= $_REQUEST['status'];
	
	if($c_status == ''){
		$c_status = 0;
	}
	
	$ins_cat = "INSERT INTO `category` (`cat_name`,`icon`,`status`) VALUES ('$c_name','$c_icon','$c_status')";
	$ex_ins_cat = mysqli_query($conn,$ins_cat);
	
	if($ex_ins_cat){
		
		reload_data();
		
		?>
        <script>
				$( document ).ready(function(){
					new PNotify({
						title: 'Success',
						text: 'Insert Successfully!',
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

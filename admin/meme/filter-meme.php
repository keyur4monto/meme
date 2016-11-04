<?php


include '../db.php';
session_start();

	function filePath($filePath){
		$fileParts = pathinfo($filePath);
		
		if(!isset($fileParts['filename'])){
			$fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));
		}
		  
		return $fileParts;
	}
	
	
	if(isset($_REQUEST['delete_mul'])){
				$del_ids = $_REQUEST['del_meme_mul'];
				$temp_ids = explode(',',$del_ids);
			
				foreach($temp_ids as $temp_id){
					$sel_meme = "SELECT `meme_image` FROM `meme` WHERE `id`='$temp_id'";
					$ex_sel_temp = mysqli_query($conn,$sel_meme) or die(mysqli_error($conn));
					$row_sel_meme = mysqli_fetch_array($ex_sel_temp);
					$image = $row_sel_meme['meme_image'];
					$image = str_replace('..', '', $image);
					$path = $_SERVER['DOCUMENT_ROOT'].'/admin'.$image;
					unlink($path);
					
					$updt_temp = "UPDATE `template` SET `template_count` = template_count - 1 WHERE `id`='$temp_id'";
					$ex_updt_temp = mysqli_query($conn,$updt_temp);
					
					$del1 = "DELETE FROM `meme` WHERE `template_id`='$del_temp'";
					$ex_del1 = mysqli_query($conn,$del1);
					
					$del = "DELETE FROM `meme` WHERE `id`='$temp_id'";
					$ex_del = mysqli_query($conn,$del);
					$_SESSION['ex_del'] = 1;
				}
	}
?>
<!doctype html>
<html class="fixed">

<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Meme Gallery | Meme Admin</title>
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
						<h2>Meme Filter</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index-2.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Meme Filter</span></li>
							</ol>
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->
					<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
						<div class="content-with-menu-container">
							<div class="inner-menu-toggle">
								<a href="#" class="inner-menu-expand" data-open="inner-menu">
									Show Bar <i class="fa fa-chevron-right"></i>
								</a>
							</div>
							
							
							<div class="inner-body mg-main">
							
								<div class="inner-toolbar clearfix">
									<ul>
										<li>
											<a href="#" id="mgSelectAll"><i class="fa fa-check-square"></i> <span data-all-text="Select All" data-none-text="Select None">Select All</span></a>
										</li>
							
										<li>
											
                                            <a href="#myModal"  data-toggle="modal" id="save_value" data-target="#delete-mul"><i class="fa fa-trash-o"></i> Delete</a>
										</li>
                                        <li>
                                        	<input type="text" class="quicksearch" placeholder="Search" />
                                        </li>
                                        
										<li class="right" data-sort-source data-sort-id="media-gallery">
											<ul class="nav nav-pills nav-pills-primary">
												<li>
													<label>Filter:</label>
												</li>
                                                <?php
													$sel_lang = "SELECT DISTINCT meme_lang FROM `meme`";
													$ex_sel_lang = mysqli_query($conn,$sel_lang);
													
													if(mysqli_num_rows($ex_sel_lang) > 0){
														?>
                                                        <li class="active">
                                                            <a data-option-value="*" href="#all">All</a>
                                                        </li>
                                                        <?php
														while($row_sel_lang = mysqli_fetch_array($ex_sel_lang)){
															
															$lang_name = $row_sel_lang['meme_lang'];
															?>
                                                            	<li>
                                                                <a data-option-value=".<?=$lang_name?>" href="#<?=$cat_id?>" style="text-transform:capitalize">
                                                                <?=$lang_name?>
                                                                </a>
                                                            </li>
                                                            <?php
														}
													}
												?>
											</ul>
										</li>
									</ul>
								</div>
                                <form method="post">
								<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                    
                                    <?php
									$sel_meme = "SELECT users.username, meme.*
													FROM meme JOIN users
													ON meme.user_id=users.id ORDER BY `id` DESC";
									$ex_sel_meme = mysqli_query($conn,$sel_meme);
									
									if(mysqli_num_rows($ex_sel_meme) >0){
										while($row_sel_meme = mysqli_fetch_array($ex_sel_meme)){
											$meme_id 	= $row_sel_meme['id'];
											$meme_name 	= $row_sel_meme['meme_name'];
											$meme_user 	= $row_sel_meme['username'];
											$meme_tag 	= $row_sel_meme['meme_tag'];
											$meme_lang 	= $row_sel_meme['meme_lang'];
											$template_id =$row_sel_meme['template_id'];
											$img = $row_sel_meme['meme_image'];
											$image1 = str_replace('admin', '..', $img);
											$time			= $row_sel_meme['time'];
											$tempf = filePath($img);
											$filename = $tempf['filename'];
											$fileext  = $tempf['extension'];
											
											
											?>
                                            <div class="isotope-item <?=$meme_lang?> col-sm-6 col-md-4 col-lg-3">
                                                <div class="thumbnail">
                                                <div class="thumb-preview">
                                                    <a class="thumb-image" href="<?=$image1?>">
                                                        <img src="<?=$image1?>" class="img-responsive" alt="<?=$meme_name?>" style="width:200px;height:200px">
                                                    </a>
                                                    <div class="mg-thumb-options">
                                                        <div class="mg-zoom"><i class="fa fa-search"></i></div>
                                                        <div class="mg-toolbar">
                                                            <div class="mg-option checkbox-custom checkbox-inline">
                                                                <input type="checkbox" name="meme_sel[]" id="<?=$meme_id?>" class="template_sel" value="<?=$meme_id?>">
                                                                <label for="<?=$meme_id?>">SELECT</label>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <h5 class="text-weight-semibold"><?=$meme_name?></h5>
                                                <h5 class="text-weight-semibold"><?=$filename?><small>.<?=$fileext?></small></h5>
                                               
                                                <div class="mg-description">
                                                    <small class="pull-left text-muted"><?=$meme_user?></small>
                                                    <small class="pull-right text-muted"><?=date('d-m-Y',strtotime($time));?></small>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
										}
									}
									?>
									
								</div>
                                </form>
							</div>
						</div>
                        
                        <div id="delete-mul" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">
                                 <div id="delmul"></div>
                           </div>
					</section>
					<!-- end: page -->
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
		
		<!-- Examples -->
		<script src="../assets/javascripts/pages/examples.mediagallery.js"></script>
        
        <script>
			 $(function(){
      $('#save_value').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
		console.log(val);
		
		$('#delete-mul').on('show.bs.modal', function(e) {
            
				   $.ajax({
					   type: 'POST',
						url: 'ajax/ajax.php',
					   data: 'del_mul='+val,
					  success: function(data) 
					  {
						  $("#delmul").html(data);
						  //window.location.reload();
			
					   }
				 });
			});
      });
    });
		</script>
        
        
        <?php
		
			
					
					if(isset($_SESSION['ex_del'])){
						
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
						unset($_SESSION['ex_del']);
					}
					
					
			
		
		?>
        
       

	</body>
</html>
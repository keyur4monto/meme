<?php include('../header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>New TEMPLATES</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>New Templates</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    <div class="row">
                   	<div class="col-md-4 col-lg-2">
				    
							
										<div class="inner-menu-toggle-inside">
											<a class="inner-menu-collapse" href="#">
												<i class="fa fa-chevron-up visible-xs-inline"></i><i class="fa fa-chevron-left hidden-xs-inline"></i> Hide Bar
											</a>
											<a data-open="inner-menu" class="inner-menu-expand" href="#">
												Show Bar <i class="fa fa-chevron-down"></i>
											</a>
										</div>
							
										<div class="inner-menu-content">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div><i class="fa fa-upload mr-xs"></i><input type="file" name="files"/></div>
                                                <input type="submit" name="submit" value="Upload Templates"/>
                                            </form>	
										</div>
									
                    </div>
                    <?php
                    if(isset($_POST['submit'])){ 
                        extract($_POST);
                        $extension=array("jpeg","jpg","png","gif");
                        $file_name=$_FILES["files"]["name"];
                        $target_path = "../../uploads/template_image/".$file_name;
						$img_url = 'uploads/template_image/'.$file_name;
                        $file_tmp=$_FILES["files"]["tmp_name"];
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                        if(in_array($ext,$extension))
                        {
                            if(!file_exists($target_path))
                            {
                                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"],$target_path);
                                //echo "<img src='$target_path'/>";
                            }
                        }
                        ?>
						<div class="col-md-4 col-lg-3">
							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="<?php echo $target_path;?>" class="rounded img-responsive" alt="admin">
									</div>
								</div>
							</section>
						</div>
						<div class="col-md-8 col-lg-7">

							<div class="tabs">
								
								<div class="tab-content">
										
									<div id="edit" class="tab-pane active">

										<form action="upload_template.php" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
											<h5 class="mb-xlg">Thanks for uploading! To activate the image, provide a title below and save.</h5>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Template Name</label>
													<div class="col-md-8">
														<input type="text" name="tname" class="form-control" id="profileFirstName" required="">
													</div>
												</div>
                                                <input type="hidden" name="upload_template" value="<?php echo $img_url; ?>" />
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Category</label>
													<div class="col-md-8">
                                                        <?php $query = mysqli_query($conn, "SELECT * FROM category");
                                                        while($row1 = $query->fetch_assoc()) {?>
                                                        <input type="radio" name="category"  value="<?php echo $row1['id'];?>" /><?php echo $row1['cat_name']."<br>";?>
                                                        <?php } ?>
														
                                                        
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Tags</label>
													<div class="col-md-8">
														<input type="text" name="tag_name" class="form-control" id="tags" required="">
													</div>
												</div>
											 
											</fieldset>
											
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" name="savetemplate" class="btn btn-primary" value="Save Template"/>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
                        <?php } ?>
					</div>
                    </section>
			     </div>
<?php include('../footer.php');?>

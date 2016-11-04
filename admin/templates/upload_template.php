 <script src="../assets/vendor/jquery/jquery.js"></script>
 <script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<?php
session_start();
include('../db.php'); 


if(isset($_POST) && !empty($_FILES['image']['name'])){ 
                        extract($_POST);
                        $extension=array("jpeg","jpg","png","gif");
                        $file_name=$_FILES["image"]["name"];
                        $target_path = "../../uploads/template_image/".$file_name;
						$img_url = 'uploads/template_image/'.$file_name;
                        $file_tmp=$_FILES["image"]["tmp_name"];
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                        if(in_array($ext,$extension))
                        {
                            if(!file_exists($target_path))
                            {
								
                                move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"],$target_path);
                               
                            }
		
							?>
                            <div class="col-md-4 col-lg-3">
							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img width='200px' src='<?=$target_path?>' class='preview rounded img-responsive'>
									</div>
								</div>
							</section>
						</div>
                            	<div class="col-md-8 col-lg-7">

							<div class="tabs">
								
								<div class="tab-content">
										
									<div id="edit" class="tab-pane active">

										<form action="" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
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
                                                        <input type="checkbox" name="category[]"  value="<?php echo $row1['id'];?>" /><?php echo $row1['cat_name']."<br>";?>
                                                        <?php } ?>
														
                                                        
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Tags</label>
													<div class="col-md-8">
														 <select id="tags-input-multiple" name="tag_name[]" multiple data-role="tagsinput" data-tag-class="label label-primary"></select>
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
                        
                            <?php
                        }
						/*else{
							echo "<script>alert('Only upload jpeg,jpg,png and gif');</script>";
						}*/
}
                   ?>
                   
                   



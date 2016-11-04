<?php 
ob_start();
include('../header.php'); 
?>

			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>TAGS</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Tags</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    <?php
                    if(!empty($_GET['id'])){ 
                    $id = $_GET['id'];
                    if (isset($_POST["submit"])) {
                        $tag_name =  $_POST['tag_name'];
                        $status = $_POST['status'];
                          if($status=='yes'){
                            $status = 1;
                          }
                          else{
                            $status = 0;
                          }
                          $query = "UPDATE tag SET tag_name='$tag_name', status='$status' WHERE id=".$id;
                          if ($conn->query($query) === TRUE) {
                          header("Location:".$siteurl."tags");
                          }
                    }
                    
                    $result = mysqli_query($conn, "SELECT * FROM tag WHERE id=".$id);
                    $row= mysqli_fetch_assoc($result);?> 
                    
                     <div class="col-md-8 col-lg-9">
						<div class="tabs">
							<div class="tab-content">
								<div class="tab-pane active" id="edit">

									<form method="post" class="form-horizontal">
										<h4 class="mb-xlg">Edit Tag</h4>
										<fieldset>
											<div class="form-group">
												<label for="profileFirstName" class="col-md-3 control-label">Tag Name</label>
												<div class="col-md-8">
													<input type="text" value="<?php echo $row['tag_name']; ?>" name="tag_name" id="profileFirstName" class="form-control">
												</div>
											</div>
                                            <div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Status</label>
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" value="yes" name="status" <?php echo ($row['status']==1?'checked':'')?>/>
															<label for="profilePublic"></label>
														</div>
													</div>
												</div>
										</fieldset>
										<div class="panel-footer">
											<div class="row">
												<div class="col-md-9 col-md-offset-3">
													<input type="submit" name="submit" class="btn btn-default" value="Update"/>
												</div>
											</div>
										</div>

									</form>

								</div>
							</div>
						</div>
					</div>   
                    <?php }else{
                    if (isset($_POST["submit"])) {
                        $tags_name =  $_POST['tag_name'];
                        
                        $status = $_POST['status'];
                          if($status=='yes'){
                            $status = 1;
                          }
                          else{
                            $status = 0;
                          }
                          foreach($tags_name as $tag_name){
                            $query = "INSERT INTO tag (tag_name,status) VALUES ('$tag_name','$status')";   
                    
                              if (mysqli_query($conn, $query)) {
                             
                              }
                          }
                           header("Location:".$siteurl."tags");
                          
                    }
                    ?>
                    <div class="col-md-8 col-lg-9">
						<div class="tabs">
							<div class="tab-content">
								<div class="tab-pane active" id="edit">

									<form method="post" class="form-horizontal">
										<h4 class="mb-xlg">Add Tag</h4>
										<fieldset>
											
                                            <div class="form-group">
												<label for="tags-input-multiple" class="col-md-3 control-label">Tags</label>
												<div class="col-md-7">
													<select id="tags-input-multiple" name="tag_name[]" multiple data-role="tagsinput" data-tag-class="label label-primary">
														
													</select>
													
												</div>
											</div>                                            
										
                                            <div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Status</label>
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" checked="" value="yes" name="status">
															<label for="profilePublic"></label>
														</div>
													</div>
												</div>
										</fieldset>
										<div class="panel-footer">
											<div class="row">
												<div class="col-md-9 col-md-offset-3">
													<input type="submit" name="submit" class="btn btn-default" value="Add"/>
												</div>
											</div>
										</div>

									</form>

								</div>
							</div>
						</div>
					</div>
                    <?php } ?>
                    
                </section>
            </div>
<?php include('../footer.php'); ?>
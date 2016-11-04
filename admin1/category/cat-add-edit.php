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
						<h2>CATEGORY</h2>
					
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
                    <?php
                    if(!empty($_GET['id'])){ 
                    $id = $_GET['id'];
                    if (isset($_POST["submit"])) {
                        $cat_name =  $_POST['cat_name'];
                        $sub_cat =  $_POST['sub_cat'];
                        $status = $_POST['status'];
                          if($status=='yes'){
                            $status = 1;
                          }
                          else{
                            $status = 0;
                          }
                          $query = "UPDATE category SET cat_name='$cat_name', sub_cat_id='$sub_cat', status='$status' WHERE id=".$id;
                          if ($conn->query($query) === TRUE) {
                          header("Location:".$siteurl."category");
                          }
                    }
                    
                    $result = mysqli_query($conn, "SELECT * FROM category WHERE id=".$id);
                    $row= mysqli_fetch_assoc($result);?> 
                    ?>
                     <div class="col-md-8 col-lg-9">
						<div class="tabs">
							<div class="tab-content">
								<div class="tab-pane active" id="edit">

									<form method="post" class="form-horizontal">
										<h4 class="mb-xlg">Edit Category</h4>
										<fieldset>
											<div class="form-group">
												<label for="profileFirstName" class="col-md-3 control-label">Category Name</label>
												<div class="col-md-8">
													<input type="text" value="<?php echo $row['cat_name']; ?>" name="cat_name" id="profileFirstName" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="profileCompany" class="col-md-3 control-label">Sub Category</label>
												<div class="col-md-8">
													<select name="sub_cat">
                                                    <option value="0">---</option>
                                                    <?php $query = mysqli_query($conn, "SELECT * FROM category");
                                                    while($row1 = $query->fetch_assoc()) {?>
                                                    <option value="<?php echo $row1['id'];?> " <?php echo ($row['sub_cat_id']==$row1['id']?'selected':'')?>><?php echo $row1['cat_name']; ?></option>
                                                    <?php } ?>
                                                    </select>
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
                        $cat_name =  $_POST['cat_name'];
                        $sub_cat =  $_POST['sub_cat'];
                        $status = $_POST['status'];
                          if($status=='yes'){
                            $status = 1;
                          }
                          else{
                            $status = 0;
                          }
                          $query = "INSERT INTO category (cat_name,sub_cat_id, status) VALUES ('$cat_name','$sub_cat','$status')";      
                          if (mysqli_query($conn, $query)) {
                          header("Location:".$siteurl."category");
                          }
                    }
                    ?>
                    <div class="col-md-8 col-lg-9">
						<div class="tabs">
							<div class="tab-content">
								<div class="tab-pane active" id="edit">

									<form method="post" class="form-horizontal">
										<h4 class="mb-xlg">Add Category</h4>
										<fieldset>
											<div class="form-group">
												<label for="profileFirstName" class="col-md-3 control-label">Category Name</label>
												<div class="col-md-8">
													<input type="text" name="cat_name" id="profileFirstName" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="profileCompany" class="col-md-3 control-label">Sub Category</label>
												<div class="col-md-8">
													<select name="sub_cat">
                                                    <option value="0">---</option>
                                                    <?php $query = mysqli_query($conn, "SELECT * FROM category");
                                                    while($row = $query->fetch_assoc()) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>
                                                    <?php } ?>
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
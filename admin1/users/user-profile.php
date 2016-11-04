<?php 
ob_start();
include('../header.php');
$id = $_GET['id'];
if (isset($_POST["submit"])) {
    $fname =  $_POST['fname'];
    $lname =  $_POST['lname'];
    $status = $_POST['status'];
      if($status=='yes'){
        $status = 1;
      }
      else{
        $status = 0;
      }
      $query = "UPDATE users SET fname='$fname', lname='$lname', status='$status' WHERE id=".$id;
      
      if ($conn->query($query) === TRUE) {
      header("Location:".$siteurl);
      }
}
 ?>
 
<?php if(!empty($id)){
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=".$id);
$row= mysqli_fetch_assoc($result);} ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>USER PROFILE</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    <div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="<?php echo $row['image'];?>" class="rounded img-responsive" alt="<?php echo $row['fname'].' '.$row['lname'];?>">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo $row['fname'].' '.$row['lname'];?></span>
											<span class="thumb-info-type">USER</span>
										</div>
									</div>
									<hr class="dotted short">
								</div>
							</section>
						</div>
						<div class="col-md-8 col-lg-6">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#overview" data-toggle="tab">Overview</a>
									</li>
									<li>
										<a href="#edit" data-toggle="tab">Edit</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">
										<h4 class="mb-xlg">Timeline</h4>
										<div class="timeline timeline-simple mt-xlg mb-md">
											<div class="tm-body">
												<ol class="tm-items">
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">7 months ago.</p>
															<p>
																Checkout! How cool is that!
															</p>
															<div class="thumbnail-gallery">
																<a class="img-thumbnail lightbox" href="../assets/images/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
																	<img class="img-responsive" width="215" src="../assets/images/projects/project-4.jpg">
																	<span class="zoom">
																		<i class="fa fa-search"></i>
																	</span>
																</a>
															</div>
														</div>
													</li>
												</ol>
											</div>
										</div>
									</div>
									<div id="edit" class="tab-pane">

										<form class="form-horizontal" method="post">
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">First Name</label>
													<div class="col-md-8">
														<input type="text" name="fname" value="<?php echo $row['fname']; ?>" class="form-control" id="profileFirstName">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileLastName">Last Name</label>
													<div class="col-md-8">
														<input type="text" name="lname" value="<?php echo $row['lname']; ?>" class="form-control" id="profileLastName">
													</div>
												</div>
												<div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Status</label>
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" name="status" value="yes"  <?php echo ($row['status']==1?'checked':'')?>>
															<label for="profilePublic"></label>
														</div>
													</div>
												</div>
											</fieldset>
											<hr class="dotted tall">
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="submit" name="submit" class="btn btn-primary" value="Edit"/>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
                 </section>
            </div>
                
<?php include('../footer.php'); ?>
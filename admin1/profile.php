<?php include('header.php'); ?>
			<!-- end: header -->
<?php
ob_start();
$id = $row['id'];
if (isset($_POST["submit"])) {
        $fname =  $_POST['fname'];
        $lname =  $_POST['lname'];
        $address =  $_POST['address'];
        $company =  $_POST['company'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];
        $target_path = "assets/images/profile_image/";  
        $file_upload_url = $siteurl. $target_path;
        $target_path = $target_path.$_FILES['image']['name'];
        if(!empty($newpassword) && $newpassword==$confirmpassword ){
            $newpassword = md5($newpassword);
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
            {  
              $query = "UPDATE admin SET fname='$fname', lname='$lname', address='$address', company='$company',password='$newpassword' WHERE id=".$id;
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl);
              }
            }
            else
            { 
              $image = $file_upload_url . $_FILES['image']['name'];
              $query = "UPDATE admin SET fname='$fname', lname='$lname', address='$address', company='$company',password='$newpassword', image='$image' WHERE id=".$id;
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl);
              }  
            }
        }
        else{
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
            {  
              $query = "UPDATE admin SET fname='$fname', lname='$lname', address='$address', company='$company' WHERE id=".$id;
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl);
              }
            }
            else
            { 
              $image = $file_upload_url . $_FILES['image']['name'];
              $query = "UPDATE admin SET fname='$fname', lname='$lname', address='$address', company='$company', image='$image' WHERE id=".$id;
              if ($conn->query($query) === TRUE) {
                header("Location:".$siteurl);
              }  
            }
            
        }
}
?>
			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>Admin Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Admin Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="<?php echo $row['image'];?>" class="rounded img-responsive" alt="admin">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo $row['fname'].' '.$row['lname']; ?></span>
											<span class="thumb-info-type">CEO</span>
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
										<a href="#edit" data-toggle="tab">Edit</a>
									</li>
								</ul>
								<div class="tab-content">
										
									<div id="edit" class="tab-pane active">

										<form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
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
													<label class="col-md-3 control-label" for="profileAddress">Address</label>
													<div class="col-md-8">
														<input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control" id="profileAddress">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Company</label>
													<div class="col-md-8">
														<input type="text" name="company" value="<?php echo $row['company']; ?>" class="form-control" id="profileCompany">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-3 control-label" for="profileImage">Image</label>
													<div class="col-md-8">
														<input type="file" name="image">
													</div>
												</div>
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">Change Password</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
													<div class="col-md-8">
														<input type="text" name="newpassword" class="form-control" id="profileNewPassword">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
													<div class="col-md-8">
														<input type="text" name="confirmpassword" class="form-control" id="profileNewPasswordRepeat">
													</div>
												</div>
											</fieldset>
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
					<!-- end: page -->
				</section>
			</div>
<?php include('footer.php'); ?>
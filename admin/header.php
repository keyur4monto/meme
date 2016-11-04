<?php
include 'db.php';
$username = $_SESSION['username'];
if(!isset($_SESSION['username']))// make sure user is a admin
{
    session_start();
    session_destroy();
    header("location:../login.php");
    die;
}
$result1 = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$row1 = $result1->fetch_assoc();?>
<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo $siteurl; ?>" class="logo">
						<img src="<?php echo $siteurl.'assets/images/logo.png'?>" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="http://preview.oklerthemes.com/porto-admin/1.5.4/pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo $row1['image'];?>" alt="<?php echo $row1['fname'].' '.$row1['lname']; ?>" class="img-circle"/>
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $row1['fname'].' '.$row1['lname']; ?></span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $siteurl.'profile.php'?>"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $siteurl.'logout.php'?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
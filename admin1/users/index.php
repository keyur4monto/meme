<?php include('../header.php'); ?>
			<!-- end: header -->

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
								<li><span>Users</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->
						<section class="panel">
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Username</th>
											<th>Email</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $query = mysqli_query($conn, "SELECT * FROM users");
                                        while($row = $query->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><img style="height: 100px; width: 100px;" src="<?php echo $row['image']; ?>"/></td>
                                            <td>
                                                <a href="user-profile.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
									</tbody>
								</table>
							</div>
						</section> 
                    </section>
			     </div>
<?php include('../footer.php'); ?>
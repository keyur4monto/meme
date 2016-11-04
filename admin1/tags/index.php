<?php include('../header.php'); ?>
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

					<!-- start: page -->
						<section class="panel">
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Tag Name</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $query = mysqli_query($conn, "SELECT * FROM tag");
                                        while($row = $query->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['tag_name']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                                <a href="tag-add-edit.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
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
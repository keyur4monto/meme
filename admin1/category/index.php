<?php include('../header.php'); ?>
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

					<!-- start: page -->
                    
						<section class="panel">
                        <!--<a style="float: right; color: black;" href="cat-add-edit.php" class="">Add New</a>-->
							<div class="panel-body">
                            
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Category Name</th>
                                            <th>Sub Category Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $query = mysqli_query($conn, "SELECT * FROM category");
                                        while($row = $query->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['cat_name']; ?></td>
                                            <?php $query1 = mysqli_query($conn, "SELECT cat_name FROM category where id=".$row['sub_cat_id']);
                                            $row1 = $query1->fetch_assoc();?>
                                            <td><?php echo $row1['cat_name']; ?></td>
                                            <td>
                                                <a href="cat-add-edit.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
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
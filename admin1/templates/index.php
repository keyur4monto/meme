<?php include('../header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../sidebar.php'); ?>
				<!-- end: sidebar -->
                <section role="main" class="content-body">
					<header class="page-header">
						<h2>TEMPLATES</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $siteurl; ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Templates</span></li>
							</ol>
                            <a class="sidebar-right-toggle"></a>
						</div>
					</header>
                    <section class="content-with-menu content-with-menu-has-toolbar media-gallery">
						<div class="content-with-menu-container">
							<div class="inner-menu-toggle">
								<a data-open="inner-menu" class="inner-menu-expand" href="#">
									Show Bar <i class="fa fa-chevron-right"></i>
								</a>
							</div>
							<div class="inner-body mg-main">
								<div class="row mg-files">
                                <?php $query = mysqli_query($conn, "SELECT * FROM template");
                                while($row1 = $query->fetch_assoc()) {
                                $img_src = $row1['template_image'];
                                $imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
                                $img_str = base64_encode($imgbinary);                                    
                                ?>	
									<div class="isotope-item image col-sm-6 col-md-4 col-lg-3">
										<div class="thumbnail">
											<div class="thumb-preview">
												<a href="meme_generate.php?id=<?php echo $row1['id']; ?>" id="<?php echo 'template_id_'.$row1['id']; ?>" class="thumb-image">
													
                  <?php echo '<img alt='.$row1['tempate_name'].'class="img-responsive" src="'.$homeurl.$img_src.'" />'; ?>
												</a>
												
											</div>
											<h5 class="mg-title text-weight-semibold"><?php echo $row1['template_name'];?></h5>
											<div class="mg-description">
												<small class="pull-left text-muted">
                                                <?php $cat_id = $row1['cat_id']; $query1 = mysqli_query($conn, "SELECT cat_name FROM category where id=$cat_id");
                                                $cat = $query1->fetch_assoc()?>
                                                <?php echo $cat['cat_name']; ?></small>
												
											</div>
										</div>
									</div>
                                <?php } ?>
								</div>
							</div>
						</div>
					</section>
                    </section>
			     </div>
<?php include('../footer.php');?>

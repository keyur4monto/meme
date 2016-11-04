<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Menu
						</div>
						<!--<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>-->
					</div>
				
						<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="<?php echo $siteurl; ?>">
											<i aria-hidden="true" class="fa fa-home"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="<?php echo $siteurl.'users'; ?>">
											<i aria-hidden="true" class="fa fa-users"></i>
											<span>Users</span>
										</a>
									</li>
                                    <li class="nav-parent <?php 
									if($_SERVER['REQUEST_URI'] == '/admin/category/'){
										echo 'nav-expanded nav-active';
									}
									?>" >
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Category</span>
										</a>
										<ul class="nav nav-children" style="">
											<li class="<?php 
										if($_SERVER['REQUEST_URI'] == '/admin/category/'){
										echo 'nav-active';
									} ?>">
												<a href="<?php echo $siteurl.'category'; ?>">
													 Category List
												</a>
											</li>
				
										</ul>
									 </li>
                                     <li class="nav-parent <?php 
									if($_SERVER['REQUEST_URI'] == '/admin/tags/'){
										echo 'nav-expanded nav-active';
									}
									?>" >
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Tags</span>
										</a>
										<ul class="nav nav-children" style="">
											<li class="<?php 
										if($_SERVER['REQUEST_URI'] == '/admin/tags/'){
										echo 'nav-active';
									} ?>">
												<a href="<?php echo $siteurl.'tags'; ?>">
													 Tags List
												</a>
											</li>
						
										</ul>
									  </li>
                                      
                                      <li class="nav-parent <?php 
									if($_SERVER['REQUEST_URI'] == '/admin/templates/' || 
									   $_SERVER['PHP_SELF'] == '/admin/templates/filter-template.php' ||
									   $_SERVER['PHP_SELF'] == '/admin/templates/new-template.php'){
										echo 'nav-expanded nav-active';
									}
									?>" >
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Templates</span>
										</a>
										<ul class="nav nav-children" style="">
											<li class="<?php 
										if($_SERVER['REQUEST_URI'] == '/admin/templates/'){
										echo 'nav-active';
									} ?>">
												<a href="<?php echo $siteurl.'templates'; ?>">
													 All Templates
												</a>
											</li>
											<li class="<?php 
											if($_SERVER['PHP_SELF'] == '/admin/templates/filter-template.php'){
												echo 'nav-active';
											}
											?>">
												<a href="<?php echo $siteurl.'templates/filter-template.php'; ?>">
													 Template Filter
												</a>
											</li>
                                            <?php /*?><li class="<?php 
											if($_SERVER['PHP_SELF'] == '/meme/admin/templates/new-template.php'){
												echo 'nav-active';
											}
											?>">
												<a href="<?php echo $siteurl.'templates/new-template.php'; ?>">
													 Add New Template
												</a>
											</li><?php */?>
										</ul>
									  </li>
                                      
                                      <li class="nav-parent <?php 
									if($_SERVER['REQUEST_URI'] == '/admin/meme/' || 
									   $_SERVER['PHP_SELF'] == '/admin/meme/filter-meme.php'){
										echo 'nav-expanded nav-active';
									}
									?>" >
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Meme</span>
										</a>
										<ul class="nav nav-children" style="">
											<li class="<?php 
										if($_SERVER['REQUEST_URI'] == '/admin/meme/'){
										echo 'nav-active';
									} ?>">
												<a href="<?php echo $siteurl.'meme'; ?>">
													 All Meme
												</a>
											</li>
											<li class="<?php 
											if($_SERVER['PHP_SELF'] == '/admin/meme/filter-meme.php'){
												echo 'nav-active';
											}
											?>">
												<a href="<?php echo $siteurl.'meme/filter-meme.php'; ?>">
													 Meme Filter
												</a>
											</li>
                                          
										</ul>
									  </li>
                                      
                                
                                    <li class="<?php 
									if($_SERVER['REQUEST_URI'] == '/admin/settings/'){
										echo 'nav-expanded nav-active';
									}
									?>">
										<a href="<?php echo $siteurl.'settings'; ?>">
											<i aria-hidden="true" class="fa fa-users"></i>
											<span>Settings</span>
										</a>
									</li>
									
								</ul>
							</nav>
						</div>
                        
				
						<script>
							// Maintain Scroll Position
							if (typeof localStorage !== 'undefined') {
								if (localStorage.getItem('sidebar-left-position') !== null) {
									var initialPosition = localStorage.getItem('sidebar-left-position'),
										sidebarLeft = document.querySelector('#sidebar-left .nano-content');
									
									sidebarLeft.scrollTop = initialPosition;
								}
							}
						</script>
				
					</div>
				
				</aside>
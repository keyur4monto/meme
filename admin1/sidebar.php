<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
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
                                    <li class="nav-parent" style="">
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Category</span>
										</a>
										<ul class="nav nav-children" style="">
											<li>
												<a href="<?php echo $siteurl.'category'; ?>">
													 Category List
												</a>
											</li>
											<li>
												<a href="<?php echo $siteurl.'category/cat-add-edit.php'; ?>">
													 Add New Category
												</a>
											</li>
										</ul>
									 </li>
                                     <li class="nav-parent" style="">
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Tags</span>
										</a>
										<ul class="nav nav-children" style="">
											<li>
												<a href="<?php echo $siteurl.'tags'; ?>">
													 Tags List
												</a>
											</li>
											<li>
												<a href="<?php echo $siteurl.'tags/tag-add-edit.php'; ?>">
													 Add New Tag
												</a>
											</li>
										</ul>
									  </li>
                                      
                                      <li class="nav-parent" style="">
										<a>
											<i aria-hidden="true" class="fa fa-tags"></i>
											<span>Templates</span>
										</a>
										<ul class="nav nav-children" style="">
											<li>
												<a href="<?php echo $siteurl.'templates'; ?>">
													 All Templates
												</a>
											</li>
											<li>
												<a href="<?php echo $siteurl.'templates/new_template.php'; ?>">
													 Add New Template
												</a>
											</li>
										</ul>
									  </li>
                                      <li>
										<a href="<?php echo $siteurl.'meme'; ?>">
											<i aria-hidden="true" class="fa fa-users"></i>
											<span>MEME</span>
										</a>
									</li>
                                    <li>
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
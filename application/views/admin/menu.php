<!-- Content container -->
	<div id="container">

		<!-- Sidebar -->
		<div id="sidebar">

			<div class="sidebar-tabs">
		        <ul class="tabs-nav two-items">
		            <li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
		            <li><a href="#stuff" title=""><i class="icon-cogs"></i></a></li>
		        </ul>

		        <div id="general">

			        <!-- Sidebar user -->
			        <div class="sidebar-user widget">
                                    <div class="navbar"><div class="navbar-inner"><h6>Wazzup, <?php echo $this->session->userdata("username"); ?> !</h6></div></div>
			            <a href="#" title="" class="user"><img src="<?php echo $this->config->item("image_url")."media/user/".$this->session->userdata("image_user"); ?>" alt="" /></a>
			            <ul class="user-links">
			            	<!--<li><a href="" title="">New content<strong><?php //echo $count_user; ?></strong></a></li>
                                        <li><a href="" title="">New orders<strong>+156</strong></a></li>-->
			            	<li><a href="" title="">New messages<strong>+45</strong></a></li>
			            </ul>
			        </div>
			    
                      <ul class="navigation widget">
                          <li><a href="<?php echo base_url().$permission; ?>/home.aspx" title=""><i class="icon-home"></i>Dashboard</a></li>
                          <li><a href="#" title="" class="expand"><i class="icon-columns"></i>Web Page</a>  
                               <ul><?php echo $mweb; ?></ul>
                          </li>
                          <li><a href="#" title="" class="expand"><i class="icon-barcode"></i>Products</a>  
                               <ul><?php echo $mproducts; ?></ul>
                          </li>
                          <li><a href="#" title="" class="expand"><i class="icon-sitemap"></i>Blog</a>  
                                <ul><?php echo $mblog; ?></ul>
                           </li>
                           <?php if($permission=="administrator"){
                           echo '<li><a href="#" title="" class="expand"><i class="icon-group"></i>Administrator</a>'; 
                           echo '<ul>'.$madmin.'</ul></li>';
                           }else{
                            echo '<li><a href="#" title="" class="expand"><i class="icon-user-md"></i>User</a>'; 
                           echo '<ul>'.$madmin.'</ul></li>';
                           }?> 
                     </ul>
			      
		        </div>

		        <div id="stuff">

			        <!-- Social stats -->
			        <div class="widget">
			        	<h6 class="widget-name"><i class="icon-twitter"></i>Social statistics</h6>
			        	<ul class="social-stats">
			        		<li>
			        			<a href="" title="" class="orange-square"><i class="icon-rss"></i></a>
			        			<div>
				        			<h4>1,286</h4>
				        			<span>total feed subscribers</span>
				        		</div>
			        		</li>
			        		<li>
			        			<a href="" title="" class="blue-square"><i class="icon-twitter"></i></a>
			        			<div>
				        			<h4>12,683</h4>
				        			<span>total twitter followers</span>
				        		</div>
			        		</li>
			        		<li>
			        			<a href="" title="" class="dark-blue-square"><i class="icon-facebook"></i></a>
			        			<div>
				        			<h4>530,893</h4>
				        			<span>total facebook likes</span>
				        		</div>
			        		</li>
			        	</ul>
			        </div>
			        <!-- /social stats -->


                   
		        </div>

		    </div>
		</div>
		<!-- /sidebar -->

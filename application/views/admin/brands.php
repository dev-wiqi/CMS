<div id="content">

			<!-- Content wrapper -->
		    <div class="wrapper">
             <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title; ?></h5>
				    	<span>Content Management</span>
			    	</div>

			    	<ul class="page-stats">
			    		<li>
			    			<div class="showcase">
			    				<span>New visits</span>
			    				<h2>22.504</h2>
			    			</div>
			    			<div id="total-visits" class="chart">10,14,8,45,23,41,22,31,19,12, 28, 21, 24, 20</div>
			    		</li>
			    	</ul>
			    </div>
                 <!-- Action tabs -->
			    <div class="actions-wrapper">
				    <div class="actions">

				    	<div id="user-stats">
					        <ul class="round-buttons">
					            <li><div class="depth"><a href="<?php echo base_url().$link; ?>" title="Add new content" class="tip"><i class="icon-plus"></i></a></div></li>
					        </ul>
				    	</div>
				    	<ul class="action-tabs">
				    		<li><a href="#user-stats" title="">New Content</a></li>
				    	</ul>
				    </div>
				</div>
			    <!-- /action tabs -->
<!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6><?php echo $title; ?></h6></div></div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brands</th>
                                    <th>Logo</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php echo $content; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /default datatable -->
    </div>
</div>
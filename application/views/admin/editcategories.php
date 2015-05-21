<div id="content">

			<!-- Content wrapper -->
		    <div class="wrapper">
             <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title; ?></h5>
				    	<span>Post New Article</span>
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
<!-- Form validation -->
	            <h5 class="widget-name"></h5>

		<?php echo form_open_multipart($action); ?>
	                <fieldset>

	                    <!-- Form validation -->
	                    <div class="widget">
	                        <div class="navbar"><div class="navbar-inner"><h6><?php echo $title2; ?></h6></div></div>
	                    	<div class="well row-fluid">

	                            <div class="control-group">
	                                <label class="control-label">Name: <span class="text-error">*</span></label>
	                                <div class="controls">
                                            <input type="text" class="validate[required] span3" name="title" value="<?php echo $name; ?>" id="req"/>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
	                                </div>
	                            </div>
	                           
                               <div class="control-group">
	                                <label class="control-label">Parent Categories: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <select name="kategori" class="validate[required] styled" data-prompt-position="topLeft:-1,-5">
                                                <option value="0">--Select Parent--</option>
                                                <?php echo $categories; ?>
	                                    </select>
	                                </div>
	                            </div>
                             <div class="form-actions align-right">
	                                <button type="submit" class="btn btn-info">Submit</button>
	                                <button type="reset" class="btn">Reset</button>
	                            </div>

	                        </div>

	                    </div>
	                    <!-- /form validation -->

	                </fieldset>
				<?php echo form_close(); ?>
				<!-- /form validation -->
        </div>
    </div>
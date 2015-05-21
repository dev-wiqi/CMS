<div id="content">

			<!-- Content wrapper -->
		    <div class="wrapper">
             <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title; ?></h5>
				    	<span><?php echo $title2; ?></span>
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
                    <div class="well">    
                <?php echo $this->session->flashdata("result_action");?>
		<?php echo form_open_multipart($action); ?>
	                <fieldset>
                        
	                    <!-- Form validation -->
	                    <div class="widget">
	                        <div class="navbar"><div class="navbar-inner"><h6><?php echo $title2; ?></h6></div></div>
	                    	<div class="well row-fluid">

	                            <div class="control-group">
	                                <label class="control-label">Title: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required] span10" name="title" id="req" value="<?php echo $name; ?>"/>
	                                </div>
	                            </div>
	                           
                               <div class="control-group">
	                                <label class="control-label">Categori: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <select name="kategori" class="validate[required] styled" data-prompt-position="topLeft:-1,-5">
	                                       <?php echo $categories; ?>
	                                    </select>
	                                </div>
	                            </div>
                               
                               
                               <div class="control-group">
	                                <label class="control-label">Author: </label>
	                                <div class="controls">
	                                    <input type="text" class="input-medium" readonly id="req" name="author" value="<?php echo $author; ?>"/>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
	                                </div>
	                            </div>
                                
                                <div class="control-group">
	                                <label class="control-label">Date : </label>
	                                <div class="controls">
	                                    <input type="text" class="input-small" readonly id="req" name="date" value="<?php echo $date; ?>"/>
	                                </div>
	                            </div>

	                            <div class="control-group">
	                                <label class="control-label">Source: </label>
	                                <div class="controls">
	                                    <textarea name="content" class="ckeditor"><?php echo $source; ?></textarea>
	                                </div>
	                            </div>
                               
                               <div class="control-group">
                                    <label class="control-label">Image Upload:</label>
                                    <div class="controls">
                                        <input type="file" class="styled" name="img" />
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
    </div>
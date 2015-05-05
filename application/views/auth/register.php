<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>assetsCI/css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]><link href="<?php echo base_url(); ?>css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<!--[if IE 9]><link href="<?php echo base_url(); ?>css/ie9.css" rel="stylesheet" type="text/css" /><![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>


</head>

<body class="login">
	
	<!-- Wrapper -->
<div id="login">

	<!-- Box -->
	<div class="form-signin">
		<h3>Create Account <span>Already a member? <a href="login.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light">Sign in</a></span></h3>
		
		<!-- Form -->
		<?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata("result_register"); ?>
                <?php echo form_open("auth/auth_register"); ?>
		<!-- Row -->
		<div class="row innerLR">
		
			<!-- Column -->
			<div class="col-md-6 border-right innerT innerB">
				<div class="innerAll">
					<label class="strong">Username</label>
					<input type="text" name="username" class="input-block-level form-control" placeholder="Your Username"/>
                                        <label class="strong">Email</label>
                                        <input type="text" name="email" class="input-block-level form-control" placeholder="Your Email"/>
					<label class="strong">Password</label>
                                        <input type="password" name="password" class="input-block-level form-control" placeholder="Your Password"/>
                                        <button class="btn btn-block btn-primary" type="submit">Sign in</button>
				</div>
			</div>
			<!-- // Column END -->
		</div>
		<!-- // Row END -->
		
		</form>
		<!-- // Form END -->
		
		<div class="ribbon-wrapper"><div class="ribbon success">register</div></div>
	</div>
	<!-- // Box END -->
	
</div>
<!-- // Wrapper END -->	
<div id="footer">
		<div class="copyrights">&copy;  Tramedifa GTPD - Wisnu</div>
		<ul class="footer-links">
			<li><a href="" title=""><i class="icon-cogs"></i>Contact admin</a></li>
			<li><a href="" title=""><i class="icon-screenshot"></i>Report bug</a></li>
		</ul>
	</div>
	<!-- /footer -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetsCI/js/plugins/forms/jquery.uniform.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetsCI/js/files/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetsCI/js/files/login.js"></script>

</body>
</html>

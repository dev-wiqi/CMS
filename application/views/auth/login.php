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

<body class="no-background">

	<!-- Fixed top -->
	<div id="top">
		<div class="fixed">
			<a href="index.html" title="" class="logo"><img src="<?php echo base_url(); ?>assetsCI/img/(logo).png" alt="" /></a>
		</div>
	</div>
	<!-- /fixed top -->
            
    <!-- Login block -->
    <div class="login">
        <?php echo $this->session->flashdata("result_login"); echo $this->session->flashdata("result_register");?>
        <?php
        if(validation_errors()){    
        echo '<div class="alert">
	                        <button type="button" class="close" data-dismiss="alert">X</button>
	                        '.validation_errors().'
        </div>';}
            ?>
        <div class="navbar">
            <div class="navbar-inner">
                <h6><i class="icon-user"></i>Login page</h6>
                <div class="nav pull-right">
                    <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#"><i class="icon-plus"></i>Register</a></li>
                        <li><a href="#"><i class="icon-refresh"></i>Recover password</a></li>
                        <!--
<li><a href="#"><i class="icon-cog"></i>Settings</a></li>
-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="well">
            <?php $d['class']="row-fluid"; echo form_open("auth/auth",$d); ?>
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls"><input class="span12" type="text" name="username" placeholder="username" /></div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Password:</label>
                    <div class="controls"><input class="span12" type="password" name="password" placeholder="password" /></div>
                </div>

                <!--
<div class="control-group">
                    <div class="controls"><label class="checkbox inline"><input type="checkbox" name="checkbox1" class="styled" value="" checked="checked">Remember me</label></div>
                </div>
-->

                <div class="login-btn"><input type="submit" value="Log me in" class="btn btn-danger btn-block" /></div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /login block -->


	<!-- Footer -->
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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('assets/css/bootstrap-responsive.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet" type="text/css">

<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<a href='<?php echo site_url('admin_control/user_management')?>'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		welcome admin 
	</a>
	<br></br>

	<a href='<?php echo site_url('admin_control/logout_management')?>'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Logout
	</a>
	<br></br>
	
	<div>&nbsp;&nbsp;
		<a class="btn btn-large btn-primary" href='<?php echo site_url('admin_control/user_management')?>'>&nbsp;User&nbsp;</a>&nbsp;&nbsp;
		<a class="btn btn-large btn-primary" href='<?php echo site_url('admin_control/project_management')?>'>&nbsp;Project&nbsp;</a>&nbsp;&nbsp;
		<a class="btn btn-large btn-primary" href='<?php echo site_url('admin_control/timecard_management')?>'>&nbsp;Timecard&nbsp;</a>
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js') ?>" type="text/javascript"></script>

</body>
</html>

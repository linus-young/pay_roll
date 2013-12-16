<html>
	<head>
	<title>Start Work</title>

	<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('assets/css/bootstrap-responsive.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css">
	
	</head>
	<body>
		<div style="margin-left: 250px">
			<h2>Welcome <?php echo $name; ?>!</h2>
			<a href='<?php echo site_url('home/logout')?>'>Logout</a>
			<br /> <br />
			
			<br /> <br />
			<div class="workstuff">			
				<button class="start"><img src="<?php echo base_url('assets/img/startgrey.jpg') ?>" alt="start_work"></button>
			</div>
			<div class="workstuff">
				<?php echo form_open('workstuff/stop_work'); ?>
					<button class="stop"><img src="<?php echo base_url('assets/img/stop.jpg') ?>" alt="stop_work"></button>
				</form>
			</div>

			<script src="<?php echo base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
	    	<script src="<?php echo base_url('assets/js/bootstrap.js') ?>" type="text/javascript"></script>
		</div>

	</body>
</html>
<html>
	<head>
	<title>Confirm Project</title>

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
			
			You have chosed:
			<?php
				echo $project_selected;
			?>
			
			<br /> <br />
			<div class="workstuff">
				<?php echo form_open('workstuff/start_work'); ?>
					<button class="start"><img src="<?php echo base_url('assets/img/start.jpg') ?>" alt="start_work"></button>
				</form>
			</div>
			<div class="workstuff">
				<button class="stop"><img src="<?php echo base_url('assets/img/stopgrey.jpg') ?>" alt="stop_work"></button>
			</div>

			<script src="<?php echo base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
	    	<script src="<?php echo base_url('assets/js/bootstrap.js') ?>" type="text/javascript"></script>
		</div>

	</body>
</html>
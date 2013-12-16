<html>
	<head>
	<title>Welcome</title>

	<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('assets/css/bootstrap-responsive.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet" type="text/css">
	
	</head>
	<body>
		<div style="margin-left: 250px">
			<h2>Welcome <?php echo $name; ?>!</h2>
			<a href="home/logout">Logout</a>
			<br />
			<br />
			<?php
				$p_name_arr = array();
				foreach($project_list as $key => $value) {
					array_push($p_name_arr, $value['name']);
				}
			?>

			<?php echo form_open('workstuff/confirm_project'); ?>
				<div>
					Choose One Project:
					<select name="p_name_arr[]">
						
						<?php
							$p_count = count($p_name_arr);
							while($p_count--) {
							?>
							<option name="pname" value="<?=$p_name_arr[$p_count]?>">
								<?=$p_name_arr[$p_count]?>
							</option>
							<?php 
							}
						?>
						
					</select>
				</div>
				<button class="btn btn-large btn-primary">Confirm</button>
			</form>

			<br />  <br />
			<button class="start"><img src="<?php echo base_url('assets/img/startgrey.jpg') ?>" alt="start_work"></button>
			<button class="stop"><img src="<?php echo base_url('assets/img/stopgrey.jpg') ?>" alt="stop_work"></button>

			<script src="<?php echo base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
	    	<script src="<?php echo base_url('assets/js/bootstrap.js') ?>" type="text/javascript"></script>
		</div>

	</body>
</html>
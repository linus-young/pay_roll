<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css">

</head>
<body>
	<div style="margin-left: 30px">
		<h2 class="welcome">Welcome admin!</h2>
		<a href='<?php echo site_url('admin_control/logout_management')?>' class="logout">
			Logout
		</a>
		<br></br>
		
		<div>
			<a href='<?php echo site_url('admin_control/user_management')?>' class="management">&nbsp;User&nbsp;</a>&nbsp;&nbsp;
			<a href='<?php echo site_url('admin_control/project_management')?>' class="management">&nbsp;Project&nbsp;</a>&nbsp;&nbsp;
			<a href='<?php echo site_url('admin_control/timecard_management')?>' class="management">&nbsp;Timecard&nbsp;</a>&nbsp;&nbsp;
			<a href='<?php echo site_url('admin_control/this_week_timecard_management')?>' class="management">&nbsp;This Week&nbsp;</a>&nbsp;&nbsp;
			<a href='<?php echo site_url('admin_control/print_management')?>' class="management">&nbsp;Pay Roll&nbsp;</a>

			<?php
				$current_uri =  $this->uri->uri_string();
				// judge where you are in timecard employment page.
				if(strpos($current_uri, 'this_week') !== false) {
					echo form_open('admin_control/print_management');
				?>
					<button class="btn btn-primary btn-large submit-timecard">Submit This Week</button>
				<?php 
				}
			?>
		</div>
	</div>
	<div style='height:10px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
	
</body>
</html>

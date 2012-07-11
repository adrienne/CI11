<h2>Welcome to the CI11 test area</h2>

<?php  
	// acessing our userdata cookie
	$cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
	$logged_in = isset ($cookie['logged_in']);
	unset ($cookie);
		
	if ($logged_in) : ?>

	<div class="notification attention" style="text-align: center">
		<?php echo anchor(SITE_AREA, 'Dive into Admin'); ?>
	</div>

<?php else :?>

	<p style="text-align: center">
		<?php echo anchor('/login', 'Login'); ?>
	</p>

<?php endif;?>

<?php echo anchor('home/dashboard/'. 1, "Dashboard", '') ?>
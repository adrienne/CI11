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

	<?php echo anchor('home/dashboard/'. 1, "Style 1", '') ?>
	<?php echo anchor('home/dashboard/'. 2, "Style 2", '') ?>
	  
	<div id="content" style="font-size: 14px">	  
	  <div id="left" style="float:left; width: 67%;">
	     <?php Template::block('leftColumn', $panels[0], array('records' => $records[0])); ?>
	  </div>
	  <div id="right" style="float:left; width: 33%;">
	     <?php Template::block('rightColumn', $panels[1], array('records' => $records[1])); ?>
	  </div>
	  <div style="clear:both"></div>
	</div>
<?php else :?>
	<p style="text-align: center">
		<?php echo anchor('/login', 'Login'); ?>
	</p>
<?php endif;?>

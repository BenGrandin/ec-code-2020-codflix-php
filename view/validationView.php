<?php ob_start();

	echo '<p>'.$sentence.'</p>';
	$content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
<?php

	define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/ec-code-2020-codflix-php');
	require_once('controller/homeController.php');
	require_once('controller/contactController.php');
	require_once('controller/loginController.php');
	require_once('controller/signupController.php');
	require_once('controller/mediaController.php');
	require_once('controller/validationController.php');
	/**************************
	 * ----- HANDLE ACTION -----
	 ***************************/
	global $user_id;
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$is_active = isset($_SESSION['is_active']) ? $_SESSION['is_active'] : false;

	if (isset($_GET['action'])):

		switch ($_GET['action']):

			case 'contact':
				contact();
				break;

			case 'login':

				if ($user_id) {
					mediaPage();
				} else {
					if (!empty($_POST)) login();
					else loginPage();
				}
				break;

			case 'signup':
				if ($user_id) {
					mediaPage();
				} else {
					signupPage();
				}
				break;

			case 'logout':

				logout();

				break;
			case 'validation':
				validationPage();
		endswitch;

	else:
		if ($user_id) {

//			var_dump($_SESSION);
			if ($is_active) {
				mediaPage();
			} else {
				validationPage();
			}
		} else {
			homePage();
		}
	endif;
<?php

	define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/ec-code-2020-codflix-php');
	require_once('controller/homeController.php');
	require_once('controller/contactController.php');
	require_once('controller/loginController.php');
	require_once('controller/signupController.php');
	require_once('controller/mediaListController.php');
	require_once('controller/mediaController.php');
	require_once('controller/tvshowController.php');
	require_once('controller/validationController.php');
	require_once('controller/profileController.php');

	/**************************
	 * ----- HANDLE ACTION -----
	 ***************************/
	global $user_id;
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$emailVerified = isset($_SESSION['emailVerified']) ? $_SESSION['emailVerified'] : false;

	if (isset($_GET['action'])):

		switch ($_GET['action']):

			case 'contact':
				contact();
				break;

			case 'login':
				if ($user_id) {
					mediaListPage();
				} else {
					if (!empty($_POST)) login();
					else loginPage();
				}
				break;

			case 'logout':
				logout();
				break;

			case 'profile':
				if ($user_id) {
					profilePage();
				} else {
					signupPage();
				}
				break;

			case 'signup':
				if ($user_id) {
					mediaListPage();
				} else {
					signupPage();
				}
				break;

			case 'movie':
				if ($user_id) {
					mediaPage();
				} else {
					signupPage();
				}
				break;
			case 'tvshow':
				if ($user_id) {
					tvshowPage();
				} else {
					signupPage();
				}
				break;

			case 'validation':
				validationPage();
				break;

			case 'history':
				mediaListPage();
				break;

			case 'mediaListDisplayer':
				mediaListDisplayer();
				break;
		endswitch;

	else:
		if ($user_id) {
			if ($emailVerified) {
				mediaListPage();
			} else {
				validationPage();
			}
		} else {
			homePage();
		}
	endif;

<?php

	session_start();

	require_once('model/user.php');

	/****************************
	 * ----- LOAD LOGIN PAGE -----
	 ****************************/

	function loginPage() {

		$user = new stdClass();
		$user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

		if (!$user->id):
			require('view/auth/loginView.php');
		else:
			require('view/homeView.php');
		endif;

	}

	/***************************
	 * ----- LOGIN FUNCTION -----
	 **************************
	 */

	function login() {
		$data = new stdClass();
		$data->email = $_POST['email'];
		$data->password = hash('sha256', $_POST['password']);

		$user = new User($data);
		$userData = $user->getUserByEmail();


		if ($userData && sizeof($userData) != 0) {
			// Set session
			$_SESSION['user_id'] = $userData['id'];
			$_SESSION['emailVerified'] = $userData['emailVerified'];

			header('location: index.php ');
		} else {
			$error_msg = "Email ou mot de passe incorrect";
		}

		require('view/auth/loginView.php');
	}

	/****************************
	 * ----- LOGOUT FUNCTION -----
	 ****************************/

	function logout() {
		$_SESSION = array();
		session_destroy();

		header('location: index.php');
	}

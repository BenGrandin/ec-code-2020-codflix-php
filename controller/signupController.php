<?php

	require_once('model/user.php');
	include('utils/utils.php');

	/****************************
	 * ----- LOAD SIGNUP PAGE -----
	 ****************************/

	function signupPage() {

		$user = new stdClass();
		$user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

		if (!$user->id):
			require('view/auth/signupView.php');
		else:
			require('view/homeView.php');
		endif;


	}

	/***************************
	 * ----- SIGNUP FUNCTION -----
	 ***************************/
	function signUp() {

		// On verifie d'abord qu'on reçoit des données via le formulaire
		if (!empty($_POST)) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password_confirm = $_POST['password_confirm'];
			$valid = true;
			global $errors;

			// On attribut les valeur recuperer dans le form
			if (isset($_POST['Valider'])) {
				$mail = htmlentities(strtolower($email));
				$password = htmlentities(trim($password));
				$conf_password = htmlentities(trim($password_confirm));

				if (empty($mail)) {
					$valid = false;
					$errors->email = "Le mail ne peut pas être vide";
				} elseif (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,})$/i", $mail)) {
					$valid = false;
					$errors->email = "Le mail n'est pas valide";

				}
			}
			if (empty($password)) {
				$valid = false;
				$errors->password = "Le mot de passe ne peut pas être vide";
			} elseif ($password != $conf_password) {
				$valid = false;
				$errors->password = "La confirmation du mot de passe ne correspond pas";
			}
			if ($valid) {
				$password = hash('sha256', $password);
				$new_user = new User();
				$new_user->setEmail($mail);
				$new_user->setPassword($password);
				$new_user->createUser();
			} else {
				displayArrayWithKeys($errors);
			}
		}
	}

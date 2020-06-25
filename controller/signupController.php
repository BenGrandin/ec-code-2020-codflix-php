<?php

	require_once('model/User.php');
	include('utils/utils.php');

	/****************************
	 * ----- LOAD SIGNUP PAGE -----
	 ****************************/

	function signupPage() {
			require('view/auth/signupView.php');
	}

	/***************************
	 * ----- SIGNUP FUNCTION -----
	 **************************
	 * @throws Exception
	 */
	function signUp() {

		// On verifie d'abord qu'on reçoit des données via le formulaire
		if (!empty($_POST)) {
			global $valid;
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password_confirm = $_POST['password_confirm'];
			$valid = true;

			// On attribut les valeur recuperer dans le form
			if (isset($_POST['Valider'])) {
				$mail = htmlentities(strtolower($email));
				$password = htmlentities(trim($password));
				$conf_password = htmlentities(trim($password_confirm));

				if (empty($mail) || !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,})$/i", $mail)) {
					$valid = false;
					throw new Exception("Le mail n'est pas valide");
				}
				if (empty($password) || $password != $conf_password) {
					$valid = false;
					throw new Exception("Le mot de passe est vide ou la confirmation ne correspond pas");
				}
				if ($valid) {
					$password = hash('sha256', $password);
					$new_user = new User();
					$new_user->setEmail($mail);
					$new_user->setPassword($password);

					$new_user->createUser();

				}
			}
		}
	}

<?php

	require_once('model/User.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/
	global $email;
	global $password;
	global $new_password;
	global $new_password_confirm;


	function profilePage() {

		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

		$user = User::getUserById($user_id);

		$edit_mode = $_GET['edit_mode'];
		$error_msg = false;
		$success_msg = false;
		try {
			$success_msg = updateProfile($user);
		} catch (Exception $e) {
			$error_msg = $e->getMessage();
		}


		require('view/profileView.php');


	}

	/***************************
	 * ----- SIGNUP FUNCTION -----
	 **************************
	 * @param $user
	 * @return string|null
	 */
	function updateProfile($user) {
		$success_msg = "";
		if (!empty($_POST)) {
			checkForm($user);


			var_dump($_POST);
			$email = htmlentities(strtolower($_POST['email']));
			$new_password = htmlentities(trim($_POST['new_password']));
			echo 'okkkk';

			if ($email !== $user['email']) {
				$success_msg .= 'Votre email a bien été modifiée';

				User::updateUserEmail($user['id'], $user['email']);
			}
			if ($new_password !== $_POST['password']) {
				if ($success_msg !== "") {
					$success_msg .= 'Votre email et votre mot de passe ont bien été modifiés';
				}
				$success_msg .= 'Votre mot de passe a bien été modifié';

				User::updateUserPassword($user['id'], $new_password);
			}

		}
		return $success_msg;
	}

	function checkForm($user) {
		// On verifie d'abord qu'on reçoit des données via le formulaire
		if (!empty($_POST)) {
			echo 'hibou';
			$email = htmlentities(strtolower($_POST['email']));
			$password = hash('sha256', $_POST['password']);
			$new_password = htmlentities(trim($_POST['new_password']));
			$new_password_confirm = htmlentities(trim($_POST['new_password_confirm']));
			// On attribut les valeur recuperer dans le form
			if (isset($_POST['Valider'])) {
				if ($password != $user['password']) {
					echo '$password:' . $password;
					echo ' $user[\'password\']:' . $user['password'];

					throw new Exception("Vous avez mal entré votre mot de passe actuel");
				}
				if (empty($email) || !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,})$/i", $email)) {
					echo '$email';
					throw new Exception("Le mail n'est pas valide");
				}
				if ($_POST['new_password'] && empty($new_password) || $new_password != $new_password_confirm) {
					echo '$new_password: ' . isset($_POST['new_password']);
					throw new Exception("Le mot de passe est vide ou la confirmation ne correspond pas");
				}

			}

		}
		return;
	}

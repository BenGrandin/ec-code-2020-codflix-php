<?php

	require_once('model/User.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function validationPage() {
		$emailVerified = isset($_SESSION['emailVerified']) ? $_SESSION['emailVerified'] : false;

		global $sentence;
		$db = init_db();

		$email = $_GET['email'];
		$keyEmail = $_GET['keyEmail'];

		if ($emailVerified) { // If account is already active
			$sentence = "Votre compte est déjà actif !";
		} else {

			if (!($_GET['email'] && $_GET['keyEmail'])) {

				// require homeController; homePage();
				$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

				if ($user_id):
					require('view/mediaListView.php');
				else:
					require('view/homeView.php');
				endif;
			} else {

				// Récupération de la clé correspondant au $email dans la base de données
				$data = new stdClass();
				$data->email = $email;

				$user = new User($data);
				$userData = $user->getUserByEmail();

				$keyEmailBdd = $userData['keyEmail'];
				$emailVerified = $userData['emailVerified'];

				// We compare our local key and our bdd key,
				// if their the same, we set emailVerified to 1
				if ($emailVerified) {
					$sentence = "Votre compte a déjà été activé !";

				} else if ($keyEmailBdd === $keyEmail) {
					// Setting emailVerified to 1
					$stmt = $db->prepare("UPDATE user SET emailVerified=1 WHERE email=:email");
					$stmt->execute([
						'email' => $email
					]);

					$sentence = "Votre compte vient d'être activé !";

				} else {    //  If not, we sent an error message
					$sentence = "Erreur ! Votre compte ne peut être activé...";
				}
			}
		}

		require('view/validationView.php');

	}

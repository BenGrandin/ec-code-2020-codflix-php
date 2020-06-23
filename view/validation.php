<?php ob_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . '/model/database.php');
	$db = init_db();
	global $active;

	$email = $_GET['email'];
	$keyEmail = $_GET['keyEmail'];

	// Récupération de la clé correspondant au $email dans la base de données
	$stmt = $db->prepare("SELECT keyEmail,actif FROM membres WHERE email like :email ");
	if ($stmt->execute(array(':email' => $email)) && $row = $stmt->fetch()) {
		$keyEmailbdd = $row['keyEmail'];    // Récupération de la clé
		$active = $row['active']; // $actif contiendra alors 0 ou 1
	}


	// On teste la valeur de la variable $actif récupérée dans la BDD
	if ($active) { // If account is already active
		echo "Votre compte est déjà actif !";

	} else {
		// Si ce n'est pas le cas on passe aux comparaisons
		if ($email === $keyEmail) {  // On compare nos deux clés, si elles correspondent on active le compte !
			echo "Votre compte a bien été activé !";

			// La requête qui va passer notre champ actif de 0 à 1
			$stmt = $db->prepare("UPDATE membres SET actif = 1 WHERE email like :email ");
			$stmt->bindParam(':email', $email);
			$stmt->execute();
		} else {    // Si les deux clés sont différentes on provoque une erreur...
			echo "Erreur ! Votre compte ne peut être activé...";
		}
	}

	$content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
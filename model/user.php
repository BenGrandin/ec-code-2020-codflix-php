<?php

	require_once('database.php');

	class User {

		protected $id;
		protected string $email;
		protected $password;
		protected string $keyEmail;

		public function __construct($user = null) {

			if ($user != null):
				$this->setId(isset($user->id) ? $user->id : null);
				$this->setEmail($user->email);

				if ($user->keyEmail) $this->setKeyEmail($user->keyEmail);
				$this->setPassword($user->password, isset($user->password_confirm) ? $user->password_confirm : false);
			endif;
		}

		/**************************************
		 * -------- GET USER DATA BY ID --------
		 ***************************************/

		public static function getUserById($id) {

			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM user WHERE id = ?");
			$req->execute(array($id));

			// Close databse connection
			$db = null;

			return $req->fetch();
		}

		/***************************
		 * -------- GETTERS ---------
		 ***************************/

		public function getId() {
			return $this->id;
		}

		/***************************
		 * -------- SETTERS ---------
		 ***************************/

		public function setId($id) {
			$this->id = $id;
		}

		/***********************************
		 * -------- CREATE NEW USER ---------
		 ************************************/

		public function createUser() {
			// Check if email already exist
			$email = $this->getEmail();

			$userByEmail = $this->getUserByEmail();
			if ($userByEmail) {
				throw new Exception("Email déjà utilisé");
			}

			$db = init_db();
			// Insert new user
			$req = $db->prepare("INSERT INTO user ( email, password ) VALUES ( :email, :password )");
			$req->execute(array(
				'email' => $email,
				'password' => $this->getPassword()
			));


			$this->sendConfirmationEmail($db, $email);
			// Close databse connection
			$db = null;

		}

		public function getEmail() {
			return $this->email;
		}

		public function setEmail($email) {

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
				throw new Exception('Email incorrect');
			endif;

			$this->email = $email;

		}

		/***************************************
		 * ------- GET USER DATA BY EMAIL -------
		 ***************************************
		 * @param string $email
		 * @return mixed
		 */

		public function getUserByEmail($email = null) {
			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM user WHERE email = ?");
			if (!$email) {
				$email = $this->getEmail();
			}
			$req->execute(array($email));

			// Close database connection
			$db = null;

			return $req->fetch();
		}

		public function getPassword() {
			return $this->password;
		}

		public function setPassword($password, $password_confirm = false) {

			if ($password_confirm && $password != $password_confirm):
				throw new Exception('Vos mots de passes sont différents');
			endif;

			$this->password = $password;
		}

		private function sendConfirmationEmail(PDO $db, $email) {
			// Create the confirm key
			$keyEmail = md5(microtime(TRUE) * 100000);

			// Update keyEmail of the user
			$stmt = $db->prepare("UPDATE user SET keyEmail=:keyEmail WHERE email=:email");
			$stmt->execute([
				'keyEmail' => $keyEmail,
				'email' => $email
			]);

			// Prepare email for link activation
			$to = $email;
			$subject = "Activer votre compte";
			$header = "From: inscription@votresite.com";

			// The link is compose with keyEmail
			$message = 'Bienvenue sur VotreSite,
			 
			Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
			ou copier/coller dans votre navigateur Internet.
			 
			http://localhost:8888/ec-code-2020-codflix-php/activation.php?email=' . urlencode($email) . '&keyEmail=' . urlencode($keyEmail) . '
			 
			 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';
			mail($to, $subject, $message, $header); // Envoi du mail
		}

		/**
		 * @return string
		 */
		public function getKeyEmail(): string {
			return $this->keyEmail;
		}

		/**
		 * @param string $keyEmail
		 */
		public function setKeyEmail(string $keyEmail): void {
			$this->keyEmail = $keyEmail;
		}

	}

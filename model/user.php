<?php

	require_once('database.php');

	class User {

		protected $id;
		protected string $email;
		protected $password;
		protected string $keyEmail;
		protected string $emailVerified;

		public function __construct($user = null) {

			if ($user != null):
				$this->setId(isset($user->id) ? $user->id : null);
				$this->setEmail($user->email);

				if ($user->keyEmail) $this->setKeyEmail($user->keyEmail);
				if ($user->emailVerified) $this->setEmailVerified($user->emailVerified);
				$this->setPassword($user->password, isset($user->password_confirm) ? $user->password_confirm : false);
			endif;
		}

		/**************************************
		 * -------- GET USER DATA BY ID --------
		 **************************************
		 * @param int $id
		 * @return User
		 */

		public static function getUserById(int $id): User {

			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM user WHERE id = ?");
			$req->execute(array($id));

			// Close database connection
			$db = null;

			return $req->fetch();
		}

		public function getId() {
			return $this->id;
		}

		public function setId($id) {
			$this->id = $id;
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

		public function getPassword() {
			return $this->password;
		}

		public function setPassword($password, $password_confirm = false) {

			if ($password_confirm && $password != $password_confirm):
				throw new Exception('Vos mots de passes sont différents');
			endif;

			$this->password = $password;
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
			// Close database connection
			$db = null;

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

		/**
		 * @return string
		 */
		public function getEmailVerified(): string {
			return $this->emailVerified;
		}

		/**
		 * @param string $emailVerified
		 */
		public function setEmailVerified(string $emailVerified): void {
			$this->emailVerified = $emailVerified;
		}

		/***************************************
		 * ------- GET USER DATA BY EMAIL -------
		 ***************************************
		 * @param PDO    $db
		 * @param string $email
		 * @return mixed
		 */
		private function sendConfirmationEmail(PDO $db, string $email) {
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

	}

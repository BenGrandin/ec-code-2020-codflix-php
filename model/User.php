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

		static public function updateUserPassword($id, $password) {
			$db = init_db();

			$req = $db->prepare("UPDATE user SET  password = :password WHERE id = :id;");
			$req->execute(array(
				'password' => hash('sha256', $password),
				'id' => $id
			));
			// Close database connection
			$db = null;
		}

		static public function updateUserEmail($id, $email) {
			$db = init_db();

			$req = $db->prepare("UPDATE user SET  email = :email WHERE id = :id;");
			$req->execute(array(
				'password' => hash('sha256', $email),
				'id' => $id
			));

			// Close database connection
			$db = null;
		}

		public static function deleteHistories() {
			$user_id = $_SESSION['user_id'];
			// Open database connection
			$db = init_db();

			$req = $db->prepare("DELETE FROM favorites WHERE user_id = $user_id");
			$req->execute();

			// Close databse connection
			$db = null;
		}

		static function deleteHistoryById($history_id) {

			$user_id = $_SESSION['user_id'];
			// Open database connection
			$db = init_db();


			$req = $db->prepare("SELECT * FROM favorites WHERE user_id = $user_id AND media_id = $history_id");
			$req->execute();

			// Close database connection
			$db = null;

			return $req->fetch();
		}

		/**************************************
		 * -------- GET USER DATA BY ID --------
		 **************************************
		 * @param int $id
		 * @return mixed
		 */

		public static function getUserById($id) {

			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM user WHERE id = ?");
			$req->execute(array($id));

			// Close database connection
			$db = null;

			return $req->fetch();
		}

		static public function deleteUser($id) {
			$db = init_db();

			$req = $db->prepare("DELETE FROM user WHERE id = ?");
			$req->execute(array($id));

			// Close databse connection
			$db = null;
			session_destroy();

			header('location: index.php');
		}

		public static function getHistoryMedias($title, $gender_id, $type, $release_date, $user_id) {

			// Open database connection
			$db = init_db();

			$req = 'SELECT * FROM history INNER JOIN media ON history.media_id = media.id';
			$req .= ' WHERE user_id =' . $user_id
				. ' && title LIKE "%' . $title . '%"'
				. ' && gender_id LIKE "%' . $gender_id . '%"'
				. ' && type LIKE "%' . $type . '%"';

			if ($release_date) {
				$req .= ' && release_date >= "' . $release_date . '-00-00"'
					. ' && release_date <= "' . $release_date . '-12-30"';
			}
			$req .= " ORDER BY start_date DESC";

			$req = $db->prepare($req);
			$req->execute();

			return $req->fetchAll();
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

		public
		function getUserByEmail($email = null) {
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
		public
		function getKeyEmail(): string {
			return $this->keyEmail;
		}

		/**
		 * @param string $keyEmail
		 */
		public
		function setKeyEmail(string $keyEmail): void {
			$this->keyEmail = $keyEmail;
		}

		/**
		 * @return string
		 */
		public
		function getEmailVerified(): string {
			return $this->emailVerified;
		}

		/**
		 * @param string $emailVerified
		 */
		public
		function setEmailVerified(string $emailVerified): void {
			$this->emailVerified = $emailVerified;
		}

		/***************************************
		 * ------- GET USER DATA BY EMAIL -------
		 ***************************************
		 * @param PDO    $db
		 * @param string $email
		 * @return mixed
		 */
		private
		function sendConfirmationEmail(PDO $db, string $email) {
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

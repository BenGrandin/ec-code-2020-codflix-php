<?php

	require_once('database.php');

	class Media {

		protected int $id;
		protected $genre_id;
		protected $title;
		protected $type;
		protected $status;
		protected $release_date;
		protected string $summary;
		protected $trailer_url;
		protected $duration;

		/*
			Todo : Correct construct in order to not always use static method
		*/
		public function __construct($media) {
			$this->setId(isset($media->id) ? $media->id : null);
			$this->setGenreId(isset($media->genre_id) ? $media->genre_id : null);
			$this->setTitle(isset($media->id) ? $media->id : null);
			$this->setType(isset($media->type) ? $media->type : null);
			$this->setStatus(isset($media->status) ? $media->status : null);
			$this->setReleaseDate(isset($media->release_date) ? $media->release_date : null);
			$this->setSummary(isset($media->summary) ? $media->summary : null);
			$this->setTrailerUrl(isset($media->trailer_url) ? $media->trailer_url : null);
		}

		/**************************************
		 * -------- GET MEDIA DATA BY ID --------
		 **************************************
		 * @param int $id
		 * @return mixed //Media
		 */

		public static function getMediaById(int $id) {

			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM media WHERE id = ?");
			$req->execute(array($id));

			// Close database connection
			$db = null;


			return $req->fetch(); // new Media($req->fetch()); Not working
		}

		/**************************************
		 * -------- GET ALL DATA MEDIAS --------
		 **************************************/
		static public function getDbMedias() {
			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM media");
			$req->execute();

			// Close database connection
			$db = null;

			return $req->fetchAll();
		}

		/***************************
		 * -------- GET LIST --------
		 **************************
		 * @param string $title
		 * @param string $gender_id
		 * @param string $type
		 * @return array
		 */

		public static function getFilterMedias($title = "", $gender_id = "", $type = "", $release_date = "") {

			// Open database connection
			$db = init_db();
			$req = 'SELECT * FROM media WHERE title LIKE "%' . $title . '%"'
				. '&& gender_id LIKE "%' . $gender_id . '%"'
				. '&& type LIKE "%' . $type . '%"';

			if ($release_date) {
				$req .= '&& release_date >= "' . $release_date . '-00-00"'
					. '&& release_date <= "' . $release_date . '-12-30"';
			}

			$req .= "ORDER BY release_date DESC";

			$req = $db->prepare($req);
			$req->execute();

			// Close database connection
			$db = null;

			return $req->fetchAll();

		}

		/**********************************************
		 * ----- GET DATA EPISODES FILTER BY SHOW -----
		 **********************************************
		 * @param int $id
		 * @return array
		 */

		static public function getDbEpisodesByShow($id) {
			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM episodes WHERE show_id = ?");
			$req->execute(array($id));

			// Close database connection
			$db = null;

			return $req->fetchAll();
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

		public function getGenreId() {
			return $this->genre_id;
		}

		public function setGenreId($genre_id) {
			$this->genre_id = $genre_id;
		}

		public function getTitle() {
			return $this->title;
		}

		public function setTitle($title) {
			$this->title = $title;
		}

		public function getType() {
			return $this->type;
		}

		public function setType($type) {
			$this->type = $type;
		}

		public function getStatus() {
			return $this->status;
		}

		public function setStatus($status) {
			$this->status = $status;
		}

		public function getReleaseDate() {
			return $this->release_date;
		}

		public function setReleaseDate($release_date) {
			$this->release_date = $release_date;
		}

		public function getSummary() {
			return $this->summary;
		}

		public function setSummary(string $summary): void {
			$this->summary = $summary;
		}

		public function getTrailerUrl() {
			return $this->trailer_url;
		}

		public function setTrailerUrl($trailer_url): void {
			$this->trailer_url = $trailer_url;
		}


	}

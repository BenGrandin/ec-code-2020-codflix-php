<?php

	require_once('database.php');

	class Episode {

		protected int $id;
		protected $show_id;
		protected $title;
		protected $type;
		protected $season_number;
		protected $episode_number;
		protected $release_date;
		protected $still_path;
		protected string $summary;
		protected $trailer_url;

		public function __construct($media) {

		}

		/**************************************
		 * -------- GET EPISODE DATA BY ID --------
		 **************************************
		 * @param int $id
		 * @return mixed
		 */

		public static function getDbEpisodeById(int $id) {

			// Open database connection
			$db = init_db();
			$req = $db->prepare("SELECT * FROM episodes WHERE id = $id");
			$req->execute(array($id));

			// Close database connection
			$db = null;


			return $req->fetch(); // new Media($req->fetch()); Not working
		}

		/**************************************
		 * -------- GET ALL DATA EPISODES --------
		 **************************************/
		static public function getDbEpisodes() {
			// Open database connection
			$db = init_db();

			$req = $db->prepare("SELECT * FROM episodes");
			$req->execute();

			// Close database connection
			$db = null;

			return $req->fetchAll();
		}

		public function getId() {
			return $this->id;
		}

		public function setId($id) {
			$this->id = $id;
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

		public function getSeasonNumber() {
			return $this->season_number;
		}

		public function setSeasonNumber($season_number): void {
			$this->season_number = $season_number;
		}


	}

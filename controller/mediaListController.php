<?php

	require_once('model/Media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaListPage() {
		$version = isset($_GET['version']) ? $_GET['version'] : null;
		$action = isset($_GET['action']) ? $_GET['action'] : null;

		ob_start();
		require('view/mediaListView.php');
		mediaListDisplayer();
		$content .= ob_get_clean();
		require('view/dashboard.php');
	}

	/***************************
	 * ----- RETURN mediaListDisplayer COMPONENT -----
	 ***************************/
	function mediaListDisplayer() {
		$title = isset($_GET['title']) ? $_GET['title'] : null;
		$gender_id = isset($_GET['gender_id']) ? $_GET['gender_id'] : null;
		$type = isset($_GET['type']) ? $_GET['type'] : null;
		$release_date = isset($_GET['release_date']) ? $_GET['release_date'] : null;
		$version = isset($_GET['version']) ? $_GET['version'] : null;
		$action = isset($_GET['action']) ? $_GET['action'] : null;


		if ($action === 'history') {
			$user_id = $_SESSION['user_id'];

			$medias = User::getHistoryMedias($title, $gender_id, $type, $release_date,$user_id);
		} else {
			$medias = Media::getFilterMedias($title, $gender_id, $type, $release_date);
		}

		require('view/components/mediaListDisplayer.php');

	}

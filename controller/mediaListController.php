<?php

	require_once('model/Media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaListPage() {
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

		$medias = Media::filterMedias($title, $gender_id,$type,$release_date);

		require('view/components/mediaListDisplayer.php');

	}

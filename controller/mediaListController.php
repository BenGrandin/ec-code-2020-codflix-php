<?php

	require_once('model/Media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaListPage() {
		// mediaList(); not working
		$title = isset($_GET['title']) ? $_GET['title'] : null;
		$gender_id = isset($_GET['gender_id']) ? $_GET['gender_id'] : null;

		$medias = Media::filterMedias($title, $gender_id);

		require('view/mediaListView.php');
		require('view/dashboard.php');

	}

	function mediaListDisplayer() {
		$search = isset($_GET['title']) ? $_GET['title'] : null;
		$medias = Media::filterMedias($search);
		$search = isset($_GET['title']) ? $_GET['title'] : null;

		require('view/components/mediaListDisplayer.php');

	}

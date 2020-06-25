<?php

	require_once('model/Media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaListPage() {
		// mediaList(); not working
		$search = isset($_GET['title']) ? $_GET['title'] : null;
		$medias = Media::filterMedias($search);

		$search = isset($_GET['title']) ? $_GET['title'] : null;

		require('view/mediaListView.php');
		require('view/dashboard.php');

	}

	function mediaListDisplayer() {
		$search = isset($_GET['title']) ? $_GET['title'] : null;
		$medias = Media::filterMedias($search);
		$search = isset($_GET['title']) ? $_GET['title'] : null;

		require('view/components/mediaListDisplayer.php');

	}

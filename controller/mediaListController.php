<?php

	require_once('model/Media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaListPage() {

		$search = isset($_GET['title']) ? $_GET['title'] : null;
		$medias = Media::filterMedias($search);

		require('view/mediaListView.php');

	}

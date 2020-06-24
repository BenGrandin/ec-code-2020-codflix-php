<?php

	require_once('model/media.php');

	/***************************
	 * ----- LOAD HOME PAGE -----
	 ***************************/

	function mediaPage() {

		$search = isset($_GET['title']) ? $_GET['title'] : null;
		//  $medias = Media::filterMedias( $search );
		$medias = Media::getDbMedias();

		require('view/mediaListView.php');

	}

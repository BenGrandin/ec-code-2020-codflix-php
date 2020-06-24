<?php

	require_once('model/media.php');

	/***************************
	 * ----- LOAD MEDIA PAGE -----
	 ***************************/

	function mediaPage() {

		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$media = Media::getMediaById($id);

		// Temporary Translation system.
		if ($media['type'] === "movie") $media['type'] = "Film";
		if ($media['type'] === "tvshow") $media['type'] = "Série";

		$media['status'] = strtolower($media['status']) === strtolower("Released") ? "Est sorti" : "Va sortir";


		require('view/mediaView.php');
	}

<?php
	require_once('model/User.php');

	if (isset($_POST['send'])) {
		sendEmail($_POST['send']);
		echo $_POST['send'];
	}

	function contact() {
		require('view/contactView.php');
	}

	function sendEmail($post) {

		$to = 'bengrandin88@gmail.com';
		$message = $post['message'];
		$headers = 'From: ' . $post['email'] . " - " . $post['name'];

		mail($to, $message, $headers);
	}


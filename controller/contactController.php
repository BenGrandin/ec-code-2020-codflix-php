<?php
	require_once('model/user.php');

	if (isset($_POST['send'])) {
		sendEmail($_POST['send']);
		echo $_POST['send'];
	}

	function contact() {
		require('view/auth/contactView.php');

	}

	function sendEmail($post) {

		$to = 'bengrandin88@gmail.com';
		$message = $post['message'];
		$headers = 'From: ' . $post['email'] . " - " . $post['name'];

		mail($to, $message, $headers);
	}

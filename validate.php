<?php
require_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$userName = (isset($_POST['userName'])) ? $_POST['userName'] : '';
	$pwd = (isset($_POST['pwd'])) ? $_POST['pwd'] : '';

	if (validateUser($userName,$pwd) == true) {
		header("Location: dashboard");
	} else {
		removeVisitor();
	}
}
?>

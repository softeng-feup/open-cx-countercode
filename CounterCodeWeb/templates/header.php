<?php
	//session_set_cookie_params(0, '/', '', false, true);
	session_start();

	echo $_SESSION['email'];
	echo $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="pt-PT">

	<head>
		<title>ESOF</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/style.css" rel="stylesheet">

		<link rel="icon" href="favicon.ico">
		<link rel="shortcut icon" href="favicon.ico">
	</head>

	<body>
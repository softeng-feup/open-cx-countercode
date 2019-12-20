<?php
	session_start();
	include_once('../database/talk_q.php');

	$email = $_POST['email'];
	$password = $_POST['password'];

	$userData = try_authentification($email, $password);

	if($userData !== NULL) {
		session_regenerate_id(true);
		
		$_SESSION['email'] = $userData['email'];
		$_SESSION['name'] = $userData['name'];
		$success = true;

	}
	else {
		$success = false;
	}
	
	if($success == true) {
		$is_admin = try_check_user_admin($email);
		print_r($is_admin);

		if($is_admin !== NULL) {

			if($is_admin['is_admin'] == 1) {
				$_SESSION['admin'] = 1;
				header('Location: ../admin_page.php');
			}
			else {
				$_SESSION['admin'] = 0;
				header('Location: ../speaker_page.php');
			}
		}
		else {
			header('Location: ../index.php');
		}
	}
	else {
		//header('Location: ../index.php');
	}

	
?>
<?php
	session_start();
	include_once('../database/talk_q.php');

	$email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    

    $msg = try_insert_speaker($email, $name, $password);

    if($msg === 'OK') {
        $success = true;
    }
    else {
        $success = false;
    }
	
	if($success == true) {
        header('Location: ../index.php');
    } 
    else {
        header('Location: ../admin_page.php');
    }

	
?>
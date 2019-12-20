<?php
	session_start();
	include_once('../database/talk_q.php');

	$title = $_POST['title'];
    $room = $_POST['room'];
    $date_start = strtotime($_POST['date_start']);
    $date_end = strtotime($_POST['date_end']);
    
    if($_SESSION['admin'] == true) {
        header('Location: index.php');
    }

    $msg = try_insert_talk($_SESSION['email'], $room, $title, $date_start, $date_end);

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
        header('Location: ../speaker_page.php');
    }

	
?>
<?php
	session_start();
	include_once('../database/talk_q.php');

	$id = $_POST['talkID'];
	$rating = $_POST['rating'];
    

    $msg = try_insert_rating($id, $rating);

    echo $msg;

    if($msg === 'OK') {
        $success = true;
    }
    else {
        $success = false;
    }
	
    header('Location: ../index.php');
	
?>
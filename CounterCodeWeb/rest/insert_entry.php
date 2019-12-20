<?php

	function response($response_code, $response_desc) {

		echo json_encode( array(
			'response_code' => $response_code,
			'response_desc' => $response_desc
		));
	}

    header('Content-Type: application/json');
    
    if (isset($_POST['talkID']) && !empty($_POST['talkID']) &&
        isset($_POST['timestamp']) && !empty($_POST['timestamp']) &&
        isset($_POST['is_entry']) && !empty($_POST['is_entry']))
    {

		include('../database/connection.php');
		
		$talkID = $_POST['talkID'];
		$timestamp = $_POST['timestamp'];
		$is_entry = $_POST['is_entry'];
		
		global $db;
		try {
			$stmt = $db->prepare('INSERT INTO TalkAttendance values(?, ?, ?)');
			$stmt->execute(array($talkID, $timestamp, $is_entry));
            response(200, 'OK');
		} catch (Exception $e) {
			response(400,"Invalid Request");
		}
	}
	
?>
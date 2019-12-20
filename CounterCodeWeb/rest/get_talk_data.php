<?php

	function response($talkID, $roomID, $response_code, $response_desc) {

		echo json_encode( array(
			'talkID' 	=> $talkID,
			'roomID' 	=> $roomID,
			'response_code' => $response_code,
			'response_desc' => $response_desc
		));
	}

	header('Content-Type: application/json');
	if (isset($_GET['id']) && $_GET['id'] != "") {
		include('../database/connection.php');
		
		$id = $_GET['id'];
		
		global $db;
		try {
			$stmt = $db->prepare('SELECT * FROM Talk WHERE talkID = ?');
			$stmt->execute(array($id));
			$talk_data = $stmt->fetch();
			if ($talk_data !== false) {
				$talkID = $talk_data['talkID'];
				$roomID = $talk_data['roomID'];
				response($talkID, $roomID, 200, 'OK');
			}
			else {
				response(NULL, NULL, 200,"No Record Found");
			}
		} catch (Exception $e) {
			response(NULL, NULL, 400,"Invalid Request");
		}
	}
	
?>
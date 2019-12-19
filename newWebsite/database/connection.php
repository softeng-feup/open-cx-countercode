<?php
	$db = new PDO('sqlite:../database/cAlfred.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	

	function try_get_talk_data_by_id($id) {

		if($id === NULL)
			return NULL;
	
		global $db;
		$stmt = $db->prepare('SELECT * FROM TalkAttendance WHERE talkID = ?');
		$stmt->execute(array($id));
		$talk_data = $stmt->fetchAll();
		if ($talk_data !== false)
			return $talk_data;
		else
			return NULL;
	}
?>
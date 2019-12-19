<?php

	$cwd = getcwd();
	if(strpos($cwd, 'actions') !== false) {
	$db = new PDO('sqlite:../database/cAlfred.db');
	} else {
	$db = new PDO('sqlite:database/cAlfred.db');
	}

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
	
	function try_get_all_talks() {

		global $db;
		$stmt = $db->prepare('SELECT talkID FROM Talk');
		$stmt->execute();
		$talks = $stmt->fetchAll();
		if ($talks !== false)
			return $talks;
		else
			return NULL;
	}
	
	function try_get_talk_info_by_id($id) {

		if($id === NULL)
			return NULL;
	
		global $db;
		$stmt = $db->prepare('SELECT name,title,roomID,date_start FROM Talk NATURAL JOIN User WHERE talkID = ?');
		$stmt->execute(array($id));
		$talk_info = $stmt->fetch();
		if ($talk_info !== false)
			return $talk_info;
		else
			return NULL;
	}
?>
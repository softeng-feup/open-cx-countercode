<?php

include_once('../database/connection.php');

$success = false;
$talk_data = try_get_talk_data_by_id($_POST['talk_id']);


if($talk_data !== NULL) {
	$success = true;
}

echo json_encode( array(
	'success' 	=> $success,
	'talk_data' 	=> $talk_data
));

?>
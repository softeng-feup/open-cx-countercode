<?php

include_once('../database/talk_q.php');

$success = false;

$talk_attendance = try_get_talk_attendance_data_by_id($_POST['talk_id']);
$talk_info = try_get_talk_info_by_id($_POST['talk_id']);

$talk_end = $talk_info['date_end'];

$talk_avg_rat = NULL;
$talk_ratings = NULL;
if($talk_end - 600 >= time()) {
	$talk_avg_rat = try_get_talk_avg_rating_by_id($_POST['talk_id']);
	$talk_ratings = try_get_talk_rating_distribution_by_id($_POST['talk_id']);
}


if($talk_info !== NULL && $talk_attendance !== NULL) {
	$success = true;
}

echo json_encode( array(
	'success' 	=> $success,
	'talk_attendance' => $talk_attendance,
	'talk_info' => $talk_info,
	'talk_avg_rat' => $talk_avg_rat,
	'talk_ratings' => $talk_ratings
));

?>
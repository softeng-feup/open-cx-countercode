<?php

include_once('../database/talk_q.php');

$success = false;

$talk_attendance = try_get_talk_attendance_data_by_id($_POST['talk_id']);
$talk_info = try_get_talk_info_by_id($_POST['talk_id']);

$talk_end = $talk_info['date_end'];

$talk_avg_rat = try_get_talk_avg_rating_by_id($_POST['talk_id']);

$talk_rating1 = try_get_talk_single_rating_by_id($_POST['talk_id'], 1);
$talk_rating2 = try_get_talk_single_rating_by_id($_POST['talk_id'], 2);
$talk_rating3 = try_get_talk_single_rating_by_id($_POST['talk_id'], 3);
$talk_rating4 = try_get_talk_single_rating_by_id($_POST['talk_id'], 4);
$talk_rating5 = try_get_talk_single_rating_by_id($_POST['talk_id'], 5);

$talk_ratings = array($talk_rating1, $talk_rating2, $talk_rating3, $talk_rating4, $talk_rating5);

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
<?php

include_once('connection.php');


function try_get_talk_attendance_data_by_id($id) {

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
    $stmt = $db->prepare('SELECT talkID FROM Talk ORDER BY date_start');
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
    $stmt = $db->prepare('SELECT name,title,roomID,date_start,date_end FROM Talk NATURAL JOIN User WHERE talkID = ?');
    $stmt->execute(array($id));
    $talk_info = $stmt->fetch();
    if ($talk_info !== false)
        return $talk_info;
    else
        return NULL;
}

function try_get_talk_avg_rating_by_id($id) {
    if($id === NULL)
        return NULL;
    global $db;
    $stmt = $db->prepare('SELECT AVG(rating) as avg_rat FROM TalkRating WHERE talkID = ?');
    $stmt->execute(array($id));
    $talk_rat = $stmt->fetch();
    if ($talk_rat !== false)
        return $talk_rat['avg_rat'];
    else
        return NULL;
}

function try_get_talk_single_rating_by_id($id, $rat) {

    if($id === NULL)
        return NULL;

    global $db;
    $stmt = $db->prepare('SELECT COUNT(rating) as count_rat FROM TalkRating WHERE talkID = ? AND rating = ?');
    $stmt->execute(array($id, $rat));
    $talk_info = $stmt->fetchAll();
    if ($talk_info !== false)
        return $talk_info;
    else
        return NULL;
}

function try_get_all_speakers() {

    global $db;
    $stmt = $db->prepare('SELECT email FROM User WHERE is_admin = 0');
    $stmt->execute();
    $users = $stmt->fetchAll();
    if ($users !== false)
        return $users;
    else
        return NULL;
}

function try_check_user_admin($email) {

    global $db;
    $stmt = $db->prepare('SELECT is_admin FROM User WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch();
    if ($user !== false) {
        return $user;
    }
    else
        return NULL;
}

function try_authentification($email, $pwd) {

    if($email === NULL || $pwd === NULL)
        return NULL;

    global $db;
    $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
    $stmt->execute(array($email));
    $userData = $stmt->fetch();
    if ($userData !== false && password_verify($pwd, $userData['hash']))
        return $userData;
    else
        return NULL;
}

function try_insert_speaker($email, $name, $pwd) {

    if($email === NULL || $name === NULL || $pwd === NULL)
        return NULL;

    global $db;
    $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO User VALUES (?, ?, ?, ?)');
    try {
        $stmt->execute(array(
            $email,
            $name,
            password_hash($pwd, PASSWORD_DEFAULT, $options),
            0
        ));
        return 'OK';
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            return "Duplicate Email";
        } else {
            throw $e;
        }
    }
}

function try_insert_rating($talkID, $rating) {

    if($talkID === NULL || $rating === NULL)
        return NULL;

    global $db;
    $stmt = $db->prepare('INSERT INTO TalkRating VALUES (?, ?)');
    try {
        $stmt->execute(array(
            $talkID,
            $rating
        ));
        return 'OK';
    } catch (PDOException $e) {
        return "FAIL";
    }
}

function try_insert_talk($email, $roomID, $title, $date_start, $date_end) {

    if($email === NULL || $roomID === NULL || $title === NULL || $date_start === NULL || $date_end === NULL)
        return NULL;

    global $db;
    $stmt = $db->prepare('INSERT INTO Talk VALUES (NULL, ?, ?, ?, ?, ?)');
    try {
        $stmt->execute(array(
            $email,
            $roomID,
            $title,
            $date_start,
            $date_end,
        ));
        return 'OK';
    } catch (PDOException $e) {
        return "FAIL";
    }
}

?>
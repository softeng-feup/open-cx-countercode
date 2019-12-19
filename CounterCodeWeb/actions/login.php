<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $is_admin = try_check_user_admin($email);
    
    if(!$is_login) {
        $msg = try_login_speaker($email);
        if($msg === 'OK') {
            header('Location: ../speaker_page.php')
        }
    }
    else {
        $msg = try_login_speaker($email);
        if($msg === 'OK') {
            header('Location: ../admin_page.php')
        }
    }
?>
<?php
    require "db.php";

    $data = $_GET;
    $user = R::findOne('users', 'token = ?', array($data['token']));
    if (isset($user)){
        $update = R::load('users', $user['id']);
        $update->token = NULL;
        $update->security = 1;
        R::store($update);
        header("Location: /SentEmail.php?key=VerificationUser");
    } else {
        header("Location: /SentEmail.php?key=AlreadyVerified");
    }
?>
<?php
    function ChangeNameUser($DataName){
        $user = R::load('users', $_SESSION['logged_user']->id);
        $_SESSION['logged_user']->name = $DataName;
        $user->name = $DataName;
        R::store($user);
        header("Location: /Profile.php");
    }

    function ChangeAvatarUser(){
        $user = R::load('users', $_SESSION['logged_user']->id);
        $_SESSION['logged_user']->avatar = $user->avatar;
        header("Location: /Profile.php");
    }

    function ChangePasswordUser($password, $id){
        $user = R::load('users', $id);
        $user->password = password_hash($password['password'], PASSWORD_DEFAULT);
        $user->token = "";
        R::store($user);
        header("Location:/SentEmail.php?key=CompliteChangePassword");
    }
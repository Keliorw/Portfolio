<?php
    require "libs/rb-mysql.php";
    R::setup( 'mysql:host=localhost;dbname=beerpong',
        'Admin', 'Fislin228' ); //for both mysql or mariaDB
    $css = "2";
    $js = "2";

    $securityKey = "afghjkasdbkcfhjasdjkvasdvblasdfvkhjasdkm";

    session_start();

    if (isset($_COOKIE['login']) && empty($_SESSION['logged_user']))
    {
        $user = R::findOne('users', 'login = ?', array($_COOKIE['login']));
        $_SESSION['logged_user'] = $user;
    }

    function WriteName(){
        if($_SESSION['logged_user']->name == ""){
            return $_SESSION['logged_user']->login;
        } else {
            return $_SESSION['logged_user']->name;
        }
    }

    function WriteNameAnyProfile(){
        $user = R::load('users', $_GET['id']);
        if($user->name == ""){
            return $user->login;
        } else {
            return $user->name;
        }
    }
   
?>
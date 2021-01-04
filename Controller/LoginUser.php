<?php 
    require_once "db.php";

    class LoginUser{
        public $LoginOrEmail;
        public $password;
    }

    function LoginUser($user){
        $_SESSION['logged_user'] = $user;
        setcookie("login", $user->login, time()+2592000);
        header('location: /');
    }
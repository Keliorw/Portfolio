<?php
    require_once 'db.php';
    
    class User
    {
        public $login;
        public $name = ""; 
        public $email;
        public $token;
        public $password;
        public $AgainPassword;
        public $avatar = "eb8cb9ce586799eba1ab5ed974b98b7b.png";
        public $gameplay = 0;
        public $win = 0;
        public $defeat = 0;
        public $draws = 0;
        public $pirsentwin = 0.0;
        public $roomactive = "";
        public $tourney = "";
        public $security = 0;
    }
    function RegisterUser(User $NewUser){
        $user = R::dispense("users");
        setcookie("login", $UserLogin, time()+2592000);
        $user->login = $NewUser->login;
        $user->name = $NewUser->name;
        $user->email = $NewUser->email;
        $user->token = $NewUser->token;
        $user->password = password_hash($NewUser->password, PASSWORD_DEFAULT);
        $user->avatar = $NewUser->avatar;
        $user->gameplay = $NewUser->gameplay;
        $user->win = $NewUser->win;
        $user->defeat = $NewUser->defeat;
        $user->draws = $NewUser->draws;
        $user->pirsentwin = $NewUser->pirsentwin;
        $user->roomactive = $NewUser->roomactive;
        $user->tourney = $NewUser->tourney;
        $user->security = $NewUser->security;
        $_SESSION['logged_user'] = $user;
        setcookie("login", $NewUser->login, time()+2678400);
        R::store($user);
        header("Location: /SentEmail.php?key=RegisterUser");
    }
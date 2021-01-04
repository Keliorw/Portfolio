<?php
    require_once "db.php";
    
    setcookie("login", "", time()-2592000);
    unset($_SESSION['logged_user']);
    header('location: /');
?>
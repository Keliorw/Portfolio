<?php
    require_once "../db.php";

    //Проверка полученных данных и вызов нужной функции для проверки
    switch ($_POST['action']) {
        case 'CheckLogin':
            echo CheckLogin();
            break;
        case 'CheckEmail':
            echo CheckEmail();
            break;
        default:
            break;
    }


    //Проверка логина на валидность
    function CheckLogin(){
        $errors = array();

        if( R::count('users', "login = ?", array($_POST['DataUserReg'])) > 0 )
            $errors[] = "error login 1";

        if ( empty($_POST['DataUserReg']) )
            $errors[] = "error login 2";

        if ( !preg_match("/^[a-z A-Z]+$/i" , $_POST['DataUserReg']) )
            $errors[] = "error login 3";

        if (empty($errors))
            return "login 1";
        else
            return array_shift($errors);
    }

    //Проверка почты на валидность
    function CheckEmail(){
        $errors = array();

        if( R::count('users', "email = ?", array($_POST['DataUserReg'])) > 0 ){
            $errors[] = "error email 1";
        }

        if ( empty($_POST['DataUserReg']) ){
            $errors[] = "error email 2";
        }

        if ( !filter_var($_POST['DataUserReg'], FILTER_VALIDATE_EMAIL)){
            $errors[] = "error email 3";
        }

        if (empty($errors))
            return "email 1";
        else
            return array_shift($errors);
    }
?>
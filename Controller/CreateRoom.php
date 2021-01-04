<?php
    require_once "db.php";

    function CreateRoom($name, $password){
        $time = date_default_timezone_set("UTC")+time()+(3600*3);
        // Добавление в таблицу новой комнаты
        $room = R::dispense("listroom");
        $room->name = $name;
        $room->roomid = substr(md5(microtime() . rand(0, 9999)), 0, 10);
        //Создание таблицы со списком игроков
        $NewRoom = R::dispense($room->roomid);
        $NewRoom->loginplayer = $_SESSION['logged_user']->login;
        $NewRoom->nameplayer = WriteName();
        $NewRoom->gameplay = 0;
        $NewRoom->win = 0;
        $NewRoom->defeat = 0;
        $NewRoom->draws = 0;
        R::store($NewRoom);
        $room->roomgame = $room->roomid."game";
        //Создание таблицы со списком игр в комнате
        $GameRoom = R::dispense($room->roomid."game");
        R::store($GameRoom);
        $tmp = R::load($room->roomid."game", 1);
        R::trash($tmp);
        $room->password = password_hash($password, PASSWORD_DEFAULT);
        $room->amountplayer = 1;
        $room->timecreate = date("d.m.y", $time);
        R::store($room);
        //Изменения активной комнаты у игрока в таблице и сессии
        $user = R::load('users', $_SESSION['logged_user']->id);
        $user->roomactive = $name;
        $_SESSION['logged_user']->roomactive = $name;
        R::store($user);
        header("Location: /room.php");
    }
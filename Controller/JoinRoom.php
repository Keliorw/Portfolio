<?php
    function JoinRoom($id){
        $addPlayer = R::dispense($_GET['roomid']);
        $addPlayer->loginplayer = $_SESSION['logged_user']->login;
        $addPlayer->nameplayer = WriteName();
        $addPlayer->gameplay = 0;
        $addPlayer->win = 0;
        $addPlayer->defeat = 0;
        $addPlayer->draws = 0;
        R::store($addPlayer);
        $room = R::load('listroom', $id);
        $room->amountplayer += 1;
        $user = R::load('users', $_SESSION['logged_user']->id);
        $user->roomactive = $room->name;
        $_SESSION['logged_user']->roomactive = $room->name;
        R::store($user);
        R::store($room);
        header("Location: /");
    }
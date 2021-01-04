<?php
    require "../db.php";

    if(empty($_POST['player'])){
        $user = R::load('users', $_SESSION['logged_user']->id);
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));
        $Fight = R::load($room[0]['roomgame'], $_POST['id']);
        $Fight->sygrano = 2;
        R::store($Fight);
        echo "success";
    }

    if(isset($_POST['player'])){
        $user = R::load('users', $_SESSION['logged_user']->id);
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));
        $roomid = $room[0]['roomid'];
        $Fight = R::load($room[0]['roomgame'], $_POST['id']);
        $player1 = $Fight->oneplayer;
        $player2 = $Fight->twoplayer;
        $tmpUser1 = R::getAll("SELECT * FROM $roomid WHERE loginplayer = ?", array($player1));
        $user1 = R::load($roomid, $tmpUser1[0]['id']);
        $tmpUser2 = R::getAll("SELECT * FROM $roomid WHERE loginplayer = ?", array($player2));
        $user2 = R::load($roomid, $tmpUser2[0]['id']);
        if ($_POST['player'] == 1){
            $Fight->identificatorone = 1;
            $user1->win +=1;
            $user1->gameplay += 1;
            $user2->defeat +=1;
            $user2->gameplay += 1;
        }
        if($_POST['player'] == 2){
            $Fight->identificatortwo = 1;
            $user1->defeat +=1;
            $user1->gameplay += 1;
            $user2->win +=1;
            $user2->gameplay += 1;
        }
        if($_POST['player'] == 3){
            $Fight->identificatorone = 1;
            $Fight->identificatortwo = 1;
            $user1->draws +=1;
            $user1->gameplay += 1;
            $user2->draws +=1;
            $user2->gameplay += 1;
        }
        $Fight->sygrano = 1;
        R::store($Fight);
        R::store($user1);
        R::store($user2);
        echo "success";
    }
    
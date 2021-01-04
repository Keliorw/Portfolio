<?php
    require "../db.php";

    $user = R::load("users", $_POST['Second']);
    $roomID = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));
    $tmp = $roomID[0]['roomgame'];
    $player = R::getAll("SELECT * FROM $tmp WHERE oneplayer = ? OR twoplayer = ?", array($user->login, $user->login));
    for ($i=0; $i < count($player); $i++) { 
        if ($player[$i]["sygrano"] == 0 || $player[$i]["sygrano"] == 2){
            $DidNotPlay[] = $player[$i];
        }
    }
    if(empty($DidNotPlay[0])){
        $fight = R::dispense($roomID[0]['roomgame']);
        $fight->oneplayer = $user->login;
        $fight->identificatorone = 0;
        $user = R::load("users", $_POST['First']);
        $fight->twoplayer = $user->login;
        $fight->identificatortwo = 0;
        $fight->sygrano = 0;
        R::store($fight);
        echo "success";
    } else {
        echo "Вы уже с кем-то играете";
    }
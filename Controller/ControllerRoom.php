<?php
    include_once "RatingCouter.php";
    
    function ListRoom(){
        $room = R::getAll("SELECT * FROM listroom");
        $List = array();
        foreach ($room as $key => $value) {
            $List[] = "
                <div class='Room'>
                    <div class='BlockDescription'>
                        <div class='NameRoom'>
                            <p>
                                ". $value['name'] ."
                            </p>
                        </div>
                        <div class='AmountPlayer'>
                            <img src='img/IconHistoryPlayers.png' alt='Игроков'>
                            <p>
                                ". $value['amountplayer'] ." - игрок(ов)
                            </p>
                        </div>
                    </div>
                    <div class='BlockButtonJoin'>
                        <button class='joinInRoom' onclick='JoinRoom(".'"'.$value["roomid"].'"'.")'>
                            Присоедениться
                        </button>
                    </div>
                </div>
            ";
        }
        for ($i = count($List)-1; $i >= 0; $i--) { 
            echo $List[$i];
        }
    }

    function CheckRoom(){
        $room = R::getAll("SELECT * FROM listroom");
        if(isset($room[0]))
            return true;
        else
            return false;
    }

    function CheckJoinRoom(){
        $user = R::load('users', $_SESSION["logged_user"]->id);
        if($user->roomactive != "")
            return true;
        else 
            return false;
    }

    function WriteInformationRoom($NameInfo){
        $user = R::load('users', $_SESSION["logged_user"]->id);
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));

        switch ($NameInfo) {
            case 'NameRoom':
                echo $user->roomactive;
                break;
            case 'AmountPlayer':
                echo $room[0]['amountplayer'];
                break;
            case 'date':
                echo $room[0]['timecreate'];
                break;
            case 'roomgame':
                return $room[0]['roomgame'];
                break;
            default:
                break;
        }
    }

    function ConclusionPlayers($loginPlayer, $namePlayer, $win, $Number){
        $tmpLogin = $loginPlayer;
        $TmpUser = R::getAll("SELECT * FROM users WHERE login = ?", array($tmpLogin));
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($TmpUser[0]['roomactive']));
        $tmpName = $namePlayer;
        $tmpWin = $win;
        if ($TmpUser[0]['id'] != $_SESSION["logged_user"]->id)
            $DropFight = '
                <div class="PunktMenu" onclick="DropFight('.$TmpUser[0]['id'].', '.$_SESSION["logged_user"]->id.');">
                    <p>
                        Бросить вызов
                    </p>
                </div>
            ';
        else
            $DropFight = '';
        echo '
            <div class="player">
                <div class="dropMenu">
                    <div class="PunktMenu">
                        <a href="AnyProfile.php?id='.$TmpUser[0]['id'].'&roomid='.$room[0]["roomid"].'">
                            Профиль
                        </a>
                    </div>
                    '.$DropFight.'
                </div>
                <div class="NamePlayer">
                    <div class="Name">
                        <p>
                            '. $Number.". " .' '. $tmpName .'
                        </p>
                    </div>
                    <div class="WinPlayer">
                        <p>
                            '.$tmpWin .'
                        </p>
                    </div>
                </div>
                <div class="avatar" style="background-image: url(avatars/'.$TmpUser[0]['avatar'].')"></div>
            </div>
        ';
    }

    function ListPlayersFirstColumn(){
        $user = R::load('users', $_SESSION["logged_user"]->id);
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));
        $listPlayer = SortPeopleWinRating($room[0]['roomid'], 'nameplayer');
        if (count($listPlayer) <= 10){
            foreach($listPlayer as $key=>$value){
                if($key >= 5){}else{
                    ConclusionPlayers($value['loginplayer'], $value['nameplayer'], $value['win'], $key+1);
                }
            }
        } elseif (count($listPlayer) > 10){
            foreach($listPlayer as $key=>$value){
                if($key >= count($listPlayer)/2){}else{
                    ConclusionPlayers($value['loginplayer'], $value['nameplayer'], $value['win'], $key+1);
                }
            }
        }
    }

    function ListPlayersSecondColumn(){
        $user = R::load('users', $_SESSION["logged_user"]->id);
        $room = R::getAll("SELECT * FROM listroom WHERE name = ?", array($user->roomactive));
        $listPlayer = SortPeopleWinRating($room[0]['roomid'], 'nameplayer');
        if (count($listPlayer) <= 10){
            foreach($listPlayer as $key=>$value){
                if($key >= 5){
                    ConclusionPlayers($value['loginplayer'], $value['nameplayer'], $value['win'], $key+1);
                }
            }
        } elseif (count($listPlayer) > 10){
            foreach($listPlayer as $key=>$value){
                if($key >= count($listPlayer)/2){
                    ConclusionPlayers($value['loginplayer'], $value['nameplayer'], $value['win'], $key+1);
                }
            }
        }
    }

    function WriteListFight(){
        $roomgame = WriteInformationRoom("roomgame");
        $List = R::getAll("SELECT * FROM $roomgame");
        $Game = array();
        if(isset($List[0])){
            foreach($List as $key=>$value){
                $userone = R::getAll("SELECT * FROM users WHERE login = ?", array($value['oneplayer']));
                $usertwo = R::getAll("SELECT * FROM users WHERE login = ?", array($value['twoplayer']));
                if($userone[0]['name'] == "")
                    $tmp = $userone[0]['login'];
                else
                    $tmp = $userone[0]['name'];
                if($usertwo[0]['name'] == "")
                    $tmp2 = $usertwo[0]['login'];
                else
                    $tmp2 = $usertwo[0]['name'];
                $adminCheck = R::load('users', $_SESSION['logged_user']->id);
                $showAdmin = "on";
                $start = "off";
                $menu = "off";
                if ($adminCheck->security >= 2){
                    if ($value['sygrano'] == 2){
                        $menu = "on";
                        $start = "off";
                    } elseif($value['sygrano'] == 0){
                        $menu = "off";
                        $start = "on";
                    } else {
                        $showAdmin = "off";
                    }
                    $adminPanel = '
                        <div class="adminPanel '.$showAdmin.'">
                            <div class="PlayGame '.$menu.'">
                                <div class="button" onclick="win('.$value["id"].',1)">
                                    <p>
                                        Победил
                                    </p>
                                </div>
                                <div class="button" onclick="win('.$value["id"].',3)">
                                    <p>
                                        Ничья
                                    </p>
                                </div>
                                <div class="button" onclick="win('.$value["id"].',2)">
                                    <p>
                                        Победил
                                    </p>
                                </div>
                            </div>
                            <div class="StartGame '.$start.'">
                                <div class="Start" onclick="startPlay('.$value["id"].')">
                                    <img src="img/sword.png" alt="меч">
                                    <p>
                                        Начать бой
                                    </p>
                                    <img src="img/sword.png" alt="меч">
                                </div>
                            </div>
                        </div>
                    ';
                } else {
                    $adminPanel = '';
                }
                $Game[] = '
                    <div class="FonFight">
                        <div class="Player">
                            <div class="avatar" style="background-image: url(avatars/'.$userone[0]["avatar"].')"></div>
                            <p>
                                '.$tmp.'
                            </p>
                        </div>
                        <div class="StatusPlay">
                            <p>
                                '.$value["identificatorone"]." : ".$value["identificatortwo"] .'
                            </p>
                        </div>
                        <div class="Player">
                            <p>
                                '.$tmp2.'
                            </p>
                            <div class="avatar" style="background-image: url(avatars/'.$usertwo[0]["avatar"].')"></div>
                        </div>
                    </div>
                    '.$adminPanel.'
                ';
            }
            for ($i = count($Game)-1; $i >= 0; $i--) { 
                echo $Game[$i];
            }
        }
    }
<?php
    function HistoryView(){
        $info = R::getAll('SELECT * FROM historygame');
        $history = array();
        foreach ($info as $key => $value) {
            $value['firstwinner'] = substr($value['firstwinner'],0 , 10);
            $value['secondwinner'] = substr($value['secondwinner'],0 , 10);
            $value['thirdwinner'] = substr($value['thirdwinner'],0 , 10);
            $tmp = implode(unpack("H*", $value['firstwinner']));
            $tmp2 = substr($tmp, -3);
            if ($tmp2 == "0d0"){
                $value['firstwinner'] = pack("H*", substr($tmp,0 , strlen($tmp)-3));
            } else {
                $value['firstwinner'] = pack("H*", $tmp);
            }
            $tmp = implode(unpack("H*", $value['secondwinner']));
            $tmp2 = substr($tmp, -3);
            if ($tmp2 == "0d0"){
                $value['secondwinner'] = pack("H*", substr($tmp,0 , strlen($tmp)-3));
            } else {
                $value['secondwinner'] = pack("H*", $tmp);
            }
            $tmp = implode(unpack("H*", $value['thirdwinner']));
            $tmp2 = substr($tmp, -3);
            if ($tmp2 == "0d0"){
                $value['thirdwinner'] = pack("H*", substr($tmp,0 , strlen($tmp)-3));
            } else {
                $value['thirdwinner'] = pack("H*", $tmp);
            }
            $history[] = '        
            <div class="History-block1">
                <div class="phone-position">
                    <p>'.$value['chislo'].'</p>
                    <div class="col-players" style="display: flex; flex-direction: row;">
                        <img src="img/IconHistoryPlayers.png" alt="piple">
                        <p style="margin-left: 10px;">
                            '.$value['players'].'-игроков
                        </p>
                    </div>
                    <div class="literbeer" style="display: flex; flex-direction: row;">
                        <img src="img/IconHistoryLiterBeer.png" alt="weight">
                        <p style="margin-left: 10px;">
                            '.$value['literbeer'].' л. - Жидкого золота
                        </p>
                    </div>
                    <div class="btn-drop-menu" id="drop-menu-history">
                        <img src="img/HistoryArrow.png" alt="arrow">
                    </div>
                </div>
                <div class="piople1">
                    <div class="listPlayer">
                        <p>1.'.$value['firstwinner'].'</p>
                        <p>2.'.$value['secondwinner'].'</p>
                        <p>3.'.$value['thirdwinner'].'</p>
                    </div>    
                    <div>
                        <img src="img/HistoryChampion.png" alt="medal">
                    </div>
                </div>
            </div>
            <div class="slide-content" id="History-slide">
                <div class="piople">
                    <div class="listPlayer" style="overflow: hidden; white-space: nowrap; display: flex; justify-content: space-between; flex-direction: column; width: 75%;">
                        <p>1.'.$value['firstwinner'].'</p>
                        <p>2.'.$value['secondwinner'].'</p>
                        <p>3.'.$value['thirdwinner'].'</p>
                    </div>
                    <div>
                        <img src="img/HistoryChampion.png" alt="medal">
                    </div>
                </div>
                <div>
                    <img src="img/HistoryPedestal.png" alt="piedistal">
                </div>
            </div>';
        }
        for ($i = count($history)-1; $i >= 0; $i--) { 
            echo $history[$i];
        }
    }
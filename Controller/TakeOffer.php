<?php
    function TakeOffer($name, $offer){
        date_default_timezone_set('UTC+6');
        $offerList = R::dispense('offer');
        $offerList->user = $name;
        $offerList->description = $offer;
        $offerList->date = date(DATE_RFC822);
        R::store($offerList);
        header("Location: /");
    }
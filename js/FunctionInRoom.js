$(document).ready(function() {
	$('#ListPlayersRoom .player').on('click', function(){
        if($(this).find(".dropMenu").hasClass("activeRoomMenu")){
            var input = $("#ListPlayersRoom .FirstColumn").find('.dropMenu');
            var Amount = 0;
            for (var i = 0; i < input.length; i++) {
                if(input[i]['classList'].length > 1){
                    Amount++;
                    $(input[i]).removeClass("activeRoomMenu");
                }
            }
        } else {
            var input = $("#ListPlayersRoom .FirstColumn").find('.dropMenu');
            var Amount = 0;
            for (var i = 0; i < input.length; i++) {
                if(input[i]['classList'].length > 1){
                    Amount++;
                }
            }
            if (Amount > 0){
                for (var i = 0; i < input.length; i++) {
                    if(input[i]['classList'].length > 1){
                        $(input[i]).removeClass("activeRoomMenu");
                    }
                }
            }
            $(this).find(".dropMenu").toggleClass("activeRoomMenu");
        }
    });
});

function startPlay(id){
    $(document).ready(function() { 
        $.ajax({
            url: "../Controller/AdminPanelRoom.php",
            type: "POST",
            data: ({id: id}),
            success: complite
        });  
    });
}

function win(id, player){
    $(document).ready(function() { 
        $.ajax({
            url: "../Controller/AdminPanelRoom.php",
            type: "POST",
            data: ({id: id, player: player}),
            success: complite
        });  
    });
}

function DropFight(FirstPlayer, SecondPlayer){
    $(document).ready(function(){
        $.ajax({
            url: "../Controller/DropFight.php",
            type: "POST",
            data: ({First: FirstPlayer, Second: SecondPlayer}),
            success: complite
        });
    });
}

function complite(number, d){
    if(number == "success"){
        location.href = location.href;
    } else {
        console.log(number);
    }
}
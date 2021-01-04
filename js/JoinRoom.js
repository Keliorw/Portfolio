function JoinRoom(roomid){
    const state = {};
    const title = '';
    var url = location.href+'?roomid='+roomid;
    var RoomIDPosition = (location.href).indexOf("roomid");
    if((RoomIDPosition) == -1)
        history.pushState(state, title, url);
    else 
        if((location.href).substr(RoomIDPosition+7, (location.href).length) != roomid){
            var presentURL = location.href;
            url = presentURL.substr(0, RoomIDPosition+7)+roomid;
            history.pushState(state, title, url);
        }
    var JoinRoom = document.getElementById("JoinRoom");
    JoinRoom.style.display = "flex";

    window.onclick = function(event){
        if(event.target == JoinRoom){
            JoinRoom.style.display = "none";
            ChangeURL();
        }
        
    }
}

function ChangeURL(){
    const state = {};
    const title = '';
    var presentURL = location.href;
    const url = presentURL.substr(0, (presentURL.length)-19);
    history.pushState(state, title, url);
}

function CloseMenuJoinRoom(){
    var JoinRoom = document.getElementById("JoinRoom");

    JoinRoom.style.display = "none";
    ChangeURL();
}
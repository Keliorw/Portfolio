
function resizeArea(text_id, minHeight, maxHeight)
{
   var area = $(text_id);
   var area_hidden = $(text_id + "_hidden");
   var text = '';
   area.value.replace(/[<>]/g, '_').split("\n").each( function(s){
           text = text + '<div>' + s.replace(/\s\s/g, ' &nbsp;') + '&nbsp;</div>'+"\n";
   } );
   area_hidden.innerHTML = text;
   var height = area_hidden.offsetHeight + 15;
   height = Math.max(minHeight, height);
   height = Math.min(maxHeight, height);
   area.style.height = height + 'px';
}

function CreateRoomMenu(){
    var CreateRoomMenu = document.getElementById("CreateRoomMenu");
    var CloseButton = document.getElementById("CloseButton");

    CreateRoomMenu.style.display = "flex";

    CloseButton.onclick = function(){
        CreateRoomMenu.style.display = "none";
    }
    
    window.onclick = function(event){
        if(event.target == CreateRoomMenu)
            CreateRoomMenu.style.display = "none";
    }
}

function Openmenu(){
    var LeftMenuFon = document.getElementById('LeftMenuFon');
    LeftMenuFon.classList.toggle('MenuActive');

    window.onclick = function(event){
        if(event.target == LeftMenuFon)
            LeftMenuFon.style.display = "none";
    }
}

function OpenMenuUploadAvatar(){
    var modal = document.getElementById("MyModal");

    modal.style.display = "flex";

    window.onclick = function(event){
        if(event.target == modal){
            modal.style.display = "none";
        }
    }
}

function ChangeNameBlockView(){
    var StatsPlayerInProfile = document.getElementById('StatsPlayerInProfile');
    var ChengeNameUserForm = document.getElementById('ChengeNameUserForm');

    if (StatsPlayerInProfile.style.display == "none"){
        StatsPlayerInProfile.style.display = "block";
        ChengeNameUserForm.style.display = "none";
    } else {
        StatsPlayerInProfile.style.display = "none";
        ChengeNameUserForm.style.display = "flex";
    }
}
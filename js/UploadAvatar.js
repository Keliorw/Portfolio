var NowAvatarGlob;
function UploadFile(file, NowAvatar) {
    NowAvatarGlob = NowAvatar;
    if(file['0']['size'] <= 5000000)
        $(document).ready(function(){
            var data = new FormData();
            data.append('Avatar', file[0]);
            $.ajax({
                url: "../Controller/CheckAvatar.php",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                type: "POST",
                success: error
            });         
        });
    else {
        error("Если не грузит, пикай файл поменьше, петушок", 0);
    }
}

function Back(){
    $(document).ready(function(){
        $.ajax({
            url: "../Controller/CheckAvatar.php",
            data: ({NowAvatarChange: NowAvatarGlob}),
            method: "POST",
            success: backDesign
        });
    });
}

function backDesign(warning, d){
    var TextError = document.getElementById("TextError");
    var SendBlock = document.getElementById("SendAvatar");
    var SaveBlock = document.getElementById("SaveAvatar");
    var sectionThree = document.getElementById("sectionThree");

    TextError.innerHTML = "Если не грузит пикай файл поменьше петушок";
    TextError.style.color = "rgba(0, 0, 0, 0.6)";
    SendBlock.style.display = "flex";
    sectionThree.style.display = "flex";
    SaveBlock.style.display = "none";
}

function error(warning ,d){
    var TextError = document.getElementById("TextError");
    var SendBlock = document.getElementById("SendAvatar");
    var SaveBlock = document.getElementById("SaveAvatar");
    var sectionThree = document.getElementById("sectionThree");
    var ViewAvatar = document.getElementById("ViewAvatar");

    if(warning.substr(0, 7) == "Success"){
        TextError.innerHTML = "Фото выбрано верно!";
        TextError.style.color = "rgba(58, 146, 0, 0.6)";
        SendBlock.style.display = "none";
        sectionThree.style.display = "none";
        SaveBlock.style.display = "flex";
        ViewAvatar.style.backgroundImage = "url(avatars/"+ warning.slice(7) +")";
    } else {
        TextError.innerHTML = warning;
        TextError.style.color = "rgba(163, 34, 1, 0.6)";
    }    
}

function CheckFormCreateRoom(NameRoom) {
    $(document).ready(function(){
        $.ajax({
            url: "../Controller/CheckListRoom.php",
            type: "POST",
            data: ({Name: NameRoom}),
            success: error
        });           
    });
}

function StyleError(keyError, Text, Border){
    if (keyError == true){
        return Text.style.color = "rgba(58, 146, 0, 0.6)", Border.style.border = "1px solid rgba(58, 146, 0, 0.6)";
    } else {
        return Text.style.color = "rgba(163, 34, 1, 0.6)", Border.style.border = "1px solid rgba(163, 34, 1, 0.6)";
    }
}

//Проверка пароля на правильность ввода
function CheckPassword(password1, password2){
    var el1 = document.getElementById("errorPassword");
    var el2 = document.getElementById("errorAgainPassword");
    var InputEl1 = document.getElementById("password");
    var InputEl2 = document.getElementById("AgainPassword");

    switch (password1) {
        case "":
            el1.innerHTML = "Введите пароль";
            StyleError(false, el1, InputEl1);
            break;
        case password2:
            if(password1.length >= 4){
                el1.innerHTML = "Пароль введён верно";
                StyleError(true, el1, InputEl1)
            }
            el2.innerHTML = "Пароли совпадают";
            StyleError(true, el2, InputEl2);
            break;
        case (password1.length < 4)? password1 : NaN :
            el1.innerHTML = "Пароль должен содержать не менее 4-х символов";
            StyleError(false, el1, InputEl1);
            if(password1 == password2)
                break;
        case (password2 != password1)? password1: NaN :
            el2.innerHTML = "Пароли не совпадают";
            StyleError(false, el2, InputEl2);
            if(password1.length < 4)
                break;
        default:
            el1.innerHTML = "Пароль введён верно";
            StyleError(true, el1, InputEl1);
            break;
    }
}

//Проверка повторного пароля на правильность ввода
function CheckAgainPassword(password1, password2){
    var el2 = document.getElementById("errorAgainPassword");
    var InputEl2 = document.getElementById("AgainPassword");

    switch (password1){
        case "":
            el2.innerHTML = "Повторите пароль";
            StyleError(false, el2, InputEl2);
            break;
        case (password2 != password1)? password1: NaN :
            el2.innerHTML = "Пароли не совпадают";
            StyleError(false, el2, InputEl2);
            break;
        default:
            el2.innerHTML = "Пароли совпадают";
            StyleError(true, el2, InputEl2);
            break;
    }
}

//проверка имени комнаты
function error(number, d){
    var el1 = document.getElementById("errorName");
    var InputEl1 = document.getElementById("name");

    if (number != "success"){
        el1.innerHTML = number;
        StyleError(false, el1, InputEl1);
    }

    if(number == "success"){
        el1.innerHTML = "Имя свободно";
        StyleError(true, el1, InputEl1);
    }
}
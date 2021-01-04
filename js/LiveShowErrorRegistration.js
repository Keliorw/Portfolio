function CheckFormRegistration(DataUser, FuncName) {
    $(document).ready(function(){
        $.ajax({
            url: "../Controller/CheckFormRegistration.php",
            type: "POST",
            data: ({DataUserReg: DataUser, action: FuncName}),
            success: error
        });           
    });
}

//Замена стилей у Input-ов регистрации и текста подписи ошибки 
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


// Вывод ошибок с сервера
function error(number, d){
    var el1 = document.getElementById("errorLogin");
    var el2 = document.getElementById("errorEmail");
    var InputEl1 = document.getElementById("login");
    var InputEl2 = document.getElementById("email");

    //ошибки ввода Логина
    if (number == "error login 1"){
        el1.innerHTML = "Логин занят";
        StyleError(false, el1, InputEl1);
    }     

    if (number == "error login 2"){
        el1.innerHTML = "Введите логин";
        StyleError(false, el1, InputEl1);
    }

    if (number == "error login 3"){
        el1.innerHTML = "Разрешённые символы: a-z A-Z";
        StyleError(false, el1, InputEl1);
    }

    if(number == "login 1"){
        el1.innerHTML = "Логин свободен";
        StyleError(true, el1, InputEl1);
        
    }
    //Ошибки ввода Email
    if (number == "error email 1"){
        el2.innerHTML = "Эта почта уже занята";
        StyleError(false, el2, InputEl2);
    }     

    if (number == "error email 2"){
        el2.innerHTML = "Введите Email";
        StyleError(false, el2, InputEl2);
    }

    if (number == "error email 3"){
        el2.innerHTML = "Некорректно введён Email";
        StyleError(false, el2, InputEl2);
    }

    if(number == "email 1"){
        el2.innerHTML = "Email свободен";
        StyleError(true, el2, InputEl2);
        
    }
}
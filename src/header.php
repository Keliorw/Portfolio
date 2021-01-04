<div class="LeftMenuFon" id="LeftMenuFon">
    <div class="SortBlockMenu">
        <?php if(isset($_SESSION['logged_user'])) : ?>
            <div class="BlockMenuProfile" onclick="location.href='Profile.php'">
                <?php echo "<div class='avatar' style='background-image: url(avatars/".$_SESSION['logged_user']->avatar.")'></div>"; ?>
                <p>
                    <?=WriteName() ?>
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='/'">
                <div class="ImageMenu">
                    <img src="img/lobbi_icon.svg" alt="главная">
                </div>
                <p>
                    Главная
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='/room.php'">
                <div class="ImageMenu">
                    <img src="img/Beer-icon.svg" alt="турниры">
                </div>
                <p>
                    Комнаты
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='rules.php'">
                <div class="ImageMenu">
                    <img src="img/rules_icon.svg" alt="правила">
                </div>
                <p>
                    Правила
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='logout.php'">
                <div class="ImageMenu">
                    <img src="img/exit.svg" alt="выход">
                </div>
                <p>
                    Выход
                </p>
            </div>
        <?php else: ?>
            <div class="BlockMenuProfile">
                <?php echo "<div class='avatar' style='background-image: url(img/Avatarka-default.png)'></div>"; ?>
                <p>
                    Пользователь
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='signup.php'">
                <div class="ImageMenu">
                    <img src="img/signup.png" alt="Зарегестрироваться">
                </div>
                <p>
                    Зарегестрироваться
                </p>
            </div>
            <div class="BlockMenu" onclick="location.href='signin.php'">
                <div class="ImageMenu">
                    <img src="img/login.png" alt="войти">
                </div>
                <p>
                    Войти
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="Header">
    <div class="container">
        <div class="desktop">
        <a href="/"><div class="MainLogo"></div></a>
            <?php if (isset($_SESSION['logged_user'])) : ?>
                <div class="NavMenu">
                    <div class="Punkt">
                        <a href="/">
                            Главная
                        </a>    
                    </div>
                    <div class="Punkt">
                        <a href="room.php">
                            Комнаты
                        </a>    
                    </div>
                    <div class="Punkt">
                        <a href="rules.php">
                            Правила
                        </a>    
                    </div>
                </div>
                <div class="Profile" onclick="location.href='/Profile.php'">
                    <div class="name">
                        <p><?=WriteName() ?></p>
                    </div>
                    <div class="avatar" style="background-image: url('avatars/<?=$_SESSION['logged_user']->avatar ?>');"></div>
                    <div>
                        <img src="img/arrow.png">
                    </div>
                    <div class="dropMenu">
                        <div class="PunktMenu">
                            <a href="Profile.php">Профиль</a>
                        </div>
                        <div class="PunktMenu">
                            <a href="logout.php">Выйти</a>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="Menu">
                    <button class="registerButton" type="button" onclick="location.href='/signup.php'">
                        зарегестрироваться
                    </button>
                    <button class="loginButton" type="button" onclick="location.href='/signin.php'">
                        войти
                    </button>
                </div>
            <?php endif ?>
        </div>
        <div class="phone">
            <a href="/"><div class="MainLogo"></div></a>
            <div id="menu">
            </div>
            <div class="button" onclick="Openmenu()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="content">
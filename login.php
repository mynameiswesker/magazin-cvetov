<?php
require "db.php";?>
<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta charset="utf-8">
        <title>Create profile</title>
        <link rel="stylesheet" href="style_login.css">
        <link href="https://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    </header>
<body>
<div class="big">
    <?php
    $data = $_POST;
    if (isset($data['do_login']))
    {
        $errors = array();
        $user = R:: findOne('users','login = ?', array($data['login']));
        if ($user)
        {
            if (password_verify($data['password_1'], $user->password))                                                /** Логин существует */
            {
                $_SESSION['logged_user'] = $user;                                                                                                      /** Все хорошо , логиним пользователя */
                echo '<div style="color:white;">Вход произведен успешно!<br/>
                                              Можете перейти на <a href="/">главную</a> страницу</div>';
            }else
            {
                $errors[] = 'Неверно введён пароль!';
            }
        }else
        {
            $errors[] = 'Пользователя с таким login-ом не существует!';
        }
        if ( ! empty($errors))
        {
            echo '<div id="error" style="color: white">'.array_shift($errors).'</div>';
        }
    }
    ?>
    <div id="form">
        <form action="login.php" name="profile" method="POST">
            <div class="Top_h4"><h4 class="escape">Вход</h4></div>
            <p>
                <div class="wrape_for_h4"><h4 class="escape">Введите Ваш Логин</h4></div>
				<div class="InputBox">
                    <label class="label_text">Ваш логин</label>
                    <input type="text" class="adClass" name="login" value="<?php
                    echo @$data['login'];
                    ?>">
                    <div class="back"></div>
                </div>
            </p>
            <p>
                <div class="wrape_for_h4"><h4 class="escape">Введите Ваш пароль</h4></div>
                <div class="InputBox">
                    <label class="label_text">Ваш пароль</label>
                    <input type="text" class="adClass" name="password_1" value="<?php
                    echo @$data['password_1'];
                    ?>">
                    <div class="back"></div>
                </div>
            </p>
            <p>
                <button type="submit" name="do_login">Войти</button>
            </p>
        </form>
    </div>
    <div id="menu">
        <div class="wrapp">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="signup.php">Регистрация</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </div>
    </div>
    <script>
        $(".adClass").focus(function () {
            $(this).parent().addClass("focus");
        })
            .blur(function () {
                if($(this).val()===''){
                    $(this).parent().removeClass("focus");
                }
            })
    </script>
</div>
</body>
</html>
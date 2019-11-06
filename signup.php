<?php
require "db.php";?>
<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta charset="utf-8">
        <title>Create profile</title>
        <link rel="stylesheet" href="style_signup.css">
        <link href="https://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    </header>
<body>
<?php
$data=$_POST;
if (isset($data['do_signup'])){

    $errors = array();                                            /** Проверяем на ошибки регистрацию */
    if (trim($data['login']) == '')
    {
        $errors[] = 'Введите логин';
    }
    if (trim($data['email']) == '')
    {
        $errors[] = 'Введите email';
    }
    if ($data['password_1'] == '')
    {
        $errors[] = 'Введите пароль';
    }
    if ($data['password_1'] != $data['password_2'])
    {
        $errors[] = 'Повторный пароль введён не верно!';
    }
    if (R::count('users', "login = ?", array($data['login'])) > 0)
    {
        $errors[] = 'Пользователь с таким логином уже существует!';
    }
    if (R::count('users', "email = ?", array($data['email'])) > 0)
    {
        $errors[] = 'Пользователь с таким email-ом уже существует!';
    }
    if (empty($errors))
    {
        $user = R::dispense('users');                          /** Все хорошо, регистрируем.Создаем БД через rbPhp */
        $user->login = $data['login'];                                        /** *******************************************/
        $user->email = $data['email'];                                               /** *********************************************/
        $user->password = password_hash($data['password_1'],PASSWORD_DEFAULT);/** *********************************************/
        R::store($user);
        $_SESSION['logged_user'] = $user;
        echo '<div style="color:white;">
                   Вы успешно зарегистрированны!<br />
                   Теперь Вы можете осуществлять все функции данного сайта , узанные в разделе на <a href="/">главной странице</a>
              </div>';
    } else
    {
        echo '<div style="color:white;position: absolute;top:5px;left: 10px;">'.array_shift($errors).'</div>';
    }
}
?>
    <div id="form">
        <form action="signup.php" name="profile" method="POST">
            <div class="Top_h4"><h4 class="escape">Регистрация</h4></div>
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
                <div class="wrape_for_h4"><h4 class="escape">Введите Ваш email</h4></div>
                <div class="InputBox">
                    <label class="label_text">Ваш email</label>
                    <input type="email" class="adClass" name="email" value="<?php
                    echo @$data['email'];
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
                <div class="wrape_for_h4"><h4 class="escape">Введите Ваш пароль ещё раз</h4></div>
                <div class="InputBox">
                    <label class="label_text">Ваш пароль еще раз</label>
                    <input type="text" class="adClass" name="password_2" value="<?php
                    echo @$data['password_2'];
                    ?>">
                    <div class="back"></div>
                </div>
            </p>
            <p>
                <button type="submit" name="do_signup">Зарегистрироваться</button>
            </p>
        </form>
    </div>
    <div id="menu">
        <div class="wrapp">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="login.php">Вход</a></li>
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
</body>
</html>
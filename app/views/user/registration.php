<?php
/** @var string $error_message - Текст ошибки */
?>
<!--<div class="page">-->
<!--    <div class="container">-->
<!--        <div class="auth_block">-->
<!--            <h1 class="title">Регистрация</h1>-->
<!--            <form name="auth_form" method="post">-->
<!--                <div class="auth_form">-->
<!---->
<!--                    <div class="alert alert-danger --><? //= !empty($error_message) ? null : 'hidden' ?><!--">-->
<!--                        --><? //= !empty($error_message) ? $error_message : null ?>
<!--                    </div>-->
<!---->
<!--                    <div class="input_box">-->
<!--                        <label for="field_username">Имя</label>-->
<!--                        <input type="text"-->
<!--                               name="username"-->
<!--                               id="field_username"-->
<!--                               class="form-control"-->
<!--                               maxlength="120"-->
<!--                               value="--><? //= !empty($_POST['username']) ? $_POST['username'] : '' ?><!--"-->
<!--                               placeholder="Введите имя"-->
<!--                        >-->
<!--                    </div>-->
<!---->
<!--                    <div class="input_box">-->
<!--                        <label for="field_login">Логин</label>-->
<!--                        <input type="text"-->
<!--                               name="login"-->
<!--                               id="field_login"-->
<!--                               class="form-control"-->
<!--                               maxlength="24"-->
<!--                               value="--><? //= !empty($_POST['login']) ? $_POST['login'] : '' ?><!--"-->
<!--                               placeholder="Введите логин"-->
<!--                        >-->
<!--                    </div>-->
<!---->
<!--                    <div class="input_box">-->
<!--                        <label for="field_password">Пароль</label>-->
<!--                        <input type="password"-->
<!--                               name="password"-->
<!--                               id="field_password"-->
<!--                               class="form-control"-->
<!--                               placeholder="Введите пароль"-->
<!--                        >-->
<!--                    </div>-->
<!---->
<!--                    <div class="input_box">-->
<!--                        <label for="field_confirm_password">Повторите пароль</label>-->
<!--                        <input type="password"-->
<!--                               name="confirm_password"-->
<!--                               id="field_confirm_password"-->
<!--                               class="form-control"-->
<!--                               placeholder="Повторите пароль"-->
<!--                        >-->
<!--                    </div>-->
<!---->
<!--                    <div class="button_box">-->
<!--                        <button type="submit"-->
<!--                                name="btn_registration_form"-->
<!--                                id="btnRegistrationForm"-->
<!--                                class="btn btn-primary"-->
<!--                                value="1"-->
<!--                        >Регистрация-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/app/web/css/auto_form.css">
</head>
<body>

<div class="wrapper fadeInDown">
    <div id="formContent">

        <h2 class="active"> Регистрация </h2>


        <div class="fadeIn first">
            <img src="https://cdn-icons-png.flaticon.com/512/931/931949.png" id="icon" alt="User Icon"/>
        </div>

        <form method="post">


            <input type="text"
                   name="username"
                   id="field_username"
                   class="form-control"
                   maxlength="120"
                   value="<?= !empty($_POST['username']) ? $_POST['username'] : '' ?>"
                   placeholder="Введите имя"
            >


            <input type="text"
                   name="login"
                   id="field_login"
                   class="form-control"
                   maxlength="24"
                   value="<?= !empty($_POST['login']) ? $_POST['login'] : '' ?>"
                   placeholder="Введите логин"
            >


            <input type="password"
                   name="password"
                   id="field_password"
                   class="form-control"
                   placeholder="Введите пароль"
            >


            <input type="password"
                   name="confirm_password"
                   id="field_confirm_password"
                   class="form-control"
                   placeholder="Повторите пароль"
            >

            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                <?= !empty($error_message) ? $error_message : null ?>
            </div>
            <input type="submit"
                   name="btn_registration_form"
                   id="btnRegistrationForm"
                   class="fadeIn fourth"
                   value="Регистрация"
            >
        </form>

    </div>
</div>


</body>
</html>

<!--это-->
<!--class="btn btn-primary"-->
<!--заменил на это-->
<!--class="fadeIn fourth"-->
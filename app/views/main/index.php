<?php

use app\lib\UserOperations;

/** @var $content - списко каталога */

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/web/css/style.css">
    <title>Document</title>
</head>
<body>
<header class="brand">

    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://cdn-icons-png.flaticon.com/512/761/761767.png" alt="Logo" width="50" height="48"
                         class="d-inline-block ">
                    </strong>BEERMAX</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                     aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><strong>BEERMAX</strong></a>
                                <!--                                <img src="https://cdn-icons-png.flaticon.com/512/6957/6957439.png" alt="Logo" width="50" height="48" class="d-inline-block ">-->
                            </li>

                            <?php if (!empty($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/profile">Здравствуйте,<?= $_SESSION['user']['username'] ?> !</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/user/logout">Выйти</a>
                            </li>
                            <?php if (!empty($_SESSION['user']['is_admin'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/profile">Панель Администратора</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/users">Список зареганых пользователей</a>
                            </li>
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" href="delete_product.php">Удаление товара</a>-->
<!--                            </li>-->
                            <?php endif; ?>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="auth_form.php">Войти в профиль</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#1">Что-то о пиве</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#2">Наши товары</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="Basket.php" role="button">Корзина</a>
                            </li>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row align-items-center">
            <div class="text_logo">
                <h1>ПИВО <strong>ЖИДКОЕ</strong> СЧАСТЬЕ</h1>
                <small>Запрещено лицам моложе 18 лет</small>

            </div>
        </div>
    </div>
    <div class="menu">
        </p>
        <img class="kosmos d-none d-lg-xl-none d-xl-block"
             src="https://cdn-icons-png.flaticon.com/512/3263/3263018.png" alt="beer" width="600" height="600">
    </div>

</header>


<section class="news">
    <a name="1"></a>
    <div class="container-xxl text-center">
        <div class="row">
            <div class="planet_n">
                <h1><strong>НАШИ ТЕХНОЛОГИИ</strong></h1>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="col">
            <div class="card mb-3" style="max-width: 640px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/5417/5417407.png"
                             class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">ХМЕЛЬ</h5>
                            <p class="card-text"><small class="text-muted">#DRINK #BEER </small></p>
                            <p class="card-text">Хмель в пивоварении применяют с древнейших времен.
                                Именно он придает пенному напитку характерный вкус и аромат.
                                Для изготовления пива используют плоды обыкновенного хмеля – многолетнего
                                широколиственного вьющегося растения семейства тутовых. Оно предпочитает влажные леса,
                                расположенные вблизи водоемов. Цветки хмеля похожи на шишки</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 640px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/3887/3887778.png"
                             class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">НАУКА</h5>
                            <p class="card-text"><small class="text-muted">#DRINK #BEER </small></p>
                            <p class="card-text">Наука, изучающая пиво, называется Zythology (Зитология).
                                Термин образован от двух греческих слов: «Zythos» (пиво) и «Logos» (исследование). А в
                                Германии существует Мюнхенский институт пива,
                                ученые которого научно доказали, что благодаря уникальному составу 1 литр
                                нефильтрованного немецкого пива в 10 раз полезнее, чем 1 литр молока.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 640px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/6332/6332475.png"
                             class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">ДОСТАВКА</h5>
                            <p class="card-text"><small class="text-muted">#DRINK #BEER</small></p>
                            <p class="card-text">Доставка осуществляется во все регионы России. Наличие множества
                                транспортных компаний с их складами и терминалами в каждом крупном городе
                                России делает беспроблемным заказ товаров в нашей компании и получение его Вами.
                                Получив оплату за товар, мы в течение 2-3 дней отгружаем его на ваш адрес</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <strong><a href="#" class="link-light">more</a></strong>

</section>

<section class="colons">
    <a name="2"></a>
    <div class="container-fluid">
        <div class="our_works">
            <div class="heading-content text-center">
                <h1><strong>Наши товары</strong></h1>
            </div>
            <!--            <div class="row">-->
            <!--                <div class="main_mix_content whitebackground text-center">-->
            <!--                    <div class="main_mix_menu">-->
            <!--                        <button type="button" class="btn btn-light"><h5> All <span>/</span></h5></button>-->
            <!--                        <button type="button" class="btn btn-light"><h5>architecture <span>/</span></h5></button>-->
            <!--                        <button type="button" class="btn btn-light"><h5>Interior & Furniture Design <span>/</span></h5>-->
            <!--                        </button>-->
            <!--                        <button type="button" class="btn btn-light"><h5>Research & Graphic Design</h5></button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>

</section>


<section class="back">
    <div class="container text-center">
        <div class="row align-items-start">

            <div class="col gy-5">
                <div class="card" style="width: 20rem;">
                    <!--                        <img src="https://images.squarespace-cdn.com/content/v1/5287bee0e4b0fd595cc2a60f/1496155488416-4GXO8IFEZSKI8O4N3ZSB/ke17ZwdGBToddI8pDm48kMidd_fVERlblIIVuIb_11BZw-zPPgdn4jUwVcJE1ZvWQUxwkmyExglNqGp0IvTJZUJFbgE-7XRK3dMEBRBhUpx10iUG6tfMgCBB2It1X-YJ7A5R-MhySWbfhJf8kid0Axv9bsT1zvOjTQZv2qL2czQ/Bottle-of-beer-mock-up-TOONILLA+WEB.png"-->
                    <img src=""
                         class="card-img-top" style="width: 8rem;margin: auto" height="370px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-price"> ₽</p>
                        <hr>
<!--                        изменил href="product.php?product_id="-->
                        <a class="btn btn-primary" href="product" role="button">Открыть</a>
                    </div>
                </div>
            </div>


            <div class="more">
                <a href="#" class="link-dark"><strong>more</strong></a>
            </div>
        </div>
</section>




<section class="contact_us">

    <div class="container-xxl">
        <div class="row">
            <div class="contact_u">
                <h1><strong>Контактная информация</strong></h1>
                <img src="separator.png" alt="">
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <p>BEERMAX - сеть магазинов, осуществляющая продажу алкоголя различных видов.
                    Мы стремимся сделать покупки в магазинах нашей сети наиболее комфортными для вас, поэтому постоянно
                    расширяем ассортимент продукции.
                </p>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col align-self-start">
                <img src="send_FILL0_wght400_GRAD0_opsz48.png" alt="">
                <h5>https://t.me/gruzevo</h5>
            </div>
            <div class="col align-self-center">
                <img src="home_FILL0_wght400_GRAD0_opsz48.png" alt="">
                <h6>РОССИЯ, АСТРАХАНЬ</h6>
            </div>
            <div class="col align-self-end">
                <img src="phone_enabled_FILL0_wght400_GRAD0_opsz48.png" alt="">
                <h6>+7(880)555-35-35</h6>
            </div>
        </div>
    </div>
</section>

<footer>
    <h4>BEERMAX</h4>
    <h5>Россия</h5>
    <p>@МдаМакс Inc.,2023 г.Все права защищены.</p>
    <small>или не все</small>
    <br>
    <small>Запрещено лицам моложе 18 лет</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
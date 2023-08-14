<?php
?>
<body class="qqw">
<div class="pageone">
    <div class="main_op">
        <div class="main_menu_one">
            <?php if (!empty($sidebar)) : ?>
                <div class="menu_box_one">
                    <ul>
                        <?php foreach ($sidebar as $link) : ?>
                            <li>
                                <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="order addincome">
        <div class="main_order">
            <div class="name_bl">
                <h4 class="bold">Новый товар</h4>
            </div>
            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                <?= !empty($error_message) ? $error_message : null ?>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="input_box">
                    <label for="field_username">Наименование</label>
                    <input type="text"
                           name="name"
                           id="field_username"
                           class="form-control"
                           maxlength="120"
                           placeholder="Введите наименование">
                </div>
                <div class="input_box">
                    <label for="field_username">Колличество:</label>
                    <input type="number" name="count" class="form-control" value="1">
                </div>
                <div class="input_box">
                    <label for="field_username">Цена:</label>
                    <input type="number" name="price" class="form-control" value="1">
                </div>
                <div class="input_box">
                    <label for="field_username">Скидка:</label>
                    <input type="number" name="sale" class="form-control">
                </div>
                <div class="input_box">
                    <label for="field_username">Описание</label>
                    <input type="text"
                           name="opisanie"
                           id="field_username"
                           class="form-control"
                           maxlength="120"
                           placeholder="Введите описание">
                </div>
                <div class="input_box">
                    <label for="field_username">Картинка</label>
                    <input type="file" name="upp" placeholder="Укажите путь">
                </div>
                <div class="button_box">
                    <button type="submit"
                            name="btn_add_form"
                            id="btnRegistrationForm"
                            class="btn btn-primary"
                            value="1"
                    >Добавить
                    </button>
                    <div class="links_box center">
                        <a href="/main/index">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

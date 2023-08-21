<?php
/** @var array $sidebar - Меню */
?>
<div class="page">
    <div class="container">
        <div class="cabinet_wrapped">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) : ?>
                    <div class="menu_box">
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
            <div class="cabinet_content">
                <dib class="page-content-inner">
                    <h2>Добавление товара</h2>
                    <form method="post" name="news_add_form"
                    enctype="multipart/form-data">
                        <div class="news_add_form">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>

                            <div class="input_box">
                                <label for="field_title">Наименование</label>
                                <input type="text"
                                       name="product[title]"
                                       id="field_title"
                                       class="form-control"
                                       maxlength="120"
                                       value="<?= !empty($_POST['product']['title']) ? $_POST['product']['title'] : '' ?>"
                                       placeholder="Введите наименование"
                                >
                            </div>

                            <div class="input_box">
                                <label for="field_short_description">цена</label>
                                <input type="text"
                                       name="product[price]"
                                       id="field_short_description"
                                       class="form-control"
                                       maxlength="120"
                                       value="<?= !empty($_POST['product']['price'])
                                           ? $_POST['product']['price']
                                           : ''
                                       ?>"
                                       placeholder="цена"
                                >
                            </div>
                            <div class="input_box">
                                <label for="field_short_description">колво</label>
                                <input type="number"
                                       name="product[count]"
                                       id="field_short_description"
                                       class="form-control"
                                       maxlength="120"
                                       value="<?= !empty($_POST['product']['count'])
                                           ? $_POST['product']['count']
                                           : (!empty($product['count']) ? $product['count'] : '')
                                       ?>"
                                       placeholder="колво"
                                >
                            </div>

                            <div class="input_box">
                                <label for="field_description">Описание</label>
                                <textarea
                                    name="product[description]"
                                    id="field_description"
                                    cols="50"
                                    rows="8"
                                    placeholder="Введиет описание"
                                ><?= !empty($_POST['product']['description'])
                                        ? $_POST['product']['description']
                                        : ''
                                    ?></textarea>
                            </div>
                            <div class="input_box">
                                <label for="field_short_description">Изображение</label>
                                <input type="file"
                                       name="file"
                                       id="field_short_description"
                                       class="form-control"
                                       maxlength="120"

                                >
                            </div>

                            <div class="button_box">
                                <button type="submit"
                                        name="btn_news_add_form"
                                        id="btnNewsAddForm"
                                        class="btn btn-primary"
                                        value="1"
                                >Добавить
                                </button>
                            </div>

                        </div>
                    </form>
                </dib>
            </div>
        </div>
    </div>
</div>
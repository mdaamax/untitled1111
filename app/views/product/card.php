<?php
/** @var array $sidebar - Меню */
/** @var string $role - Список новостей */

/** @var array $news - Роль пользователя */

use app\lib\UserOperations;

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
                    <h2>Новости</h2>
                    <div class="news-block">
                        <div class="links_box text-end">
                            <a href="/news/add">Добавить</a>
                        </div>
                        <?php if (!empty($card)) : ?>
                            <div class="news-list">
                                <?php foreach ($card as $item) : ?>
                                    <div class="news-item">
                                        <h3>
                                            <?= $item['title'] ?>
                                        </h3>
                                        <div class="news-short_description">цена <?= $item['price'] ?></div>
                                        <div class="news-description"><?= $item['description'] ?></div>
                                        <div class="news-description"><?= $item['in_card'] ?></div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                            <div class="button_box">
                                <a href="product/buy"
                                        id="btnNewsAddForm"
                                        class="btn btn-primary"
                                >Добавить
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>
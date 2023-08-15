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
                    <h2>товары</h2>
                    <div class="news-block">
                        <div class="links_box text-end">
                            <a href="/news/add">Добавить</a>
                        </div>
                        <?php if (!empty($product)) : ?>
                        <div class="news-list">
                            <?php foreach ($product as $item) :?>
                                <div class="news-item">
                                    <h3>
                                        <?=$item['title']?>
                                        <?php if ($role === UserOperations::RoleAdmin) :?>
                                        (<a href="/product/edit?news_id=<?=$item['id']?>">редактировать</a>
                                            <a href="/product/delete?news_id=<?=$item['id']?>">Удалить</a>)
                                        <?php endif ?>
                                    </h3>
                                    <div class="news-description"><?=$item['description']?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>
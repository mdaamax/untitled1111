<?php

namespace app\controllers;

use app\core\initController;
use app\lib\UserOperations;
use app\models\NewsModels;
use app\models\ProductModel;

class ProductController extends initController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['list'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                    [
                        'actions' => ['add', 'edit'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/product/list');
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionList()
    {
        $this->view->title = 'Список Товаров';
        $product_model = new ProductModel();
        $product = $product_model->getListProduct();
        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product,
            'role' => UserOperations::getRoleUser(),
        ]);
    }

    public function actionAdd()
    {
        $this->view->title = 'Добавление товара';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_add_form'])) {
            $product_data = !empty($_POST['product']) ? $_POST['product'] : null;
            $product_data['file'] = !empty($_FILES['file']) ? $_FILES['file'] : null;
            if (!empty($product_data)) {
                $userModel = new ProductModel();
                $result_add = $userModel->add($product_data);
                if ($result_add['result']) {
                    $this->redirect('/product/list');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }
        $this->render('add', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionEdit()
    {
        $this->view->title = 'Редактирование товара';
        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $product = null;
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_product_edit_form'])) {
            $product_data = !empty($_POST['product']) ? $_POST['product'] : null;
            if (!empty($product_data)) {
                $productModel = new ProductModel();
                $result_edit = $productModel->edit($product_id, $product_data);
                if ($result_edit['result']) {
                    $this->redirect('/product/list');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }
        if (!empty($product_id)) {
            $product_model = new ProductModel();
            $product = $product_model->getProductById($product_id);
            if (empty($product)) {
                $error_message = 'Товар не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }
        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product,
            'error_message' => $error_message
        ]);
    }

    public function actionDelete()
    {
        $this->view->title = 'Удаление товара';
        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $product = null;
        $error_message = '';
        if (!empty($product_id)) {
            $product_model = new ProductModel();
            $product = $product_model->getProductById($product_id);
            if (!empty($product)) {
                $result_delete = $product_model->deleteById($product_id);
                if ($result_delete['result']) {
                    $this->redirect('/product/list');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Новость не найдена!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }
        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product,
            'error_message' => $error_message
        ]);
    }

    public function actionAddcard()
    {
        $this->view->title = 'Добавление товара в корзину';
        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $error_message = '';
        if (!empty($product_id)) {
            $_SESSION["user"]['card'][] = $product_id;
            $this->redirect('/product/list');
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }
        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionCard()
    {
        $this->view->title = 'Корзина';
        $product = null;
        $error_message = '';
        if (!empty($_SESSION['user']['card'])) {
            $card = array_count_values($_SESSION['user']['card']);
            $productModel = new ProductModel();
            $product = $productModel->getProductsByID(implode(',', array_keys($card)));
            for ($i = 0; $i < count($product); $i++) {
                $product[$i]['in_card'] = $card[$product[$i]['id']];
            }
        } else {
            $error_message = 'Корзина пуста!';
        }
        $this->render('card', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'card' => $product,
        ]);
    }

    public function actionBuy()
    {
        $this->view->title = 'Оплата';
        $product = null;
        $error_message = '';
        if (!empty($_SESSION['user']['card'])) {
            $card = array_count_values($_SESSION['user']['card']);
            $productModel = new ProductModel();
            $product = $productModel->getProductsByID(implode(',', array_keys($card)));
            for ($i = 0; $i < count($product); $i++) {
                $product[$i]['in_card'] = $card[$product[$i]['id']];
                if ($product[$i]['count'] < $product[$i]['in_card']) {
                    $error_message = 'не хватает товара на складе';
                    break;
                }
            }
            if (empty($error_message)) {
                $itogPrice = 0;
                $itogCount = 0;
                foreach ($product as $item) {
                    $productModel->updateCountProduct($item['id'], $item['count'] - $item['in_card']);
                    $itogPrice += $item['price'] * $item['in_card'];
                    $itogCount += $item['in_card'];
                }
                $productModel->buyProduct($itogPrice, $itogCount, $_SESSION['user']['id']);
                $_SESSION['user']['card'] = [];
                $this->redirect('/product/card');
            }
        } else {
            $error_message = 'Корзина пуста!';
        }
        $this->render('buy', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'card' => $product,
        ]);
    }

    public function actionGlobal()
    {
        $this->view->title = 'Глобальная История';
        $product_model = new ProductModel();
        $product = $product_model->getHistory();
        $this->render('history', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product,
            'role' => UserOperations::getRoleUser(),
        ]);

    }

    public function actionHistory()
    {
        $this->view->title = 'Глобальная История';
        $product_model = new ProductModel();
        $product = $product_model->getHistory($_SESSION['user']['id']);
        $this->render('history', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product,
            'role' => UserOperations::getRoleUser(),
        ]);

    }
    public function actionImg()
    {

        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $product_model = new ProductModel();
        $product = $product_model->getProductById($product_id);
        header('Content-Type:image/png');
        readfile($_SERVER['DOCUMENT_ROOT'].$product['file_path']);
    }
}
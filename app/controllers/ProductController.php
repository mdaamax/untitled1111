<?php

namespace app\controllers;
use app\core\initController;
use app\lib\UserOperations;
use app\models\NewsModels;
use app\models\ProductModel;

class ProductController extends initController
{
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



}
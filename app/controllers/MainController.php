<?php

namespace app\controllers;
use app\core\initController;
use app\models\ProductModel;

class MainController extends initController
{
    public function actionIndex(){
        $product_model = new ProductModel();
        $product = $product_model->getListProduct();
        $this -> render('index',['product'=>$product]);
    }

    public function actionProduct(){
        $this -> render('product');
    }
}
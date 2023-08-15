<?php

namespace app\models;

use app\core\BaseModel;

class ProductModel extends BaseModel
{
    public function getListProduct()
    {
        $result = null;
        $product = $this->select('select * from product');
        if (!empty($product)) {
            $result = $product;
        }
        return $result;
    }




}
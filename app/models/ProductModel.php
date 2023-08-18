<?php

namespace app\models;

use app\core\BaseModel;

class ProductModel extends BaseModel
{

    public function add($product_data)
    {
        $result = false;
        $error_message = '';
        if (empty($product_data['title'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($product_data['price'])) {
            $error_message .= "Введите цену!<br>";
        }
        if (empty($product_data['description'])) {
            $error_message .= "Введите описание<br>";
        }
        if (empty($error_message)) {
            $result = $this->insert(
                'INSERT INTO product(title,price, description)
                        values (:title,:price, :description)',
                [
                    'title' => $product_data['title'],
                    'price' => $product_data['price'],
                    'description' => $product_data['description']
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function getListProduct()
    {
        $result = null;
        $product = $this->select('select * from product');
        if (!empty($product)) {
            $result = $product;
        }
        return $result;
    }

    public function getProductById($product_id)
    {
        $result = null;

        $product = $this -> select('select * from product where id = :id',[
            'id' => $product_id
        ]);

        if (!empty($product[0])){
            $result = $product[0];
        }
        return $result;
    }

    public function deleteById($product_id)
    {
        $result = false;
        $error_message = '';

        if (empty($product_id)){
            $error_message .= "Отсутствует идентификатор записи!<br>";
        }

        if (empty($error_message)){
            $result = $this ->delete("DELETE FROM product WHERE id = :id",
                [
                    'id' => $product_id,
                ]
            );
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function edit($product_id, $product_data)
    {
        $result = false;
        $error_message = '';

        if (empty($product_id)) {
            $error_message .= "Отсутствует инентификатор записи<br>";
        }
        if (empty($product_data['title'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($product_data['price'])) {
            $error_message .= "Введите цену!<br>";
        }

        if (empty($product_data['description'])) {
            $error_message .= "Введите описание<br>";
        }
        if (empty($error_message)){
            $result = $this -> update(
                "Update product SET title = :title ,price = :price,
                 description = :description where id = :id",
                [
                    'title' => $product_data['title'],
                    'price' => $product_data['price'],
                    'description' => $product_data['description'],
                    'id' => $product_id,
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }


}
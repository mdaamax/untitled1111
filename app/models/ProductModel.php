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
        if (empty($product_data['count'])) {
            $error_message .= "Введите количество!<br>";
        }
        if (empty($product_data['description'])) {
            $error_message .= "Введите описание<br>";
        }
        if (empty($product_data['file'])) {
            $product_data['file_path'] = '\app\web\img\default.png';
        } else{
            $product_data['file_path'] = '\app\web\img\\'.$product_data['file']['name'];
            file_put_contents($_SERVER['DOCUMENT_ROOT'].$product_data['file_path'],file_get_contents($product_data['file']['tmp_name']));
        }
        if (empty($error_message)) {
            $result = $this->insert(
                'INSERT INTO product(title,price, description,count, file_path)
                        values (:title,:price, :description,:count, :file_path)',
                [
                    'title' => $product_data['title'],
                    'price' => $product_data['price'],
                    'count' => $product_data['count'],
                    'description' => $product_data['description'],
                    'file_path' => $product_data['file_path']
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
        $product = $this->select('select * from product where id = :id', [
            'id' => $product_id
        ]);
        if (!empty($product[0])) {
            $result = $product[0];
        }
        return $result;
    }

    public function deleteById($product_id)
    {
        $result = false;
        $error_message = '';
        if (empty($product_id)) {
            $error_message .= "Отсутствует идентификатор записи!<br>";
        }
        if (empty($error_message)) {
            $result = $this->delete("DELETE FROM product WHERE id = :id",
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
        if (empty($product_data['count'])) {
            $error_message .= "Введите количество<br>";
        }
        if (empty($error_message)) {
            $result = $this->update(
                "Update product SET title = :title ,price = :price, count = :count, 
                 description = :description where id = :id",
                [
                    'title' => $product_data['title'],
                    'price' => $product_data['price'],
                    'description' => $product_data['description'],
                    'count' => $product_data['count'],
                    'id' => $product_id,
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function getProductsByID($product_ids)
    {
        $result = null;
        $product = $this->select("select * from product where id in ($product_ids)");
        if (!empty($product)) {
            $result = $product;
        }
        return $result;
    }

    public function updateCountProduct($product_id, $count)
    {
        return $this->update(
            "Update product SET count = :count 
                where id = :id",
            [
                'count' => $count,
                'id' => $product_id,
            ]
        );
    }

    public function buyProduct($price, $count, $user_id)
    {
        return $this->insert('insert into history (price,count,user_id) values (:price, :count, :user_id)', [
            'price' => $price,
            'count' => $count,
            'user_id' => $user_id
        ]);
    }

    public function getHistory($user_id = null)
    {
        $result = null;
        if (isset($user_id)){
            $product = $this->select('select history.date_create,history.price,history.count,users.login from history 
        left join users on history.user_id = users.id where user_id = :user_id',[
                'user_id'=> $user_id
            ]);
        } else{
            $product = $this->select('select history.date_create,history.price,history.count,users.login from history
                                    left join users on history.user_id = users.id');

        }
        if (!empty($product)) {
            $result = $product;
        }
        return $result;
    }
}
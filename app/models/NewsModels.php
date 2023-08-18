<?php

namespace app\models;

use app\core\BaseModel;

class NewsModels extends BaseModel
{
    public function add($news_data)
    {
        $result = false;
        $error_message = '';
        if (empty($news_data['title'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($news_data['short_description'])) {
            $error_message .= "Введите краткое описание!<br>";
        }
        if (empty($news_data['description'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($error_message)) {
            $result = $this->insert(
                'INSERT INTO news(title,short_description, description , date_create , user_id)
                        values (:title,:short_description, :description ,NOW(),:user_id)',
                [
                    'title' => $news_data['title'],
                    'short_description' => $news_data['short_description'],
                    'description' => $news_data['description'],
                    'user_id' => $_SESSION['user']['id'],
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function getListNews()
    {
        $result = null;
        $news = $this->select('select * from news');
        if (!empty($news)) {
            $result = $news;
        }
        return $result;
    }

    public function edit($news_id,$news_data)
    {
        $result = false;
        $error_message = '';

        if (empty($news_id)) {
            $error_message .= "Отсутствует инентификатор записи<br>";
        }
        if (empty($news_data['title'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($news_data['short_description'])) {
            $error_message .= "Введите краткое описание!<br>";
        }

        if (empty($news_data['description'])) {
            $error_message .= "Введите описание<br>";
        }
        if (empty($error_message)){
            $result = $this -> update(
                "Update news SET title = :title ,short_description = :short_description,
                 description = :description where id = :id",
                [
                    'title' => $news_data['title'],
                    'short_description' => $news_data['short_description'],
                    'description' => $news_data['description'],
                    'id' => $news_id,
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }



    public function getNewsById($news_id)
    {
        $result = null;

        $news = $this -> select('select * from news where id = :id',[
            'id' => $news_id
        ]);

        if (!empty($news[0])){
            $result = $news[0];
        }
        return $result;
    }


    public function deleteById($news_id)
    {
        $result = false;
        $error_message = '';

        if (empty($news_id)){
            $error_message .= "Отсутствует идентификатор записи!<br>";
        }

        if (empty($error_message)){
            $result = $this ->delete("DELETE FROM news WHERE id = :id",
            [
                'id' => $news_id,
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


}
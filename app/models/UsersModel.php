<?php

namespace app\models;

use app\core\BaseModel;

class UsersModel extends BaseModel
{
    public function addNewUser($username, $login, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert(
            "INSERT INTO users (username, login, password) VALUES (:username, :login, :password)",
            [
                'username' => $username,
                'login' => $login,
                'password' => $password
            ]
        );
    }

    public function authByLogin($login, $password)
    {
        $result = false;
        $error_message = '';
        if (empty($login)) {
            $error_message .= "Введите ваш логин<br>";
        }
        if (empty($password)) {
            $error_message .= "Введите ваш пароль<br>";
        }
        if (empty($error_message)) {
            $users = $this->select('select * from users where login = :login', [
                'login' => $login
            ]);
            if (!empty($users[0])) {
                $passwordCorrect = password_verify($password, $users[0]['password']);
                if ($passwordCorrect) {
                    $_SESSION['user']['id'] = $users[0]['id'];
                    $_SESSION['user']['username'] = $users[0]['username'];
                    $_SESSION['user']['login'] = $users[0]['login'];
                    $_SESSION['user']['is_admin'] = $users[0]['is_admin'];
                    $result = true;
                } else {
                    $error_message .= "Неверный пароль<br>";
                }
            } else {
                $error_message .= "Пользователь не найден<br>";
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function changePasswordByCurrentPassword($current_password, $new_password, $confirm_new_password)
    {
        $result = false;
        $error_massage = '';
        if (empty($current_password)) {
            $error_massage .= "Введите текущий пароль<br>";
        }
        if (empty($new_password)) {
            $error_massage .= "Введите новый пароль<br>";
        }
        if (empty($confirm_new_password)) {
            $error_massage .= "Повторите новый пароль<br>";
        }
        if ($new_password != $confirm_new_password) {
            $error_massage .= "Пароли не совпадают<br>";
        }
        if (empty($error_massage)) {
            $users = $this->select('select * from users where login =:login', [
                'login' => $_SESSION['user']['login']
            ]);
            if (!empty($users[0])) {
                $passwordCorrect = password_verify($current_password, $users[0]['password']);
                if ($passwordCorrect) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $updatePassword = $this->update('update users set password = :password where login = :login', [
                        'login' => $_SESSION['user']['login'],
                        'password' => $new_password
                    ]);
                    $result = $updatePassword;
                } else {
                    $error_massage .= "Неверный пароль<br>";
                }
            } else {
                $error_massage .= "Произошла ошибка при смене пароля<br>";
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_massage
        ];
    }

    public function getListUsers()
    {
        $result = null;
        $users = $this->select('select id, username, login, is_admin from users');
        if (!empty($users)) {
            $result = $users;
        }
        return $result;
    }

    public function addUser($username, $login, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert(
            "INSERT INTO users (username, login, password) VALUES (:username, :login, :password)",
            [
                'username' => $username,
                'login' => $login,
                'password' => $password
            ]
        );
    }

//    public function add($username,$login,$password)
//    {
//        $error_message = '';
//        if (empty($error_message)) {
//            return $this-> insert(
//                "INSERT INTO users (username, login, password) VALUES (:username, :login, :password)",
//                [
//                    'username' => $username,
//                    'login' => $login,
//                    'password' => $password
//                ]
//            );
//        }
//    }
    public function getUserById($user_id)
    {
        $result = null;
        $user = $this->select('select * from users where id = :id', [
            'id' => $user_id
        ]);
        if (!empty($user[0])) {
            $result = $user[0];
        }
        return $result;
    }

    public function edit($user_id, $user_data)
    {
        $result = false;
        $error_message = '';
        if (empty($user_id)) {
            $error_message .= "хз пока<br>";
        }
        if (empty($user_data['username'])) {
            $error_message .= "Введите наименование!<br>";
        }
        if (empty($user_data['login'])) {
            $error_message .= "Введите краткое описание!<br>";
        }
        if (empty($user_data['is_admin'])) {
            $user_data['is_admin'] = '0';
        } else {
            $user_data['is_admin'] = '1';
        }
//        if (empty($news_data['description'])) {
//            $error_message .= "Введите описание<br>";
//        }
        if (empty($error_message)) {
            $result = $this->update(
                "Update users SET username = :username ,login = :login, is_admin = :is_admin 
                 where id = :id",
                [
                    'username' => $user_data['username'],
                    'login' => $user_data['login'],
                    'id' => $user_id,
                    'is_admin' => $user_data['is_admin'],
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function deleteById($user_id)
    {
        $result = false;
        $error_message = '';
        if (empty($user_id)) {
            $error_message .= "Отсутствует идентификатор записи!<br>";
        }
        if (empty($error_message)) {
            $result = $this->delete("DELETE FROM users WHERE id = :id",
                [
                    'id' => $user_id,
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }
}
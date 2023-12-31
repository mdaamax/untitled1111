<?php

namespace app\controllers;

use app\core\initController;
use app\lib\UserOperations;
use app\models\NewsModels;
use app\models\UsersModel;

class UserController extends initController
{
    public function actionProfile()
    {
        $this ->view ->title = 'Мой профиль';
        $error_message = '';


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_change_password_form'])) {
            $current_password = !empty($_POST['current_password']) ? $_POST['current_password'] : null;
            $new_password = !empty($_POST['new_password']) ? $_POST['new_password'] : null;
            $confirm_new_password = !empty($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : null;

            $userModel = new UsersModel();
            $result_auth = $userModel -> changePasswordByCurrentPassword(
                $current_password,$new_password,$confirm_new_password
            );
            if ($result_auth['result']){
                $this->redirect('/user/profile');
            } else {
                $error_message =$result_auth['error_message'];
            }
        }
        $this -> render('profile',[
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message'=> $error_message
        ]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['login', 'registration'],
                        'roles' => [UserOperations::RoleGuest],
                        'mathCallback' => function () {
                            $this->redirect('/user/profile');
                        }
                    ],
                    [
                        'actions' => ['users'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function(){
                            $this -> redirect('/user/profile');
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionRegistration()
    {
        $this->view->title = 'Регистрация';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_registration_form'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : null;
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            if (empty($username)) {
                $error_message .= "Введите ваше имя!<br>";
            }
            if (empty($login)) {
                $error_message .= "Введите ваше логин!<br>";
            }
            if (empty($password)) {
                $error_message .= "Введите ваше пароль!<br>";
            }
            if (empty($confirm_password)) {
                $error_message .= "Введите повторный пароль!<br>";
            }
            if ($password != $confirm_password) {
                $error_message .= "Пароли не совпадают!<br>";
            }
            if (empty($error_message)) {
                $userModel = new UsersModel();
                $user_id = $userModel->addNewUser($username, $login, $password);
                if (!empty($user_id)) {
                    $this->redirect('/user/login');
                }
            }
        }
        $this->render('registration', [
            'error_message' => $error_message
        ]);
    }

    public function actionLogin()
    {
        $this->view->title = 'Авторизация ';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_login_form'])) {
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $userModel = new UsersModel();
            $result_auth = $userModel->authByLogin($login, $password);
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        }
        $this->render('login', [
            'error_message' => $error_message
        ]);
    }
    public function actionLogout()
    {
        if (isset($_SESSION['user']['id'])){
            unset($_SESSION['user']);
        }
        $params = require 'app/config/params.php';
        $this ->redirect('/'. $params['defaultController']. '/'. $params['defaultAction']);
    }


    public function actionUsers()
    {
        $this -> view ->title = 'Пользователи';

        $user_model = new UsersModel();
        $users = $user_model ->getListUsers();
        $this -> render('users',[
            'sidebar' => UserOperations::getMenuLinks(),
            'users' => $users,
            'role' => UserOperations::getRoleUser()
        ]);
    }



    public function actionAdd()
//    {
//        $this->view->title = 'Добавление позьзователя';
//        $error_message = '';
//        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_user_add_form'])) {
//            $user_data = !empty($_POST['user']) ? $_POST['user'] : null;
//            if (!empty($news_data)) {
//                $userModel = new UsersModel();
//                $result_add = $userModel->add();
//                if ($result_add['result']) {
//                    $this->redirect('/news/list');
//                } else {
//                    $error_message = $result_add['error_message'];
//                }
//            }
//        }
//        $this->render('add', [
//            'sidebar' => UserOperations::getMenuLinks(),
//            'error_message' => $error_message
//        ]);
//
//    }
    {
        $this->view->title = 'Регистрация';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_registration_form'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : null;
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            if (empty($username)) {
                $error_message .= "Введите ваше имя!<br>";
            }
            if (empty($login)) {
                $error_message .= "Введите ваше логин!<br>";
            }
            if (empty($password)) {
                $error_message .= "Введите ваше пароль!<br>";
            }
            if (empty($confirm_password)) {
                $error_message .= "Введите повторный пароль!<br>";
            }
            if ($password != $confirm_password) {
                $error_message .= "Пароли не совпадают!<br>";
            }
            if (empty($error_message)) {
                $userModel = new UsersModel();
                $user_id = $userModel->addUser($username, $login, $password);
                if (!empty($user_id)) {
                    $this->redirect('/user/users');
                }
            }
        }
        $this->render('add', [
            'error_message' => $error_message
        ]);
    }

    public function actionEdit()
    {
        $this->view->title = 'Редактирование пользователя';
        $user_id = !empty($_GET['user_id']) ? $_GET['user_id'] : null;
        $user = null;
        $error_message = '';
        if (!empty($user_id)) {
            $user_model = new UsersModel();
            $user = $user_model->getUserById($user_id);
            if (empty($user)) {
                $error_message = 'Пользователь не найдена';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_user_edit_form'])) {
            $user_data = !empty($_POST['user']) ? $_POST['user'] : null;
            if (!empty($user_data)) {
                $userModel = new UsersModel();
                $result_edit = $userModel->edit($user_id, $user_data);
                if ($result_edit['result']) {
                    $this->redirect('/user/users');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }
        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'user' => $user,
            'error_message' => $error_message
        ]);
    }
    public function actionDelete()
    {
        $this->view->title = 'Удаление юзера';
        $user_id = !empty($_GET['user_id']) ? $_GET['user_id'] : null;
        $user = null;
        $error_message = '';
        if (!empty($user_id)) {
            $user_model = new UsersModel();
            $user = $user_model->getUserById($user_id);
            if (!empty($user)) {
                $result_delete = $user_model -> deleteById($user_id);
                if ($result_delete['result']){
                    $this -> redirect('/user/users');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Пользователя нет!';
            }
        } else{
            $error_message = 'Отсутствует идентификатор записи!';
        }
        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }


}
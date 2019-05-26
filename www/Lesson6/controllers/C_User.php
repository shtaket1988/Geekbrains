<?php

include_once('models/M_User.php');
class C_User extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->title = 'Пользователь';
        $this->model = new M_User();
    }

    public function action_index()
    {
        $this->action_login();
    }

    public function action_login()
    {
        $this->views = 'views/v_user_login.php';
        $this->title .= ' -> Авторизация';
        $this->user = $this->model->checkAuth();
        if(!$this->user) {
            if ($this->IsPost()) {
                if ($this->user = $this->model->login($_POST['login'], $_POST['password'])) {
                    header('Location: ' . SITE_URL . 'user/cabinet');
                    exit();
                } else {
                    $this->error = 'Ошибка авторизации';
                }
            }
        } else {
            header('Location: ' . SITE_URL . 'user/cabinet');
            exit();
        }
    }

    public function action_cabinet()
    {
        $this->views = 'views/v_user_cabinet.php';
        $this->title .= ' -> Кабинет';
        $this->user = $this->model->checkAuth();
        if(!$this->user){
            header('Location: '.SITE_URL .'user/login');
        }
    }

    public function action_logout()
    {
        $this->model->logout();
        header('Location: '.SITE_URL .'main');
    }

    public function render()
    {
        $this->data['title'] = $this->title;
        $this->data['error'] = $this->error;
        $this->data['user'] = $this->user;
        $page = $this->Template($this->views, $this->data);
        echo $page;
    }
}
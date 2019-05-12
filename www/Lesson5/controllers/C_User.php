<?php

include_once('models/M_User.php');
class C_User extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $user;

    protected function before()
    {
        $this->title = 'Пользователь';
    }

    public function action_index()
    {
        $this->action_login();
    }

    public function action_login()
    {
        $this->views = 'views/v_user_login.php';
        $this->title .= ' -> Авторизация';
        if($this->IsPost()){
            $user = new M_User();
            if($this->user = $user->login($_POST['login'], $_POST['password'])) {
                header('Location: '.SITE_URL .'cabinet');
                exit();
            } else {
                $this->error = 'Ошибка авторизации';
            }
        }
    }

    public function action_cabinet()
    {
        $this->views = 'views/v_user_cabinet.php';
        $this->title .= ' -> Кабинет';
        $user = new M_User();
        $this->user = $user->checkAuth();
        if(!$this->user){
            header('Location: '.SITE_URL .'login');
        }
    }

    public function action_logout()
    {
        $user = new M_User();
        $user->logout();
        header('Location: '.SITE_URL .'main');
    }

    public function render()
    {
        $vars = array('title' => $this->title, 'error' => $this->error, 'user' => $this->user, 'history' => $this->history);
        $page = $this->Template($this->views, $vars);
        echo $page;
    }
}
<?php

class C_AdminMain extends C_Controller
{
    protected $title;
    protected $content;
    protected $user;
    protected $views;

    protected function before()
    {
        $this->title = 'Главная страница админка';
    }

    public function action_index()
    {
        $this->content = '';
        $this->views = 'views/v_admin_main.php';
        $user = new M_Model();
        $this->user = $user->checkAuthAdmin();
        if(!$this->user){
            header('Location: '.SITE_URL .'main');
            exit();
        }
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
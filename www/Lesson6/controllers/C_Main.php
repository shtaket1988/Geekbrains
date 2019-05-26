<?php

class C_Main extends C_Controller
{
    protected $title;
    protected $content;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->title = 'Главная страница';
        $this->model = new M_Model();
    }

    public function action_index()
    {
        $this->content = '';
        $user = new M_Model();
        $this->user = $this->model->checkAuth();
    }

    public function render()
    {
        $this->data['title'] = $this->title;
        $this->data['content'] = $this->content;
        $this->data['user'] = $this->user;
        $page = $this->Template('views/v_main.php', $this->data);
        echo $page;
    }
}
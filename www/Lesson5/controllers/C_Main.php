<?php

class C_Main extends C_Controller
{
    protected $title;
    protected $content;
    protected $user;

    protected function before()
    {
        $this->title = 'Главная страница';
    }

    public function action_index()
    {
        $this->content = '';
        $user = new M_Model();
        $this->user = $user->checkAuth();
    }

    public function render()
    {
        $vars = array('title' => $this->title, 'content' => $this->content, 'user' => $this->user, 'history' => $this->history);
        $page = $this->Template('views/v_main.php', $vars);
        echo $page;
    }
}
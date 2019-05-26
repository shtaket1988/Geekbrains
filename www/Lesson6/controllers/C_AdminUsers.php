<?php

include_once('models/M_AdminUsers.php');
class C_AdminUsers extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_AdminUsers();
        $this->user = $this->model->checkAuthAdmin();
        if(!$this->user){
            header('Location: '.SITE_URL .'main');
            exit();
        }
    }

    public function action_index()
    {
        $this->action_list();
    }

    public function action_list()
    {
        $num_rows_page = 10;
        $this->data['page'] = 1;
        if(isset($_GET['page'])){
            $this->data['page'] = $_GET['page'];
        }
        if(!$this->data['page'])
            $this->data['page'] = 1;
        $this->views = 'views/v_admin_users_list.php';
        $this->title = 'Пользователи -> Список';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['count'] = $this->model->getCount();
        $this->data['list'] = $this->model->getList($this->data['page'], $num_rows_page);
        $this->data['listtype'] = $this->model->getListType();
        $this->data['pagination'] = $this->model->getPagination($this->data['count'], $this->data['page'], $num_rows_page, SITE_URL . 'admin/users/list', '');
    }

    public function action_edit()
    {
        $this->data['page'] = 1;
        if(isset($_GET['page'])){
            $this->data['page'] = $_GET['page'];
        }
        if(!$this->data['page'])
            $this->data['page'] = 1;
        $this->views = 'views/v_admin_users_edit.php';
        $this->data['id'] = 0;
        if(isset($_GET['id'])){
            $this->data['id'] = $_GET['id'];
        }
        if($this->data['id'])
            $this->title = 'Пользователи -> Редактирование '.$this->data['id'];
        else
            $this->title = 'Пользователи -> Добавление ';

        $this->data['users'] = [];
        $this->data['users']['type'] = 'user';
        $this->data['users']['login'] = '';
        if($this->data['id']) {
            if(!$this->data['users'] = $this->model->get($this->data['id'])){
                header('Location: ' . SITE_URL . 'admin/users/list?page='.$this->data['page']);
                exit();
            }
        }

        if($this->IsPost()){
            $this->data['users']['type'] = $_POST['type'];
            $this->data['users']['login'] = $_POST['login'];
            if(!$this->data['users']['login'])
                $this->error = 'Введите логин';
            if($_POST['password']) {
                $this->data['users']['password'] = md5($_POST['password']);
                $this->data['users']['password'] = strtolower($this->data['users']['password']);
            } elseif(!$this->data['id']){
                $this->error = 'Укажите пароль';
            }
            if(!$this->error) {
                if ($this->data['id'])
                    $result = $this->model->update($this->data['users'], $this->data['id']);
                else {
                    $result = $this->model->insert($this->data['users']);
                    $this->data['id'] = $result;
                }
                if($result){
                    $this->success = 'Сохранено';
                    header('Location: ' . SITE_URL . 'admin/users/list?success='.urlencode($this->success).'&page='.$this->data['page']);
                    exit();
                }
            }
        }
        $this->data['listtype'] = $this->model->getListType();
    }

    public function action_delete()
    {
        $this->data['page'] = 1;
        if(isset($_GET['page'])){
            $this->data['page'] = $_GET['page'];
        }
        if(!$this->data['page'])
            $this->data['page'] = 1;
        if(isset($_GET['id'])){
            if($this->model->delete($_GET['id'])){
                $this->success = 'Удалено';
                header('Location: ' . SITE_URL . 'admin/users/list?success='.urlencode($this->success).'&page='.$this->data['page']);
                exit();
            }
        }
        $this->error = 'Не удалось удалить';
        header('Location: ' . SITE_URL . 'admin/users/list?error='.urlencode($this->error).'&page='.$this->data['page']);
        exit();
    }

    public function render()
    {
        $this->data['title'] = $this->title;
        $this->data['error'] = $this->error;
        $this->data['success'] = $this->success;
        $this->data['user'] = $this->user;
        $page = $this->Template($this->views, $this->data);
        echo $page;
    }
}
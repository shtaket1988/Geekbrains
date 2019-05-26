<?php

include_once('models/M_AdminCategories.php');
class C_AdminCategories extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_AdminCategories();
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
        $this->views = 'views/v_admin_categories_list.php';
        $this->title = 'Категории -> Список';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['list'] = $this->model->getList();
    }

    public function action_edit()
    {
        $this->views = 'views/v_admin_categories_edit.php';
        $this->data['id'] = 0;
        if(isset($_GET['id'])){
            $this->data['id'] = $_GET['id'];
        }
        if($this->data['id'])
            $this->title = 'Категории -> Редактирование '.$this->data['id'];
        else
            $this->title = 'Категории -> Добавление ';

        $this->data['category'] = [];
        $this->data['category']['id_parent'] = 0;
        $this->data['category']['name'] = '';
        if($this->data['id']) {
            if(!$this->data['category'] = $this->model->get($this->data['id'])){
                header('Location: ' . SITE_URL . 'admin/categories/list');
                exit();
            }
        }

        if($this->IsPost()){
            $this->data['category']['name'] = $_POST['name'];
            $this->data['category']['id_parent'] = $_POST['id_parent'];
            if(!$this->data['category']['name'])
                $this->error = 'Введите имя';
            if(!$this->error) {
                if ($this->data['id'])
                    $result = $this->model->update($this->data['category'], $this->data['id']);
                else {
                    $result = $this->model->insert($this->data['category']);
                    $this->data['id'] = $result;
                }
                if($result){
                    $this->success = 'Сохранено';
                    header('Location: ' . SITE_URL . 'admin/categories/list?success='.urlencode($this->success));
                    exit();
                } else {
                    $this->error = 'Не удалось сохранить';
                }
            }
        }
        $this->data['list'] = $this->model->getList();
    }

    public function action_delete()
    {
        if(isset($_GET['id'])){
            if($this->model->delete($_GET['id'])){
                $this->success = 'Удалено';
                header('Location: ' . SITE_URL . 'admin/categories/list?success='.urlencode($this->success));
                exit();
            }
        }
        $this->error = 'Не удалось удалить';
        header('Location: ' . SITE_URL . 'admin/categories/list?error='.urlencode($this->error));
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
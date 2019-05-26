<?php

include_once('models/M_AdminGoods.php');
class C_AdminGoods extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_AdminGoods();
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
        $this->views = 'views/v_admin_goods_list.php';
        $this->title = 'Продукты -> Список';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['count'] = $this->model->getCount();
        $this->data['list'] = $this->model->getList($this->data['page'], $num_rows_page);
        $this->data['listcategories'] = $this->model->getListCategories();
        $this->data['liststatus'] = $this->model->getListStatus();
        $this->data['pagination'] = $this->model->getPagination($this->data['count'], $this->data['page'], $num_rows_page, SITE_URL . 'admin/goods/list', '');
    }

    public function action_edit()
    {
        $this->data['page'] = 1;
        if(isset($_GET['page'])){
            $this->data['page'] = $_GET['page'];
        }
        if(!$this->data['page'])
            $this->data['page'] = 1;
        $this->views = 'views/v_admin_goods_edit.php';
        $this->data['id'] = 0;
        if(isset($_GET['id'])){
            $this->data['id'] = $_GET['id'];
        }
        if($this->data['id'])
            $this->title = 'Продукты -> Редактирование '.$this->data['id'];
        else
            $this->title = 'Продукты -> Добавление ';

        $this->data['good'] = [];
        $this->data['good']['price'] = 0;
        $this->data['good']['name'] = '';
        $this->data['good']['id_category'] = 0;
        $this->data['good']['status'] = 0;
        if($this->data['id']) {
            if(!$this->data['good'] = $this->model->get($this->data['id'])){
                header('Location: ' . SITE_URL . 'admin/goods/list?page='.$this->data['page']);
                exit();
            }
        }

        if($this->IsPost()){
            $this->data['good']['name'] = $_POST['name'];
            $this->data['good']['price'] = $_POST['price'];
            $this->data['good']['id_category'] = $_POST['id_category'];
            $this->data['good']['status'] = $_POST['status'];
            if(!$this->data['good']['name'])
                $this->error = 'Введите имя';
            if(!$this->data['good']['price'])
                $this->error = 'Укажите цену';
            if(!$this->data['good']['id_category'])
                $this->error = 'Укажите категорию';
            if(!$this->error) {
                if ($this->data['id'])
                    $result = $this->model->update($this->data['good'], $this->data['id']);
                else {
                    $result = $this->model->insert($this->data['good']);
                    $this->data['id'] = $result;
                }
                if($result){
                    $this->success = 'Сохранено';
                    header('Location: ' . SITE_URL . 'admin/goods/list?success='.urlencode($this->success).'&page='.$this->data['page']);
                    exit();
                }
            }
        }
        $this->data['listcategories'] = $this->model->getListCategories();
        $this->data['liststatus'] = $this->model->getListStatus();
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
                header('Location: ' . SITE_URL . 'admin/goods/list?success='.urlencode($this->success).'&page='.$this->data['page']);
                exit();
            }
        }
        $this->error = 'Не удалось удалить';
        header('Location: ' . SITE_URL . 'admin/goods/list?error='.urlencode($this->error).'&page='.$this->data['page']);
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
<?php

include_once('models/M_Catalog.php');
class C_Catalog extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_Catalog();
        $this->user = $this->model->checkAuth();
        $this->title = 'Каталог';
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
        $this->views = 'views/v_catalog_list.php';

        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['id_category'] = 0;
        if(isset($_GET['id_category'])){
            $this->data['id_category'] = $_GET['id_category'];
        }
        $this->data['category'] = false;

        if($this->data['id_category'])
            $this->data['category'] = $this->model->getCategory($this->data['id_category']);
        if($this->data['category'])
            $this->title = $this->data['category']['name'];
        else
            $this->data['id_category'] = 0;
        $this->data['listcategories'] = $this->model->getListCategories();
        $this->data['count'] = $this->model->getCount($this->data['id_category'], $this->data['listcategories']);
        $this->data['list'] = $this->model->getList($this->data['id_category'], $this->data['listcategories'], $this->data['page'], $num_rows_page);
        $this->data['pagination'] = $this->model->getPagination($this->data['count'], $this->data['page'], $num_rows_page, SITE_URL . 'catalog/list', '&id_category='.$this->data['id_category']);
    }

    public function action_product()
    {
        $this->views = 'views/v_catalog_product.php';
        $this->data['id'] = 0;
        if(isset($_GET['id'])){
            $this->data['id'] = $_GET['id'];
        } else {
            header('Location: ' . SITE_URL . 'admin/catalog/list');
            exit();
        }

        $this->data['product'] = $this->model->getProduct($this->data['id']);
        if(!$this->data['product']){
            header('Location: ' . SITE_URL . 'admin/catalog/list');
            exit();
        }
        $this->data['category'] = $this->model->getCategory($this->data['product']['id_category']);
        if(!$this->data['category']){
            header('Location: ' . SITE_URL . 'admin/catalog/list');
            exit();
        }
        $this->title = $this->data['product']['name'];
        $this->data['listcategories'] = $this->model->getListCategories();

        if($this->IsPost()){
            $counts = (int)$_POST['counts'];
            if($counts > 0){
                if($this->model->addInBasket($this->data['id'], $counts, $this->user)){
                    $this->success = 'Товар добавлен в корзину';
                } else {
                    $this->error = 'Не удалось добавить товар в корзину';
                }
            } else {
                $this->error = 'Количество покупаемых товаров должно быть не менее одной единицы';
            }
        }
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
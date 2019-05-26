<?php

include_once('models/M_AdminOrders.php');
class C_AdminOrders extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_AdminOrders();
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
        $this->views = 'views/v_admin_orders_list.php';
        $this->title = 'Заказы -> Список';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['count'] = $this->model->getCount();
        $this->data['list'] = $this->model->getList($this->data['page'], $num_rows_page);
        $this->data['liststatus'] = $this->model->getListStatus();
        $this->data['pagination'] = $this->model->getPagination($this->data['count'], $this->data['page'], $num_rows_page, SITE_URL . 'admin/orders/list', '');
    }

    public function action_edit()
    {
        $this->data['page'] = 1;
        if(isset($_GET['page'])){
            $this->data['page'] = $_GET['page'];
        }
        if(!$this->data['page'])
            $this->data['page'] = 1;
        $this->views = 'views/v_admin_orders_edit.php';
        $this->data['id'] = 0;
        if(isset($_GET['id'])){
            $this->data['id'] = $_GET['id'];
        }
        if($this->data['id'])
            $this->title = 'Заказы -> Редактирование '.$this->data['id'];
        else {
            header('Location: ' . SITE_URL . 'admin/orders/list?page='.$this->data['page']);
            exit();
        }

        $this->data['order'] = $this->model->getOrder($this->data['id'], $this->user);
        if(!$this->data['order']){
            header('Location: ' . SITE_URL . 'admin/orders/list?page='.$this->data['page']);
            exit();
        }
        $this->data['ordergoods'] = $this->model->getOrderGoods($this->data['id']);
        $this->data['liststatus'] = $this->model->getListStatus();

        if($this->IsPost()){
            $this->data['order']['phone'] = $_POST['phone'];
            $this->data['order']['amount'] = $_POST['amount'];
            $this->data['order']['address'] = $_POST['address'];
            $this->data['order']['id_status'] = $_POST['id_status'];
            if(!$this->data['order']['amount'])
                $this->error = 'Укажите сумму';
            if(!$this->error) {
                $result = $this->model->update($this->data['order'], $this->data['id']);
                if($result){
                    $this->success = 'Сохранено';
                    header('Location: ' . SITE_URL . 'admin/orders/edit?success='.urlencode($this->success).'&page='.$this->data['page']);
                    exit();
                } else {
                    $this->error = 'Не удалось сохранить';
                }
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
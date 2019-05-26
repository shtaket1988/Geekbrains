<?php

include_once('models/M_Orders.php');
class C_Orders extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_Orders();
        $this->user = $this->model->checkAuth();
        $this->title = 'Заказы';
    }

    public function action_index()
    {
        $this->action_list();
    }

    public function action_list()
    {
        $this->views = 'views/v_orders_list.php';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        if($this->user){
            $this->data['orders'] = $this->model->getOrders($this->user);
            $this->data['liststatus'] = $this->model->getListStatus();
        } else {
            $this->error = 'Доступ к заказам имеет только авторизованные пользователи';
            header('Location: ' . SITE_URL . '?error='.urlencode($this->error));
            exit();
        }
    }

    public function action_view()
    {
        $this->views = 'views/v_orders_view.php';
        if (isset($_GET['success'])) {
            $this->success = $_GET['success'];
        }
        if (isset($_GET['error'])) {
            $this->error = $_GET['error'];
        }
        if($this->user){
            $this->data['id'] = 0;
            if(isset($_GET['id'])){
                $this->data['id'] = $_GET['id'];
            } else {
                header('Location: ' . SITE_URL . 'orders/list');
                exit();
            }
            $this->title = 'Заказ №'.$this->data['id'];
            $this->data['order'] = $this->model->getOrder($this->data['id'], $this->user);
            if(!$this->data['order']){
                header('Location: ' . SITE_URL . 'orders/list');
                exit();
            }
            $this->data['ordergoods'] = $this->model->getOrderGoods($this->data['id']);
            $this->data['liststatus'] = $this->model->getListStatus();
        } else {
            $this->error = 'Доступ к заказам имеет только авторизованные пользователи';
            header('Location: ' . SITE_URL . '?error='.urlencode($this->error));
            exit();
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
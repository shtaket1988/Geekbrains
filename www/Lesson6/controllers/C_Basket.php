<?php

include_once('models/M_Basket.php');
class C_Basket extends C_Controller
{
    protected $views;
    protected $title;
    protected $error;
    protected $success;
    protected $user;
    protected $model;

    protected function before()
    {
        $this->model = new M_Basket();
        $this->user = $this->model->checkAuth();
        $this->title = 'Корзина';
    }

    public function action_index()
    {
        $this->data['order'] = false;
        $this->data['orders'] = ['phone'=>'','address'=>''];
        $this->views = 'views/v_basket.php';
        if(isset($_GET['success'])){
            $this->success = $_GET['success'];
        }
        if(isset($_GET['error'])){
            $this->error = $_GET['error'];
        }
        $this->data['id_basket'] = $this->model->getIdBasket($this->user);
        if($this->IsPost()) {
            if(isset($_POST['updatecounts'])) {
                $id = 0;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                if (!$id) {
                    $this->error = 'Не удалось обновить товар в корзине';
                } else {
                    $counts = (int)$_POST['counts'];
                    if ($counts > 0) {
                        if ($this->model->updateBasketProduct($counts, $id)) {
                            $this->success = 'Корзина обновлена';
                        } else {
                            $this->error = 'Не удалось обновить товар в корзине';
                        }
                    } else {
                        $this->error = 'Количество покупаемых товаров должно быть не менее одной единицы';
                    }
                }
            }
        }
        $this->data['products'] = $this->model->getBasketGoods($this->data['id_basket']);
        if(count($this->data['products'])) {
            $this->data['order'] = true;
            if($this->IsPost()) {
                if (isset($_POST['order'])) {
                    $this->data['orders']['phone'] = $_POST['phone'];
                    $this->data['orders']['address'] = $_POST['address'];
                    if($this->data['orders']['phone']){
                        if($this->model->order($this->data['id_basket'], $this->user, $this->data['products'], $this->data['orders'])){
                            $this->success = 'Заказ создан';
                            if($this->user){
                                header('Location: ' . SITE_URL . 'orders?success='.urlencode($this->success));
                            } else {
                                header('Location: ' . SITE_URL . 'catalog?success='.urlencode($this->success));
                            }
                            exit();
                        } else {
                            $this->error = 'Не удалось оформить заказ';
                        }
                    } else {
                        $this->error = 'Укажите ваш телефон при оформлении заказа';
                    }
                }
            }
        }
    }

    public function action_delete()
    {
        if(isset($_GET['id'])){
            $this->data['id_basket'] = $this->model->getIdBasket($this->user);
            if($this->model->deleteBasketGood($_GET['id'], $this->data['id_basket'])){
                $this->success = 'Удалено';
                header('Location: ' . SITE_URL . 'basket?success='.urlencode($this->success));
                exit();
            }
        }
        $this->error = 'Не удалось удалить';
        header('Location: ' . SITE_URL . 'basket?error='.urlencode($this->error));
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
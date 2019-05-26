<?php
include_once ('M_Model.php');
class M_Orders extends M_Model
{
    public function getOrders($user)
    {
        $where_data = ['id_user'=>$user['id']];
        return DB::getInstance()->Select('SELECT * FROM orders WHERE id_user=:id_user', $where_data);
    }

    public function getOrder($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM orders WHERE id=:id', $where_data);
    }

    public function getOrderGoods($id_order)
    {
        $where_data = ['id_order'=>$id_order];
        return DB::getInstance()->Select('SELECT * FROM order_goods WHERE id_order=:id_order', $where_data);
    }

    public function getListStatus()
    {
        $return = [];
        $result = DB::getInstance()->Select('SELECT * FROM order_status ORDER BY id ASC');
        foreach($result as $res){
            $return[$res['id']] = $res['name'];
        }
        return $return;
    }


}
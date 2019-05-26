<?php
include_once ('M_Model.php');
class M_AdminOrders extends M_Model
{
    public function getList($page, $num_rows_page)
    {
        return DB::getInstance()->Select('SELECT * FROM orders ORDER BY id ASC LIMIT '.(($page - 1) * $num_rows_page).','.$num_rows_page);
    }

    public function getCount()
    {
        $result = DB::getInstance()->SelectOne('SELECT COUNT(*) AS num FROM orders');
        return $result['num'];
    }

    public function getOrder($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM orders WHERE id=:id', $where_data);
    }

    public function update($data, $id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Update('orders', $data, "id=:id", $where_data);
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
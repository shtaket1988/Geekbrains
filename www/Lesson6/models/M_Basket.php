<?php
include_once ('M_Model.php');
class M_Basket extends M_Model
{
    public function getBasketGoods($id_basket)
    {
        $where_data = ['id'=>$id_basket, 'status'=>1];
        $return = DB::getInstance()->Select('SELECT goods.*, basket_goods.counts, basket_goods.id AS id_basket_goods FROM basket_goods LEFT JOIN goods ON basket_goods.id_good=goods.id  WHERE basket_goods.id_basket=:id AND goods.status=:status', $where_data);
        return $return;
    }

    public function updateBasketProduct($counts, $id)
    {
        $data = ['counts'=>$counts];
        $where_data = ['id'=>$id];
        return DB::getInstance()->Update('basket_goods', $data, "id=:id", $where_data);
    }

    public function deleteBasketGood($id, $id_basket)
    {
        $where_data = ['id'=>$id, 'id_basket'=>$id_basket];
        return DB::getInstance()->Delete('basket_goods', "id=:id AND id_basket=:id_basket", $where_data);
    }

    public function order($id_basket, $user, $products, $data)
    {
        $id_user = 0;
        if($user)
            $id_user = $user['id'];
        $amount = 0;
        foreach($products as $one){
            $amount += $one['price'] * $one['counts'];
        }
        $data['amount'] = $amount;
        $data['id_user'] = $id_user;
        $data['id_status'] = 1;
        $id_order = DB::getInstance()->Insert('orders', $data);
        if($id_order){
            foreach($products as $one){
                $data_product = ['id_order'=>$id_order, 'id_good'=>$one['id'], 'name'=>$one['name'], 'price'=>$one['price'], 'counts'=>$one['counts']];
                DB::getInstance()->Insert('order_goods', $data_product);
            }
            $where_data = ['id_basket'=>$id_basket];
            DB::getInstance()->Delete('basket_goods', "id_basket=:id_basket", $where_data);
            $where_data = ['id'=>$id_basket];
            DB::getInstance()->Delete('basket', "id=:id", $where_data);
        }
        return $id_order;
    }
}
<?php
include_once ('M_Model.php');
class M_AdminGoods extends M_Model
{
    public function getList($page, $num_rows_page)
    {
        return DB::getInstance()->Select('SELECT * FROM goods ORDER BY id ASC LIMIT '.(($page - 1) * $num_rows_page).','.$num_rows_page);
    }

    public function getCount()
    {
        $result = DB::getInstance()->SelectOne('SELECT COUNT(*) AS num FROM goods');
        return $result['num'];
    }

    public function get($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM goods WHERE id=:id', $where_data);
    }

    public function insert($data)
    {
        return DB::getInstance()->Insert('goods', $data);
    }

    public function update($data, $id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Update('goods', $data, "id=:id", $where_data);
    }

    public function delete($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Delete('goods', "id=:id", $where_data);
    }

    public function getListCategories()
    {
        $return = [];
        $result = DB::getInstance()->Select('SELECT * FROM categories ORDER BY id ASC');
        foreach($result as $res){
            $return[$res['id']] = $res;
        }
        return $return;
    }

    public function getListStatus()
    {
        $return = [];
        $result = DB::getInstance()->Select('SELECT * FROM goods_status ORDER BY id ASC');
        foreach($result as $res){
            $return[$res['id']] = $res['name'];
        }
        return $return;
    }
}
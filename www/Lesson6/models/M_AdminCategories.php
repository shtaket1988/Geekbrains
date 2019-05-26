<?php
include_once ('M_Model.php');
class M_AdminCategories extends M_Model
{
    public function getList()
    {
        return DB::getInstance()->Select('SELECT * FROM categories ORDER BY id ASC');
    }

    public function get($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM categories WHERE id=:id', $where_data);
    }

    public function insert($data)
    {
        return DB::getInstance()->Insert('categories', $data);
    }

    public function update($data, $id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Update('categories', $data, "id=:id", $where_data);
    }

    public function delete($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Delete('categories', "id=:id", $where_data);
    }
}
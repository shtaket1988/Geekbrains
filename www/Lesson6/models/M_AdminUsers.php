<?php
include_once ('M_Model.php');
class M_AdminUsers extends M_Model
{
    public function getList($page, $num_rows_page)
    {
        return DB::getInstance()->Select('SELECT * FROM users ORDER BY id ASC LIMIT '.(($page - 1) * $num_rows_page).','.$num_rows_page);
    }

    public function getCount()
    {
        $result = DB::getInstance()->SelectOne('SELECT COUNT(*) AS num FROM users');
        return $result['num'];
    }

    public function get($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM users WHERE id=:id', $where_data);
    }

    public function insert($data)
    {
        return DB::getInstance()->Insert('users', $data);
    }

    public function update($data, $id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Update('users', $data, "id=:id", $where_data);
    }

    public function delete($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->Delete('users', "id=:id", $where_data);
    }

    public function getListType()
    {
        return ['user'=>'Пользователь','admin'=>'Администратор'];
    }
}
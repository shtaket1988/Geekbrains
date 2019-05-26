<?php

class M_Model
{
    /** Проверка авторизации
     * @return bool|mixed
     */
    public function checkAuth()
    {
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        if($login and $password) {
            $row = DB::getInstance()->SelectOne('SELECT * FROM users WHERE login = :login AND password = :password', array('login' => $login, 'password' => $password));
            return $row;
        }
        return false;
    }

    /** Проверка авторизации админа
     * @return bool|mixed
     */
    public function checkAuthAdmin()
    {
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        if($login and $password) {
            $row = DB::getInstance()->SelectOne('SELECT * FROM users WHERE login = :login AND password = :password AND type = :type', array('login' => $login, 'password' => $password, 'type' => 'admin'));
            return $row;
        }
        return false;
    }

    /** Пагинация
     * @param $count
     * @param int $page
     * @param int $num_rows_page
     * @param string $url
     * @param string $query_string
     * @return string
     */
    public function getPagination($count, $page=1, $num_rows_page=1, $url='', $query_string='')
    {
        $return = '';
        $nums = ceil($count / $num_rows_page);
        if($nums > 1){
            $return .= '<div class="pagination">';
            for($i=1; $i <= $nums; $i++){
                $class = '';
                if($i == $page)
                    $class = ' class="current"';
                $return .= '<a href="'.$url.'?page='.$i.$query_string.'"'.$class.'>'.$i.'</a>&nbsp;&nbsp;&nbsp;';
            }
            $return .= '</div>';
        }
        return $return;
    }

    /** Определяем идентификатор корзины
     * @param $user
     * @return int|mixed
     */
    public function getIdBasket($user)
    {
        $id_basket = 0;
        $id_user = 0;
        if($user){
            $id_user = $user['id'];
            $row = DB::getInstance()->SelectOne('SELECT * FROM basket WHERE id_user=:id_user', array('id_user' => $id_user));
            if($row)
                $id_basket = $row['id'];
        } else {
            if($_COOKIE["basket_hash"]) {
                $row = DB::getInstance()->SelectOne('SELECT * FROM basket WHERE hash=:hash', array('hash' => $_COOKIE["basket_hash"]));
                if($row)
                    $id_basket = $row['id'];
                else
                    unset($_COOKIE["basket_hash"]);
            }
        }
        if(!$id_basket)
        {
            $hash = md5(uniqid(rand(),1));
            $data = ['id_user'=>$id_user, 'hash'=>$hash];
            $id_basket = DB::getInstance()->Insert('basket', $data);
            setcookie("basket_hash",$hash);
        }
        return $id_basket;
    }
}
<?php
include_once ('M_Model.php');
class M_User extends M_Model
{
    public function login($login='', $password='')
    {
        $password = md5($password);
        $password = strtolower($password);
        if($login and $password) {
            $row = DB::getInstance()->SelectOne('SELECT id, login FROM users WHERE login = :login AND password = :password', array('login' => $login, 'password' => $password));
            if($row) {
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        $_SESSION['login'] = '';
        $_SESSION['password'] = '';
    }
}
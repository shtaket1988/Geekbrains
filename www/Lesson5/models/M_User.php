<?php
include_once ('M_Model.php');
class M_User extends M_Model
{
    public function login($login='', $password='')
    {
        $password = md5($password);
        if($login and $password) {
            $DB = DB::getInstance();
            $user = $DB->prepare('SELECT id, login FROM users WHERE login = :login AND password = :password');
            $user->execute(array('login' => $login, 'password' => $password));
            while ($row = $user->fetch()) {
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
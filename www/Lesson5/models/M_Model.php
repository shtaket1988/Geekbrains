<?php

class M_Model
{
    public function checkAuth()
    {
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        if($login and $password) {
            $DB = DB::getInstance();
            $user = $DB->prepare('SELECT id, login FROM users WHERE login = :login AND password = :password');
            $user->execute(array('login' => $login, 'password' => $password));
            while ($row = $user->fetch()) {
                return $row;
            }
        }
        return false;
    }

    public function setHistory()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (isset($_SESSION['history'])) {
            $Array = $_SESSION['history'];
            if (count($Array)>5)
                array_pop($Array);
            array_unshift($Array, "".$uri."");
            $_SESSION['history'] = $Array;
        }
        else
        {
            $_SESSION['history'] = array(0 => $uri);
        }
    }

    public function getHistory(){
        $return = [];
        if (isset($_SESSION['history'])) {
            $return = $_SESSION['history'];
        }
        return $return;
    }
}
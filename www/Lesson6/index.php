<?php
session_start();
require_once 'include/DB.php';
function __autoload($classname){
    @include_once("controllers/$classname.php");
}

define('SITE_URL', '/Lesson6/');

$c = 'C_Main';
$a = 'index';

if(isset($_SERVER['PATH_INFO'])) {
    $url = explode('/',$_SERVER['PATH_INFO']);
    if($url[1] == strtolower('admin')){
        if($url[2])
            $c = 'C_Admin'.ucfirst(strtolower($url[2]));
        else
            $c = 'C_AdminMain';
        if($url[3])
            $a = strtolower($url[3]);
    } else {
        if ($url[1])
            $c = 'C_'.ucfirst(strtolower($url[1]));
        if ($url[2])
            $a = strtolower($url[2]);
    }
}

$page = DB::getInstance()->SelectOne('SELECT * FROM controllers WHERE controller=:controller', array('controller' => $c));
if($page){
    $controller = new $c();
    $controller->Request($a);
} else {
    header ("HTTP/1.1 404");
    exit();
}
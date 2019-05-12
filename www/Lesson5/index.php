<?php
session_start();
require_once 'include/DB.php';
function __autoload($classname){
    include_once("controllers/$classname.php");
}

define('SITE_URL', '/Lesson5/');

$DB = DB::getInstance();

$c = 'main';
$a = 'index';

if(isset($_GET['route'])) {
    $url = explode('/',$_GET['route']);
    if($url[0])
        $c = $url[0];
    if($url[1])
        $a = $url[1];
}

switch ($c)
{
    case 'user':
        $controller = new C_User();
        break;
    default:
        $controller = new C_Main();
}

$controller->Request($a);
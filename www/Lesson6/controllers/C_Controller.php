<?php

include_once('models/M_Model.php');
abstract class C_Controller
{
    protected $data = [];
    protected abstract function render();

    protected abstract function before();

    public function Request($action)
    {
        $action = 'action_'.$action;
        $this->before();
        if(!method_exists($this, $action)){
            header ("HTTP/1.1 404");
            exit();
        }
        @$this->$action();
        $this->render();
    }

    protected function Template($filename, $vars = array())
    {
        foreach ($vars as $k => $v){
            $$k = $v;
        }
        ob_start();
        include "$filename";
        return ob_get_clean();
    }

    protected  function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected  function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}
<?php

include_once('models/M_Model.php');
abstract class C_Controller
{
    protected $history;
    protected abstract function render();

    protected abstract function before();

    public function Request($action)
    {
        $model = new M_Model();
        $model->setHistory();
        $this->history = $model->getHistory();
        $action = 'action_'.$action;
        $this->before();
        $this->$action();
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
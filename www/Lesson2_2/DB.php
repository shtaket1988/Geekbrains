<?php

trait Singleton {
    private static $instance = false;

    private function __construct() {
        $this->__instance();
    }

    public static function getInstance() {
        if (self::$instance === false) {
            self::$instance = new self();
        }        
        return self::$instance;
    }
}

class DB {
    use Singleton;
    
    public function __instance() {
        DB::$instance = mysqli_connect('localhost', 'shop', '12345', 'shop', '3306');
    }
    
    public function insert($table, $data){
        /*  */
    }
    
    public function update($table, $data, $where){
        /*  */
    }
    
    public function delete($table, $where){
        /*  */
    }
}
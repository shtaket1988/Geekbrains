<?php

class DB {
    private static $connect;
    private static $db;
    
    private function __construct() {
        DB::$connect = mysqli_connect($host, $user, $password, $database, $port, $socket);
    }
    
    public static function getObject() {
        if(DB::$db === null){
            DB::$db = new DB;
        }
        return DB::$db;
    }
    
    public function delete($sql){
        /*  */
    } 
    
}

class Test {
    function test(){
        $obj = DB::getObject();
        $obj->delete('');
    }
}

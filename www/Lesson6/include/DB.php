<?php

class DB {
    private static $instance = false;
    private $db;

    private function __construct() {
        $this->db = new pdo('mysql:host=mysql; dbname=shop; charset=utf8', 'root', '12345');
    }

    public static function getInstance() {
        if (self::$instance === false) {
            self::$instance = new DB;
        }
        return self::$instance;
    }

    public function Query($query, $params = array()) {
        $res = $this->db->prepare($query);
        $res->execute($params);
        return $res;
    }

    public function Select($query, $params = array())
    {
        $result = $this->Query($query, $params);
        if($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function SelectOne($query, $params = array())
    {
        $result = $this->Query($query, $params);
        if($result) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function Update($table, $object, $where = '1', $where_data = []){
        $sets = [];
        foreach ($object as $key => $value){
            $sets[] = "$key=:$key";
            if($value==null)
                $object[$key] = 'NULL';
        }
        $sets_s = implode(",", $sets);
        $query = "UPDATE $table SET $sets_s WHERE $where";
        $q = $this->db->prepare($query);
        $object = $object + $where_data;
        $q->execute($object);
        return $q->rowCount();
    }

    public function Insert($table, $object){
        $sets = [];
        foreach ($object as $key => $value){
            $sets[] = "$key=:$key";
            if($value==null)
                $object[$key] = 'NULL';
        }
        $sets_s = implode(", ", $sets);
        $query = "INSERT IGNORE INTO $table SET $sets_s";
        $q = $this->db->prepare($query);
        $q->execute($object);
        return $this->db->lastInsertId();
    }

    public function Delete($table, $where, $where_data){
        $query = "DELETE FROM $table WHERE $where";
        $q = $this->db->prepare($query);
        $q->execute($where_data);
        return $q->rowCount();
    }
}
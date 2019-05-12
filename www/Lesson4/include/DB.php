<?php

class DB {
    private static $instance = false;

    private function __construct() {
        return $this->__instance();
    }

    public static function getInstance() {
        if (self::$instance === false) {
            new self();
        }
        return self::$instance;
    }

    public function __instance() {
        DB::$instance = new pdo('mysql:host=mysql; dbname=shop', 'root', '12345');
        if (!DB::$instance) {
            echo "Ошибка: Невозможно установить соединение с MySQL.";
            exit;
        }
    }
}
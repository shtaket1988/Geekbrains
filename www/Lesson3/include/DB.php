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
        DB::$instance = mysqli_connect('mysql', 'root', '12345', 'shop');
        if (!DB::$instance) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }
}
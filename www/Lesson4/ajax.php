
<?php
require_once 'include/DB.php';

try {
    $DB = DB::getInstance();

    $return = [];
    $return['deleteButton'] = false;
    $return['products'] = [];

    // Количество всех продуктов
    $result = $DB->query("SELECT count(*) FROM `products`");
    $count_products = $result->fetchColumn();

    $page = $_POST["page"];
    $limit = $_POST["counts"];
    $from = ($page - 1) * $limit;
    $result = $DB->query("SELECT * FROM `products` LIMIT $from, $limit");

    if($result->fetchColumn()) {
        while ($row = $result->fetch()) {
            $return['products'][] = $row;
        }
    }

    if($count_products <= ($page * $limit))
        $return['deleteButton'] = true;

    echo json_encode($return);


} catch (Exception $e){
    die ('ERROR: ' . $e->getMessage());
}
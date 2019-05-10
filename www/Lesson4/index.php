
<?php
require_once 'include/DB.php';

try {
    $DB = DB::getInstance();

    // Запрос на создание таблицы
    $rows = $DB->query("CREATE TABLE `products` (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR (128) NOT NULL DEFAULT '')
    ");


    // Вставка записей
    for($i = 1; $i <= 100; $i++) {
        $DB->query("INSERT INTO `products` VALUES (null, 'Товар $i')");
    }


    $page = 1;
    $limit = 25;
    $products = [];
    $result = $DB->query("SELECT * FROM `products` LIMIT 0, $limit");
    while($row = $result->fetch()){
        $products[] = $row;
    }


} catch (Exception $e){
    die ('ERROR: ' . $e->getMessage());
} ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Товары</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/js.js"></script>
    <script type="text/javascript">
        var counts = <?php echo $limit; ?>;
        var page = <?php echo $page; ?>;
    </script>
</head>
<body>

<h1>Товары</h1>
<div class="content">
    <div class="products" id="products">
        <?php if(count($products)){
            foreach($products as $product){ ?>
                <div class="product" id="product-<?php echo $product['id']; ?>"><?php echo $product['name']; ?></div>
            <?php }
        } ?>
    </div>
    <div class="clear"></div>
    <div class="more-products"><a href="#" id="more_products">Загрузить еще</a></div>
</div>

</body>
</html>

<?php
include("_header.php");
?>

<h1><?php echo $title; ?></h1>
<?php if($success){
    echo '<div class="success">'.$success.'</div>';
} ?>
<?php if($error){
    echo '<div class="error">'.$error.'</div>';
} ?>

<div class="content">
    Сумма: <?php echo $order['amount']; ?><br />
    Указанный телефон: <?php echo $order['phone']; ?><br/>
    Указанный адрес: <?php echo $order['address']; ?><br/>
    Дата: <?php echo $order['date_create']; ?><br/>
    Статус: <?php echo (isset($liststatus[$order['id_status']])) ? $liststatus[$order['id_status']] : '-'; ?><br />
    <?php foreach ($ordergoods as $one){ ?>
        <div class="product-one">
            Наименование товара: <?php echo $one['name']; ?><br />
            Цена: <?php echo $one['price']; ?><br />
            Количество: <?php echo $one['counts']; ?><br />
            Сумма: <?php echo $one['price'] * $one['counts']; ?><br />
        </div>
    <?php } ?>
</div>
<?php
include("_menu.php");
include("_footer.php");
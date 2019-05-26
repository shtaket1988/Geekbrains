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
    <?php if($user){
        if(count($orders)) {
            foreach ($orders as $one) { ?>
                <div class="product-one">
                    Заказ №<?php echo $one['id']; ?><br />
                    Сумма: <?php echo $one['amount']; ?><br />
                    Указанный телефон: <?php echo $one['phone']; ?><br/>
                    Указанный адрес: <?php echo $one['address']; ?><br/>
                    Дата: <?php echo $one['date_create']; ?><br/>
                    Статус: <?php echo (isset($liststatus[$one['id_status']])) ? $liststatus[$one['id_status']] : '-'; ?><br />
                    <a href="<?php echo SITE_URL; ?>orders/view?id=<?php echo $one['id']; ?>">Подробнее</a>
                </div>
            <?php }
        } else { ?>
            <div class="product-one">Заказы не обнаружены</div>
        <?php } ?>
    <?php } ?>
</div>
<?php
include("_menu.php");
include("_footer.php");
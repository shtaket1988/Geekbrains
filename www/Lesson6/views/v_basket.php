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
    <?php if($order){
        $summ = 0;
        foreach ($products as $one){
            $summ += $one['price'] * $one['counts']; ?>
            <div class="product-one">
                <form method="post" action="<?php echo SITE_URL; ?>basket?id=<?php echo $one['id_basket_goods']; ?>">
                    <input type="hidden" name="updatecounts" value="on" />
                    <div><?php echo $one['name']; ?></div>
                    Цена: <?php echo $one['price']; ?><br />
                    Количество: <input type="text" name="counts" value="<?php echo $one['counts']; ?>" /><br />
                    Сумма: <?php echo $one['price'] * $one['counts']; ?><br />
                    <input type="submit" name="submit" value="Обновить" />
                </form>
                <a href="<?php echo SITE_URL; ?>basket/delete?id=<?php echo $one['id_basket_goods']; ?>">Удалить товар из корзины.</a>
            </div>
        <?php } ?>
        <div><b>ИТОГО:</b> <?php echo $summ; ?></div>
        <h3>Оформление заказа:</h3>
        <form method="post" action="<?php echo SITE_URL; ?>basket?id=<?php echo $one['id_basket_goods']; ?>">
            <input type="hidden" name="order" value="on" />
            Ваш телефон: <input type="text" name="phone" value="<?php echo $orders['phone']; ?>" /><br />
            Адрес доставки: <input type="text" name="address" value="<?php echo $orders['address']; ?>" /><br />
            <input type="submit" name="submit" value="Оформить" />
        </form>
    <?php } else { ?>
        <div class="product-one">Товары отсутствуют в корзине.</div>
    <?php } ?>
</div>
<?php
include("_menu.php");
include("_footer.php");
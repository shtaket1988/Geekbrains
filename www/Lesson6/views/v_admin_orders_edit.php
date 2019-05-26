<?php
include("_header.php");
include("_adminmenu.php");
?>

<h1><?php echo $title; ?></h1>
<?php if($success){
    echo '<div class="success">'.$success.'</div>';
} ?>
<?php if($error){
    echo '<div class="error">'.$error.'</div>';
} ?>
<div class="content">
    <a href="<?php echo SITE_URL; ?>admin/orders/list?page<?php echo $page; ?>" style="font-size: 20px;">Назад</a><br /><br />
    <form method="post" action="<?php echo SITE_URL; ?>admin/orders/edit?id=<?php echo $id; ?>&page=<?php echo $page; ?>">
        Телефон: <input type="text" name="phone" value="<?php echo $order['phone']; ?>" /><br />
        Адрес: <input type="text" name="address" value="<?php echo $order['address']; ?>" /><br />
        Сумма: <input type="text" name="amount" value="<?php echo $order['amount']; ?>" /><br />
        Статус: <select name="id_status">
            <?php foreach($liststatus as $key=>$value){
                $selected = '';
                if($key == $order['id_status']){ $selected = ' selected'; }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            } ?>
        </select><br />
        <input type="submit" name="submit" value="Сохранить" />
    </form>
    <?php foreach ($ordergoods as $one){ ?>
        <div class="product-one">
            Ссылка на товар: <a href="<?php echo SITE_URL; ?>admin/goods/edit?id=<?php echo $one['id_good']; ?>">Ссылка</a><br />
            Наименование товара: <?php echo $one['name']; ?><br />
            Цена: <?php echo $one['price']; ?><br />
            Количество: <?php echo $one['counts']; ?><br />
            Сумма: <?php echo $one['price'] * $one['counts']; ?><br />
        </div>
    <?php } ?>
</div>

<?php
include("_footer.php");
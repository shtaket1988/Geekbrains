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
<div class="menu_catalog">
    <div style="font-size: 20px;">Меню каталога:</div>
    <?php
        foreach($listcategories[0] as $one_1){
            echo '<a href="'.SITE_URL.'catalog/list?id_category='.$one_1['id'].'">'.$one_1['name'].'</a><br />';
            if(isset($listcategories[$one_1['id']])){
                foreach($listcategories[$one_1['id']] as $one_2){
                    echo '&nbsp;&nbsp;-<a href="'.SITE_URL.'catalog/list?id_category='.$one_2['id'].'">'.$one_2['name'].'</a><br />';
                    if(isset($listcategories[$one_2['id']])){
                        foreach($listcategories[$one_2['id']] as $one_3){
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;--<a href="'.SITE_URL.'catalog/list?id_category='.$one_3['id'].'">'.$one_3['name'].'</a><br />';
                        }
                    }
                }
            }
        }
    ?>
</div>
<br /><br />
<div class="content">
    <div class="product-one">
        Категория: <?php echo $category['name']; ?><br />
        Цена: <?php echo $product['price']; ?><br />
        <form method="post" action="<?php echo SITE_URL; ?>catalog/product?id=<?php echo $id; ?>">
            <input type="hidden" name="add_basket" />
            Количество: <input type="text" name="counts" value="1" /><br />
            <input type="submit" name="submit" value="Добавить в корзину" />
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php
include("_menu.php");
include("_footer.php");
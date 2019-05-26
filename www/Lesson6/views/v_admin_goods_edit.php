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
    <a href="<?php echo SITE_URL; ?>admin/goods/list?page<?php echo $page; ?>" style="font-size: 20px;">Назад</a><br /><br />
    <form method="post" action="<?php echo SITE_URL; ?>admin/goods/edit?id=<?php echo $id; ?>&page=<?php echo $page; ?>">
        Название: <input type="text" name="name" value="<?php echo $good['name']; ?>" /><br />
        Категория: <select name="id_category">
            <?php foreach($listcategories as $one){
                $selected = '';
                if($one['id'] == $good['id_category']){ $selected = ' selected'; }
                echo '<option value="'.$one['id'].'"'.$selected.'>'.$one['name'].'</option>';
            } ?>
        </select><br />
        Цена: <input type="text" name="price" value="<?php echo $good['price']; ?>" /><br />
        Статус: <select name="status">
            <?php foreach($liststatus as $key=>$value){
                $selected = '';
                if($key == $good['status']){ $selected = ' selected'; }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            } ?>
        </select><br />
        <input type="submit" name="submit" value="Сохранить" />
    </form>
</div>

<?php
include("_footer.php");
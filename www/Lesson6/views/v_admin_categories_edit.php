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
    <a href="<?php echo SITE_URL; ?>admin/categories/list" style="font-size: 20px;">Назад</a><br /><br />
    <form method="post" action="<?php echo SITE_URL; ?>admin/categories/edit?id=<?php echo $id; ?>">
        Название: <input type="text" name="name" value="<?php echo $category['name']; ?>" /><br />
        Родительская категория: <select name="id_parent">
            <option value="0">Главная категория</option>
            <?php foreach($list as $one){
                // Проверка чтоб не льзя было выбрать самого себя
                if($id != $one['id']){
                    $selected = '';
                    if($one['id'] == $category['id_parent']){ $selected = ' selected'; }
                    echo '<option value="'.$one['id'].'"'.$selected.'>'.$one['name'].'</option>';
                }
            } ?>
        </select><br />
        <input type="submit" name="submit" value="Сохранить" />
    </form>
</div>

<?php
include("_footer.php");
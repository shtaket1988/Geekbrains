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
    <a href="<?php echo SITE_URL; ?>admin/users/list?page<?php echo $page; ?>" style="font-size: 20px;">Назад</a><br /><br />
    <form method="post" action="<?php echo SITE_URL; ?>admin/users/edit?id=<?php echo $id; ?>&page=<?php echo $page; ?>">
        Логин: <input type="text" name="login" value="<?php echo $users['login']; ?>" /><br />
        Пароль: <input type="text" name="password" value="" /><br />
        Статус: <select name="type">
            <?php foreach($listtype as $key=>$value){
                $selected = '';
                if($key == $users['type']){ $selected = ' selected'; }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            } ?>
        </select><br />
        <input type="submit" name="submit" value="Сохранить" />
    </form>
</div>

<?php
include("_footer.php");
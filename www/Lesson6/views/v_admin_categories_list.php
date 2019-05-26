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
    <a href="<?php echo SITE_URL; ?>admin/categories/edit" style="font-size: 20px;">Добавить категорию</a><br /><br />
    <table cellpadding="3" cellspacing="1" border="1">
        <thead>
            <th>ID</th>
            <th>Родительсктй ID</th>
            <th>Название</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php if($list){
                foreach($list as $one){ ?>
                    <tr>
                        <td><?php echo $one['id']; ?></td>
                        <td><?php echo $one['id_parent']; ?></td>
                        <td><?php echo $one['name']; ?></td>
                        <td><a href="<?php echo SITE_URL.'admin/categories/edit?id='.$one['id']; ?>">Редактировать</a></td>
                        <td><a href="<?php echo SITE_URL.'admin/categories/delete?id='.$one['id']; ?>">Удалить</a></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

<?php
include("_footer.php");
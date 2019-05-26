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
    <a href="<?php echo SITE_URL; ?>admin/goods/edit" style="font-size: 20px;">Добавить Товар</a><br /><br />
    <table cellpadding="3" cellspacing="1" border="1">
        <thead>
            <th>ID</th>
            <th>Категория (ID)</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Статус</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php if($list){
                foreach($list as $one){ ?>
                    <tr>
                        <td><?php echo $one['id']; ?></td>
                        <td><?php echo (isset($listcategories[$one['id_category']])) ? $listcategories[$one['id_category']]['name'] : 'Нет'; ?> (<?php echo $one['id_category']; ?>)</td>
                        <td><?php echo $one['name']; ?></td>
                        <td><?php echo $one['price']; ?></td>
                        <td><?php echo (isset($liststatus[$one['status']])) ? $liststatus[$one['status']] : '-'; ?></td>
                        <td><a href="<?php echo SITE_URL.'admin/goods/edit?id='.$one['id']; ?>&page=<?php echo $page; ?>">Редактировать</a></td>
                        <td><a href="<?php echo SITE_URL.'admin/goods/delete?id='.$one['id']; ?>&page=<?php echo $page; ?>">Удалить</a></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
    <?php echo $pagination; ?>
</div>

<?php
include("_footer.php");
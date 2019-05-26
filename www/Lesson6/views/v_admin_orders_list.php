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
    <table cellpadding="3" cellspacing="1" border="1">
        <thead>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Сумма</th>
            <th>Дата создания</th>
            <th>Статус</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php if($list){
                foreach($list as $one){ ?>
                    <tr>
                        <td><?php echo $one['id']; ?></td>
                        <td><?php echo ($one['id_user']) ? '<a href="'.SITE_URL.'admin/users/edit?id='.$one['id_user'].'">'.$one['id_user'].'</a>' : 'Нет'; ?> </td>
                        <td><?php echo $one['amount']; ?></td>
                        <td><?php echo $one['date_create']; ?></td>
                        <td><?php echo (isset($liststatus[$one['id_status']])) ? $liststatus[$one['id_status']] : '-'; ?></td>
                        <td><a href="<?php echo SITE_URL.'admin/orders/edit?id='.$one['id']; ?>&page=<?php echo $page; ?>">Просмотр</a></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
    <?php echo $pagination; ?>
</div>

<?php
include("_footer.php");
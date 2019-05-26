<?php
include("_header.php");
?>

<h1><?php echo $title; ?></h1>
<div class="content">
    <?php echo $content; ?>
    <b>Доступы:</b><br />
    Админ:<br />admin : 123
    Пользователь:<br />user : 123<br />
</div>
<?php
include("_menu.php");
include("_footer.php");
<?php
include("_header.php");
?>

<h1><?php echo $title; ?></h1>

<div class="content">
    <a href="<?php echo SITE_URL; ?>main">На главную</a><br />
    Ваш логин: <?php echo $user['login']; ?><br />
    <a href="<?php echo SITE_URL; ?>logout">Выход</a>
</div>

<?php
include("_footer.php");
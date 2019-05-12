<?php
include("_header.php");
?>

<h1><?php echo $title; ?></h1>
<div class="content">
    <?php echo $content; ?>
    <?php if($user){ ?>
        <a href="<?php echo SITE_URL; ?>user/cabinet">В кабинет</a><br />
        <a href="<?php echo SITE_URL; ?>user/logout">Выход</a>
    <?php } else { ?>
        <a href="<?php echo SITE_URL; ?>user/login">Авторизация</a>
    <?php } ?>
</div>

<div class="history">
    <h2>Блок Истории:</h2>
    <?php foreach($history as $key=>$val){
        echo '<div>- '.$val.'</div>';
    } ?>
</div>
<?php
include("_footer.php");
<?php
include("_header.php");
?>

<h1><?php echo $title; ?></h1>
<div class="content">
    <a href="<?php echo SITE_URL; ?>main">На главную</a><br />
    <form method="post">
        <?php if($error){
            echo '<div class="error">'.$error.'</div>';
        } ?>
        Логин: <input type="text" name="login" value="" /><br />
        Пароль: <input type="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Вход" />
    </form>
</div>

<div class="history">
    <h2>Блок Истории:</h2>
    <?php foreach($history as $key=>$val){
        echo '<div>- '.$val.'</div>';
    } ?>
</div>
<?php
include("_footer.php");
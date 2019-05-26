<div class="menu">
    <div style="font-size: 20px;">Меню:</div>
    <a href="<?php echo SITE_URL; ?>catalog">Каталог</a><br />
    <a href="<?php echo SITE_URL; ?>basket">Корзина</a><br />
    <?php if($user){ ?>
        <a href="<?php echo SITE_URL; ?>orders">Заказы</a><br />
        <a href="<?php echo SITE_URL; ?>user/cabinet">В кабинет</a><br />
        <a href="<?php echo SITE_URL; ?>admin">Админка</a><br />
        <a href="<?php echo SITE_URL; ?>user/logout">Выход</a>
    <?php } else { ?>
        <a href="<?php echo SITE_URL; ?>user/login">Авторизация</a>
    <?php } ?>
</div>
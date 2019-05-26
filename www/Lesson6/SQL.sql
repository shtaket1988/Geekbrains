/* Пользователи */
CREATE TABLE `users` (
id INT(11) NOT NULL AUTO_INCREMENT,
type ENUM ('user','admin') NOT NULL DEFAULT 'user',
login VARCHAR (128) NOT NULL DEFAULT '',
password VARCHAR (128) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;;

/* password md5('123') */
INSERT INTO `users` VALUES (null, 'user', 'user', '202cb962ac59075b964b07152d234b70');
INSERT INTO `users` VALUES (null, 'admin', 'admin', '202cb962ac59075b964b07152d234b70');

/* Категории */
CREATE TABLE `categories` (
id INT(11) NOT NULL AUTO_INCREMENT,
name VARCHAR (128) NOT NULL DEFAULT '',
id_parent INT(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `id_parent` (`id_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

INSERT INTO `categories` VALUES (1, 'Одежда', 0);
INSERT INTO `categories` VALUES (2, 'Обувь', 0);
INSERT INTO `categories` VALUES (3, 'Игрушки', 0);
INSERT INTO `categories` VALUES (4, 'Мужская', 1);
INSERT INTO `categories` VALUES (5, 'Женская', 1);
INSERT INTO `categories` VALUES (6, 'Детская', 1);
INSERT INTO `categories` VALUES (7, 'Мужские', 2);
INSERT INTO `categories` VALUES (8, 'Женские', 2);
INSERT INTO `categories` VALUES (9, 'Детские', 2);
INSERT INTO `categories` VALUES (10, 'Для возраста 0-3', 3);
INSERT INTO `categories` VALUES (11, 'Для возраста 4-7', 3);
INSERT INTO `categories` VALUES (12, 'Для возраста 8-14', 3);

/* Товары */
CREATE TABLE `goods` (
id INT(11) NOT NULL AUTO_INCREMENT,
name VARCHAR (128) NOT NULL DEFAULT '',
price double(10,2) NOT NULL DEFAULT '0.00',
id_category INT(11) NOT NULL DEFAULT '0',
status TINYINT NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
KEY `name` (`name`),
KEY `id_category` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

INSERT INTO `goods` VALUES (NULL, 'Одежда 1', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 2', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 3', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 4', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 5', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 6', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 7', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 8', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 9', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 10', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 11', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 12', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 13', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 14', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 15', '100.00', 4, 1);
INSERT INTO `goods` VALUES (NULL, 'Одежда 16', '100.00', 4, 1);

/* Статусы заказов */
CREATE TABLE `goods_status` (
id INT(11) NOT NULL AUTO_INCREMENT,
name varchar(64) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
INSERT INTO `goods_status` VALUES (1, 'Активная');
INSERT INTO `goods_status` VALUES (2, 'Выключена');

/* Заказы */
CREATE TABLE `orders` (
id INT(11) NOT NULL AUTO_INCREMENT,
id_user INT(11) NOT NULL DEFAULT '0',
amount double(10,2) NOT NULL DEFAULT '0.00',
phone BIGINT (15) NOT NULL DEFAULT '0',
address varchar(1024) NOT NULL DEFAULT '',
date_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
id_status TINYINT NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/* Статусы заказов */
CREATE TABLE `order_status` (
id INT(11) NOT NULL AUTO_INCREMENT,
name varchar(64) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
INSERT INTO `order_status` VALUES (1, 'Новый');
INSERT INTO `order_status` VALUES (2, 'Оплачен');
INSERT INTO `order_status` VALUES (3, 'Отменен');


/* Товары заказов */
CREATE TABLE `order_goods` (
id INT(11) NOT NULL AUTO_INCREMENT,
id_order INT(11) NOT NULL DEFAULT '0',
id_good INT(11) NOT NULL DEFAULT '0',
name VARCHAR (128) NOT NULL DEFAULT '',
price BIGINT (15) NOT NULL DEFAULT '0',
counts INT (7) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `id_order` (`id_order`),
KEY `id_good` (`id_good`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/* Корзина */
CREATE TABLE `basket` (
id INT(11) NOT NULL AUTO_INCREMENT,
id_user INT(11) NOT NULL DEFAULT '0',
hash varchar(128) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `id_user` (`id_user`),
KEY `hash` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/* Товары корзины */
CREATE TABLE `basket_goods` (
id INT(11) NOT NULL AUTO_INCREMENT,
id_basket INT(11) NOT NULL DEFAULT '0',
id_good INT(11) NOT NULL DEFAULT '0',
counts INT (7) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `id_basket` (`id_basket`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/* Страницы (контроллеры) */
CREATE TABLE `controllers` (
id INT(11) NOT NULL AUTO_INCREMENT,
controller VARCHAR(128) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `controller` (`controller`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

INSERT INTO `controllers` VALUES (null, 'C_Main');
INSERT INTO `controllers` VALUES (null, 'C_AdminMain');
INSERT INTO `controllers` VALUES (null, 'C_User');
INSERT INTO `controllers` VALUES (null, 'C_AdminCategories');
INSERT INTO `controllers` VALUES (null, 'C_AdminGoods');
INSERT INTO `controllers` VALUES (null, 'C_AdminUsers');
INSERT INTO `controllers` VALUES (null, 'C_AdminOrders');
INSERT INTO `controllers` VALUES (null, 'C_Catalog');
INSERT INTO `controllers` VALUES (null, 'C_Basket');
INSERT INTO `controllers` VALUES (null, 'C_Orders');
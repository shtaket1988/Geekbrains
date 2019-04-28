<?php
include_once 'Products.php';
include_once 'Films.php'; // Фильмы
include_once 'Coffee.php'; // Кофе, товар на вес
include_once 'DB.php'; // Работа с БД

/*
Singleton реализован в подключении к БД - DB.php
Ответ на пункт 1.д. В абстрактный класс можно вынести подсчет стоиомсти покупки, т.к. формат товаров может быть разный
*/

// Фильмы - штучный товар (диск)
$film1 = new Films(512, 3, 'Фильм №1', 'Фильм №1. Какое-то описание сюжета.', '250', '/img/film1.png', '120', 'digital');
$film1->viewProduct();
// Покупка товара
$film1->buy(1);

// Фильмы - цифровой товар (Код для просмотра в онлайн кинотеатре).
$film2 = new Films(512, 3, 'Фильм №1', 'Фильм №1. Какое-то описание сюжета.', '250', '/img/film1.png', '120', 'piece');
$film2->viewProduct();
// Покупка товара
$film2->buy(1);

//Кофе, товар на вес
$coffee = new Coffee(200, 2, 'Кофе Nescafe №1', 'Кофе Nescafe №1 - вкусный', '1500.00', '/img/kofe_1.png');
$coffee->viewProduct();
// Покупка товара, покупатель указывает количество в граммах
$coffee->buy(750);




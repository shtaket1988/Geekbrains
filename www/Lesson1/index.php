<?php
// Задачи с 1 по 4
include 'Footwear.php';
$footwear = new Footwear(1, 1, 'Сандали №1', 'Прекрасные сандали для прогулки летом', '250.00', '/img/sandali_1.png', '39, 40, 41, 42, 43', 'Белые, черные', 'Сандали');

// Блок товара, в выводе категорий
$footwear->viewProduct();

// Полное описание товара
$footwear->viewProductFull();
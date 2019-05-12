
<?php
require_once 'vendor/autoload.php';
require_once 'include/DB.php';

// Подключение к БД
$DB = DB::getInstance();
try {
    // Указываем где хранится шаблон
    $loader = new \Twig\Loader\FilesystemLoader('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    $images = array();


/* Структура таблицы
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(7) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Фото' AUTO_INCREMENT=1 ;

INSERT INTO `images` SET `id_category`=1, `name`="Фото 0", `img`="img1.jpg"
*/
    // Выборка из таблицы
    $result = mysqli_query($DB,'SELECT * FROM `images` WHERE `id_category`=1');
    while($res = mysqli_fetch_assoc($result)){
        $images[] = $res;
    }

    $images[] = array('name'=>'Фото 1', 'img'=>'img1.jpg');
    $images[] = array('name'=>'Фото 2', 'img'=>'img2.jpg');
    $images[] = array('name'=>'Фото 3', 'img'=>'img3.jpg');

    $title = 'Фотогалерея';

    // Шаблон
    $template = $twig->loadTemplate('galery.tmpl');

    // Переводим в шаблон переменные и значения
    // Выводим сформированное содержимое

    $page = $template->render(array(
        'title' => $title,
        'images' => $images
    ));
    echo $page;

} catch (Exception $e){
    die ('ERROR: ' . $e->getMessage());
}
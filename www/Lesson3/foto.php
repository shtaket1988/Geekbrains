
<?php
require_once 'vendor/autoload.php';

try {
    // Указываем где хранится шаблон
    $loader = new \Twig\Loader\FilesystemLoader('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    $title = 'Одно изображение';
    $img = 'Нет Изображения';
    if(isset($_GET['img']))
        $img = '<img src="img/'.$_GET['img'].'" />';

    // Шаблон
    $template = $twig->loadTemplate('foto.tmpl');

    // Переводим в шаблон переменные и значения
    // Выводим сформированное содержимое

    $page = $template->render(array(
        'title' => $title,
        'img' => $img
    ));
    echo $page;

} catch (Exception $e){
    die ('ERROR: ' . $e->getMessage());
}
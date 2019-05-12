<?php

include_once 'Products.php';

// Наследник Класса Products
// Отличается дополнительными параметрами а также полиморфизмом функции метода viewProductFullContent
class Footwear extends Products
{
    protected $size; // Размер
    protected $color; // Цвет
    protected $type; // Тип (сапоги / сандали / туфли и т.д.)    
    
    public function __construct($id, $id_category, $name, $description, $price, $img, $size, $color, $type) {
        parent::__construct($id, $id_category, $name, $description, $price, $img);
        $this->setSize($size);
        $this->setColor($color);
        $this->setType($type);
    }
    
    function setSize($size)
    {
        $this->size = $size;
    }
    
    function setColor($color)
    {
        $this->color = $color;
    }
            
    function setType($type)
    {
        $this->type = $type;
    }
    
    function getSize()
    {
        return $this->size;
    }
    
    function getColor()
    {
        return $this->color;
    }
    
    // контент (полное) Полиморфизам
    protected function viewProductFullContent()
    {
        echo '<div class="params_full">'.
            'Тип: '.$this->type.'<br />'.
            'Доступные размеры: '.$this->size.'<br />'.
            'Цвета: '.$this->color.'<br />'.
        '</div>';
        echo '<div class="description_full">'.$this->description.'</div>';
    }
    
}
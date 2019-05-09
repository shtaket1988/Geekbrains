<?php

// Наследник Класса Products
class Coffee extends Products
{
    public function __construct($id, $id_category, $name, $description, $price, $img) {
        parent::__construct($id, $id_category, $name, $description, $price, $img);
    }
    
    //Заменяет абстрактный класс
    public function viewPrice(){
        return $this->price . ' руб./ кг.';         
    }
    
    //Заменяет абстрактный класс подсчета цены
    public function price($count){
        return $this->price  * $count / 1000;
    }

        // контент Заменяет абстрактный класс
    public function viewProductContent()
    {
        echo '<div class="description_full">'.$this->description.'</div>';
    }
    
}
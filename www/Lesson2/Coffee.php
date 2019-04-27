<?php

// Наследник Класса Products
class GameMoney extends Products
{
    public function __construct($id, $id_category, $name, $description, $price, $img) {
        parent::__construct($id, $id_category, $name, $description, $price, $img);
    }
    
    //Заменяет абстрактный класс
    protected function viewPrice(){
        return $this->price . ' руб./ за 1 игровой руб.'
        . '<div>Внимание акция. Скидка 50% за игровую валюту</div>';         
    }
    
    //Заменяет абстрактный класс подсчета цены
    protected function price($count){
        return $this->price  * $count / 2;
    }

        // контент Заменяет абстрактный класс
    protected function viewProductContent()
    {
        echo '<div class="description_full">'.$this->description.'</div>';
    }
    
}
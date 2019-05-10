<?php

// Наследник Класса Products
class Films extends Products
{
    protected $duration; // Продолжительность видео 
    protected $type; // Тип (Электронный / штучный)    
    
    public function __construct($id, $id_category, $name, $description, $price, $img, $duration, $type) {
        parent::__construct($id, $id_category, $name, $description, $price, $img);
        $this->setDuration($duration);
        $this->setType($type);
    }
    
    function setDuration($duration)
    {
        $this->duration = $duration;
    }
    
    function setType($type)
    {
        $this->type = $type;
    }
    
    function getDuration()
    {
        return $this->duration;
    }
    
    //Заменяет абстрактный класс вывода цены
    protected function viewPrice(){
        return $this->price . ' руб.';
    }
    
    //Заменяет абстрактный класс подсчета цены
    protected function price($count)
    {
        if($this->price == 'digital')
            return $this->priceDigital($count);
        else
            return $this->pricePiece($count);
    }
    
    // цифровой/электронный вариант
    private function priceDigital($count)
    {
        return $this->price * $count / 2;
    }
    
    // штучный физический вариант
    private function pricePiece($count)
    {
        return $this->price * $count;
    }

    // контент Заменяет абстрактный класс
    protected function viewProductContent()
    {
        echo '<div class="params_full">'.
            'Продолжительность: '.$this->duration.' мин.<br />'.
            'При покупке цифровой версии, стоимость товара снижается в 2 раза.'.
        '</div>';
        echo '<div class="description_full">'.$this->description.'</div>';
    }
    
}
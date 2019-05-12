<?php
abstract class Products
{
    protected $id; // Идентификатор
    protected $id_category; // Id категории
    protected $name; // Наименование товара
    protected $description; // Id категории
    protected $price; // Цена
    protected $weight; // Вес
    protected $img; // Изображение
    protected $db; // База данных
    
    public function __construct($id, $id_category, $name, $description, $price, $img) {
        $this->setId($id);
        $this->setIdCategory($id_category);
        $this->setName($name);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setImg($img);
        $this->db = DB::getInstance();
    }
    
    function setId($id)
    {
        $this->id = $id;
    }
    
    function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }
            
    function setDescription($description)
    {
        $this->description = $description;
    }
    
    function setName($name)
    {
        $this->name = $name;
    }
    
    function setPrice($price)
    {
        $this->price = $price;
    }
    
    function setImg($img)
    {
        $this->img = $img;
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function getIdCategory()
    {
        return $this->id_category;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getDescription()
    {
        return $this->description;
    }
    
    function getPrice()
    {
        return $this->price;
    }
    
    function getImg()
    {
        return $this->img;
    }
    
    // Вывод продукта (кратко)
    function viewProduct()
    {
        $this->viewProductHeader();
        $this->viewProductContent();
        $this->viewProductFooter();
    }
    
    // Шапка
    protected function viewProductHeader()
    {
        echo '<div class="product" id="product_id_'.$this->id.'">'.
            '<div class="name"><a href="/products/'.$this->id_category.'/'.$this->id.'" class="href">'.$this->name.'</a></div>'.
            '<div class="img"><img src="'.$this->img.'" /></div>'.
            '<div class="price">'.$this->viewPrice().'</div>';
    }
    
    // контент абстрактный класс
    abstract function viewProductContent();
    
    // Подвал
    protected function viewProductFooter()
    {
        echo '</div>';
    }
    
    // Абстрактный класс вывода цены
    abstract function viewPrice();
    
    // Абстрактный класс подсчета стоимости товара с указанным количеством покупки
    abstract function price($count);
    
    // оформление покупки, $count - количество покупаемого товара
    public function buy($count){
        $price_buy = $this->price($count); // подсчет стоимости товара с указанным количеством
        $data = array(); // Массив с данными для вставки в БД
        $this->db->insert('orders', $data);
        return true;
    }
}
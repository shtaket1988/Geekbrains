<?php
class Products
{
    protected $id; // Идентификатор
    protected $id_category; // Id категории
    protected $name; // Наименование товара
    protected $description; // Id категории
    protected $price; // Цена
    protected $weight; // Вес
    protected $img; // Изображение
    
    public function __construct($id, $id_category, $name, $description, $price, $img) {
        $this->setId($id);
        $this->setIdCategory($id_category);
        $this->setName($name);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setImg($img);
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
    
    // Шапка (кратко)
    protected function viewProductHeader()
    {
        echo '<div class="product" id="product_id_'.$this->id.'">'.
            '<div class="name"><a href="/products/'.$this->id_category.'/'.$this->id.'" class="href">'.$this->name.'</a></div>'.
            '<div class="img"><img src="'.$this->img.'" /></div>'.
            '<div class="price">'.$this->price.'</div>';
    }
    
    // контент (кратко)
    protected function viewProductContent()
    {
        
    }
    
    // Подвал (кратко)
    protected function viewProductFooter()
    {
        echo '<a href="/products/'.$this->id_category.'/'.$this->id.'" class="href">Подробнее</div>'.
        '</div>';
    }
    
    function viewProductFull()
    {
        $this->viewProductFullHeader();
        $this->viewProductFullContent();
        $this->viewProductFullFooter();
    }
    
    // Шапка (полное)
    protected function viewProductFullHeader()
    {
        echo '<div class="product_full" id="product_id_'.$this->id.'">'.
            '<h1>'.$this->name.'</h1>'.
            '<div class="img_full"><img src="'.$this->img.'" /></div>'.
            '<div class="price_full">'.$this->price.'</div>';
    }
    
    // контент (полное)
    protected function viewProductFullContent()
    {
        echo '<div class="description_full">'.$this->description.'</div>';
    }
    
    // Подвал (полное)
    protected function viewProductFullFooter()
    {
        echo ''.
        '</div>';
    }
}
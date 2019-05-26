<?php
include_once ('M_Model.php');
class M_Catalog extends M_Model
{
    /** Все вложенные категории
     * @param $id_parent
     * @param $listcategory
     * @param array $return
     * @return array
     */
    private function getChild($id_parent, $listcategory, $return = [])
    {
        if(isset($listcategory[$id_parent])){
            foreach($listcategory[$id_parent] as $one){
                if(isset($listcategory[$one['id']]))
                    $return = $this->getChild($one['id'], $listcategory, $return);
                $return[] = $one['id'];
            }
        }
        return $return;
    }

    public function getListCategories()
    {
        $return = [];
        $categories = DB::getInstance()->Select('SELECT * FROM categories ORDER BY id ASC');
        foreach($categories as $one){
            $return[$one['id_parent']][] = $one;
        }
        return $return;
    }

    public function getList($id_category=0, $listcategories, $page, $num_rows_page)
    {
        $category_in = [];
        if($id_category) {
            $category_in = $this->getChild($id_category, $listcategories, []);
            $category_in[] = $id_category;
        }
        $where = '';
        $where_array = [];
        $where_data = [];
        $where_data['status'] = 1;
        if(count($category_in)){
            foreach($category_in as $key=>$val){
                $where_array[] = ":var_".$key;
                $where_data["var_".$key] = $val;
            }
            $where = ' AND id_category IN('.implode(',', $where_array).')';
        }
        return DB::getInstance()->Select('SELECT * FROM goods WHERE status=:status'.$where.' ORDER BY id ASC LIMIT '.(($page - 1) * $num_rows_page).','.$num_rows_page, $where_data);
    }

    public function getCount($id_category=0, $listcategories)
    {
        $category_in = [];
        if($id_category) {
            $category_in = $this->getChild($id_category, $listcategories, []);
            $category_in[] = $id_category;
        }
        $where = '';
        if(count($category_in)){
            $where = ' WHERE id_category IN('.implode(',', $category_in).')';
        }
        $result = DB::getInstance()->SelectOne('SELECT COUNT(*) AS num FROM goods'.$where);
        return $result['num'];
    }

    public function getProduct($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM goods WHERE id=:id', $where_data);
    }

    public function getCategory($id)
    {
        $where_data = ['id'=>$id];
        return DB::getInstance()->SelectOne('SELECT * FROM categories WHERE id=:id', $where_data);
    }

    public function addInBasket($id, $counts, $user)
    {
        $return = 0;
        $id_basket = $this->getIdBasket($user);
        $row = $this->getIdBasketProduct($id_basket, $id);
        if($row){
            $counts = $counts + $row['counts'];
            $data = ['counts'=>$counts];
            $where_data = ['id'=>$row['id']];
            $return = DB::getInstance()->Update('basket_goods', $data, "id=:id", $where_data);
        } else {
            $data = ['id_good'=>$id, 'id_basket'=>$id_basket, 'counts'=>$counts];
            $return = DB::getInstance()->Insert('basket_goods', $data);
        }
        return $return;
    }

    public function getIdBasketProduct($id_basket, $id)
    {
        $where_data = ['id_good'=>$id, 'id_basket'=>$id_basket];
        return DB::getInstance()->SelectOne('SELECT * FROM basket_goods WHERE id_good=:id_good AND id_basket=:id_basket', $where_data);
    }
}
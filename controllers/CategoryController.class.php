<?php
class CategoryController{ 

 public function getCategory(){
        $v = new Views( "category", "header" );
        $v->assign("current", "category");
        $category = new Category();

        $u= $category->getAllBy(["status_category" => "1","id_CategoryType"=>"1"] , ["id_category, description_category"], 3);
        
        $article = new Article();
        $inner = array(
            'inner_table' => ['category c'],
            'inner_column' => ['a.id_Category'],
            'inner_ref_to' => ['c.id_category']
        );
        $a= $article->getAllBy(["status" => "1"] , ["id","name","image", "minidescription","dateparution", "c.description_category"], 3, $inner);

        $v->assign( "a", $a );
        $v->assign( "u", $u );
        
    }

}
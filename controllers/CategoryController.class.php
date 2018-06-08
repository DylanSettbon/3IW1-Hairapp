<?php
class CategoryController{ 

 public function getCategory(){
        $v = new Views( "category", "header" );
        $v->assign("current", "category");
        $category = new Category();

        $u= $category->getAllBy(["status" => "-1"] , ["id, description"], 4);
        $v->assign( "u", $u );
        
    }

  public function getArticle(){
        $v = new Views( "articleCategory", "header" );
        $v->assign("current", 'articleCategory');
        $article = new Article();
        $cat=$_POST['category'];
        
        if ($cat == " "){
        	$u= $article->getAllBy(["status" => "1"] , ["id,name,image, minidescription,dateparution"], 2);
        }else{
        	$u= $article->getAllBy(["status" => "1" , "id_Category" => $cat] , ["id,name,image, minidescription,dateparution"], 3);
            
        }

        

        $v->assign( "u", $u );
    }
}
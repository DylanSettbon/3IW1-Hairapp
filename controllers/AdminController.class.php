<?php
class AdminController{

    public function getAdmin(){
        $v = new Views( "admin", "admin_header" );
    }

    public function getUserAdmin(){
        $v = new Views( "userAdmin", "admin_header" );
        $user = new User();

        $u= $user->getAllBy(["status" => "-1"] , ["firstname , lastname , email , status , tel"]);
        
        $v->assign( "u", $u );
       
        
    }

    public function getContentAdmin(){
        $v = new Views( "contentAdmin", "admin_header" );
    }

    public function saveCategoryPackage(){

        $category = new Category();
        $category->setDescription($_POST['categorie']);
        $category->setIdUser(1);
        $category->setIdCategoryType(3);
        $category->updateTable();
        $v = new Views( 'contentAdmin', "admin_header" );
    }

    public function getPagesAdmin(){
        $v = new Views( 'contentAdmin', "admin_header" );
    }

    public function modifyUser(){

    }

    public function deleteUser(){

    }

    public function addUser(){

    }
}
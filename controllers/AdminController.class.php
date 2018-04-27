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
        $v = new Views( "packageAdmin", "admin_header" );
    }

    public function getPackageAdmin(){
        $v = new Views( 'packageAdmin', "admin_header" );
    }

    public function saveCategoryPackage(){

        $category = new Category();
        $category->setDescription($_POST['categorie']);
        $category->setIdUser(1);
        $category->setIdCategoryType(3);
        $category->updateTable();
        $v = new Views( 'packageAdmin', "admin_header" );
    }

    public function getPagesAdmin(){
        $v = new Views( 'pageAdmin', "admin_header" );


    }

    public function getPageEdit(){
        $v = new Views( 'pagesAdminEdit', "admin_header" );
    }

    public function addPages(){

        $page = new Pages();
        $page->setContent( $_POST['content'] );
        $page->setTitle( $_POST['title'] );
        $page->setIsNavbar( $_POST['isNavbar'] );
        $page->setUrl( $_POST['url'] );

        $page->updateTable(
            [
                "title" => $page->getTitle(),
                "content" => $page->getContent() ,
                "isNavbar" => $page->getisNavbar(),
                "url" => $page->getUrl()
            ]
        );

        //header("Location: ")
    }

    public function modifyUser(){

    }

    public function deleteUser(){

    }

    public function addUser(){

    }
}
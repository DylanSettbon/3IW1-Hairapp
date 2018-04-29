<?php
class AdminController{


    //Partie d'administration globale
    public function getAdmin(){
        $v = new Views( "admin", "admin_header" );
        $v->assign("current", 'dashboard');
    }

    public function getUserAdmin(){
        $v = new Views( "userAdmin", "admin_header" );
        $v->assign("current", 'users');
        $user = new User();

        $u= $user->getAllBy(["status" => "-1"] , ["firstname , lastname , email , status , tel"], 4);

        $v->assign( "u", $u );
    }

    public function getContentAdmin(){
        $v = new Views( "packageAdmin", "admin_header" );
        $v->assign("current", 'content');
    }

    //Partie de gestion des forfaits
    public function getPackageAdmin(){
        $v = new Views( 'packageAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'packages');
    }

    public function saveCategoryPackage(){
        $category = new Category();
        $category->setDescription($_POST['categorie']);
        $category->setIdUser(1);
        $category->setIdCategoryType(3);
        $category->updateTable(
            [
                "description" => $category->getDescription(),
                "id_User" => $category->getIdUser() ,
                "id_CategoryType" => $category->getIdCategoryType()
            ]
        );
    }

    public function savePackage(){

    }

    //Partie de gestion des nouvelles pages créés
    public function getPagesAdmin(){
        $v = new Views( 'pageAdmin', "admin_header" );
        $v->assign("current_sidebar", 'pages');
        $v->assign("current", 'content');
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

    //Partie de gestion des users
    public function modifyUser(){

    }

    public function deleteUser(){

    }

    public function addUser(){

    }
}
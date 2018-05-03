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

        $page = new Pages();
        $pages = $page->getAllBy( null, null, 3 );
        $v->assign("pages", $pages );
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
        $page->setActive( 1 );

        if( $_POST['isModify']  ){
            $page->setId( $_POST['pageId'] );
            $page->updateTable(
                [
                    "title" => $page->getTitle(),
                    "content" => $page->getContent() ,
                    "isNavbar" => $page->getisNavbar(),
                    "url" => $page->getUrl(),
                    "active" => $page->getActive()
                ],
                [
                    "id" => $page->getId()
                ]
            );
        }
        else{
            $page->updateTable(
                [
                    "title" => $page->getTitle(),
                    "content" => $page->getContent() ,
                    "isNavbar" => $page->getisNavbar(),
                    "url" => $page->getUrl(),
                    "active" => $page->getActive()
                ]
            );
        }



        header("Location: getPagesAdmin");
    }

    //Partie de gestion des users
    public function modifyUser(){

    }

    public function deleteUser(){

    }

    public function addUser(){

    }

    public function modifyPages(){
        // modification des pages
        $page = new Pages();
        $pages = $page->getAllBy( ['id' => $_GET['id'] ], null, 3 );

        $v = new Views( 'pagesAdminEdit', "admin_header" );
        $v->assign("page_id", $pages[0]->getId() );
        $v->assign("page_title", $pages[0]->getTitle() );
        $v->assign("page_content", $pages[0]->getContent() );
        $v->assign("page_url", $pages[0]->getUrl() );
        $v->assign("page_navbar", $pages[0]->getisNavbar() );
        $v->assign("modify", true );
        // render sur la pageAdminEdit

    }
}
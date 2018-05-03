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

        $u= $user->getAllBy(["status" => "-1"] , ["id, firstname , lastname , email , status , tel"], 4);

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
        
        $user = new User();
        $a = $_GET['id'];
        $u = $user->getUpdate("id = ".$a."", 2, "id, firstname , lastname , email , status , tel");
        $v = new Views( "modifyAdmin", "admin_header" );
        $v->assign("current", 'users');
        $v->assign( "u", $u);
    }

    public function modify(){
        $user = new User();
        $user->setId($_POST['id']);
        $user->setFirstname($_POST['prenom']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setTel( $_POST['tel'] );
        $user->setStatus( $_POST['status']);

        $user->getUpdate("id = ".$user->getId()."", 1, "firstname = '".$user->getFirstname()."', lastname = '".$user->getLastname().  "', email = '".$user->getEmail()."',  status = ".$user->getStatus().", tel = ".$user->getTel()."");
        $this->getUserAdmin();

    } 

    public function deleteUser(){
        $user = new User();
        $a = $_GET['id'];
        $user->getUpdate("id = ".$a."", 1, "status = '-1'");
        $this->getUserAdmin();
    }

    public function delete(){
        $user = new User();
        $a = $_GET['id'];
        $user->getUpdate("id = ".$a."", 3, " ");
        $this->getUserAdmin();
    }

    public function addUser(){
        $v = new Views( "signin", "header" );
        $v->assign("current", 'user');
    }

    public function add(){
        $user = new User();
        $user->setFirstname($_POST['prenom']);
        $user->setLastname($_POST['nom']);
        $user->setEmail($_POST['email']);
        $user->setPwd($_POST['pwd']);
        $user->setToken();
        $user->setTel( $_POST['tel'] );
        $user->setDateInserted( date( "Y-m-d") );
        $user->setDateUpdated( date( "Y-m-d") );
        if( $_POST['offers'] == 'on' ){
            $user->setReceivePromOffer(true);
        }
        else{
            $user->setReceivePromOffer(false);
        }
        $user->getUpdate(" ", 4, "(firstname, lastname, email, pwd, token, tel, receivePromOffer, status, dateInserted, dateUpdated) VALUES ('".$user->getFirstname()."', '".$user->getLastname()."', '".$user->getEmail()."', '".$user->getPwd()."', '".$user->getToken()."', '".$user->getTel()."', '".$user->getReceivePromOffer()."', '0', '".$user->getDateInserted()."', '".$user->getDateUpdated()."')");
        $this->getUserAdmin();
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
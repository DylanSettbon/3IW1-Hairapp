<?php
class AdminController{


    //Partie d'administration globale
    public function getAdmin(){
        $v = new Views( "admin", "admin_header" );
        $v->assign("current", 'dashboard');
    }

    public function getUserAdmin(){
        $v = new Views( "userAdmin", "admin_header" );
        $arrayStatus= array("-1"=>"Supprimer","0"=> "Utilisateur", "1"=>"Coiffeur","2"=>"Admin");
        $v->assign("current", 'users');
        $user = new User();

        $u= $user->getAllBy(["status" => "-1"] , ["id, firstname , lastname , email , status , tel"], 4);
        $v->assign( "u", $u );
        $v->assign("arrayStatus",$arrayStatus);
    }

    public function getContentAdmin(){
        $v = new Views( "packageAdmin", "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'packages');
    }

    //Partie de gestion des forfaits
    public function getPackageAdmin(){
        $v = new Views( 'packageAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'packages');

        $category = new Category();
        $categories = $category->getAllBy(['id_CategoryType' => '3', 'status' => '1'],null,3);
        $v->assign("categories", $categories);

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();
        $v->assign('packages',$packages);
    }

    public function saveCategoryPackage()
    {
        if ($_POST['categoryPackageSubmit'] == 'Valider') {
            if (!isset($_POST['categoryId'])) {
                //Construction de l'objet
                $category = new Category();

                $category->setDescription($_POST['categoryDesc']);
                //Recuperer id user
                $category->setIdUser(1);
                $category->setIdCategoryType(3);

                if(!$category->checkIfCategoryDescriptionExistsAndNotNull(2)) {
                    $category->updateTable(
                        [
                            "description" => $category->getDescription(),
                            "id_User" => $category->getIdUser(),
                            "id_CategoryType" => $category->getIdCategoryType()
                        ]);

                }

                if ($category->checkIfCategoryDescriptionExistsAndNotNull(0)) {
                    $category->updateTable(
                        ["status" => '1'],
                        ["description" => $category->getDescription()]
                    );
                } else if($category->checkIfCategoryDescriptionExistsAndNotNull(1)){
                    echo '<span style="background-color: red;">Catégorie déja existante</span>';
                }
            }

            else {
            $category = new Category();
            $category->setId($_POST['categoryId']);
            $category->setDescription($_POST['categoryDesc']);
            //Recuperer id user
            $category->setIdUser(1);
            $category->setIdCategoryType(3);
            $category->updateTable(
                ["description" => $category->getDescription()],
                ["id" => $category->getId()]);
        }}

        $this->getPackageAdmin();
    }

    public function savePackage(){
        if($_POST['packageSubmit'] == 'Valider') {
            if(!isset($_POST['packageId'])) {
                $package = new Package();
                $package->setDescription($_POST['description']);
                $package->setPrice($_POST['price']);
                $package->setDuration($_POST['duration']);
                $package->setIdCategory($_POST['categoryId']);
                $package->setIdUser(1);
                $package->updateTable(
                    [
                        "description" => $package->getDescription(),
                        "price" => $package->getPrice(),
                        "duration" => $package->getDuration(),
                        "id_User" => $package->getIdUser(),
                        "id_Category" => $package->getIdCategory()
                    ]
                );
            }
            else{
                $package = new Package();
                $package->setId($_POST['packageId']);
                $package->setDescription($_POST['description']);
                $package->setPrice($_POST['price']);
                $package->setDuration($_POST['duration']);
                $package->setIdCategory($_POST['categoryId']);
                $package->setIdUser(1);
                $package->updateTable(
                        ["description" => $package->getDescription(),
                        "price" => $package->getPrice(),
                        "duration" => $package->getDuration()],
                    ["id" => $package->getId()]
                );
            }
        }
        $this->getPackageAdmin();
    }

    public function deleteCategoryPackage(){
        $category = new Category();
        $category->setId($_GET['id']);
        $category->updateTable(
            ["status" => 0],
            ["id" => $category->getId()]);
        $this->getPackageAdmin();
    }

    public function ajaxDeletePackage(){
        foreach($_POST['idPackageDeleted'] as $id){
            $package = new Package();
            $package->delete(['id' => $id]);
            echo 'ok';
        }
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
        $v->assign("current_sidebar", 'pages');
        $v->assign("current", 'content');
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
        $array = array("0"=> "Utilisateur", "1"=>"Coiffeur","2"=>"Admin");
        $u = $user->getAllBy(["id" => $a] , ["id, firstname , lastname , email , status , tel"], 2);
        $v = new Views( "modifyAdmin", "admin_header" );
        $v->assign("current", 'users');
        $v->assign( "u", $u);
        $v->assign("array", $array);
    }

    public function modify(){
        $user = new User();
        $user->setId(htmlentities($_POST['id']));
        $user->setFirstname(htmlentities($_POST['prenom']));
        $user->setLastname(htmlentities($_POST['lastname']));
        $user->setEmail(htmlentities($_POST['email']));
        $user->setTel(htmlentities( $_POST['tel'] ));
        $user->setStatus( htmlentities($_POST['status']))   ;

       // $user->getUpdate("id = ".$user->getId()."", 1, "firstname = '".$user->getFirstname()."', lastname = '".$user->getLastname().  "', email = '".$user->getEmail()."',  status = ".$user->getStatus().", tel = ".$user->getTel()."");

        $user->updateTable(["firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname() ,
                "email" => $user->getEmail(),
                "tel" => $user->getTel(), 
                "status" => $user->getStatus()],["id"=>$user->getId()]
            );
        $this->getUserAdmin();

    } 

    public function deleteUser(){
        $user = new User();
        $a = $_GET['id'];
        //$user->getUpdate("id = ".$a."", 1, "status = '-1'");
        $user->updateTable(["status"=>"-1"],["id"=>$a]);
        $this->getUserAdmin();
    }

    public function delete(){
        $user = new User();
        $a = $_GET['id'];
        //$user->getUpdate("id = ".$a."", 3, " ");
        $user->delete(['id' => $a]);
        $this->getUserAdmin();
    }

    public function addUser(){
        $array = array("0"=> "Utilisateur", "1"=>"Coiffeur","2"=>"Admin");
        $v = new Views( "addAdmin", "header" );
        $v->assign("current", 'user');
        $v->assign("array", $array);

    }

    public function add(){
        $user = new User();
        $user->setFirstname(htmlentities($_POST['prenom']));
        $user->setLastname(htmlentities($_POST['nom']));
        $user->setEmail(htmlentities($_POST['email']));
        $user->setToken();
        $user->setTel(htmlentities( $_POST['tel'] ));
        $user->setStatus(htmlentities( $_POST['status'] ));
        
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a{$x}, $i++);
        
        //$user->getUpdate(" ", 4, "(firstname, lastname, email, pwd, token, tel, status) VALUES ('".$user->getFirstname()."', '".$user->getLastname()."', '".$user->getEmail()."', '".$s."', '".$user->getToken()."', '".$user->getTel()."', '".$user->getStatus()."')");
        $user->updateTable(["firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname() ,
                "email" => $user->getEmail(),
                "tel" => $user->getTel(), 
                "status" => $user->getStatus(), 
                "token" =>$user->getToken(), 
                "pwd"=>$s]);
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

    public function deletePages(){

        $page = new Pages();
        $page->updateTable(
            [
                "active" => 0
            ],
            [
                'id' => $_GET['id']
            ]
        );

        self::getPagesAdmin();
    }

    public function activatePages(){
        $page = new Pages();
        $page->updateTable(
            [
                "active" => 1
            ],
            [
                'id' => $_GET['id']
            ]
        );

        self::getPagesAdmin();
    }

    //Affiche un Article
    public function getArticleAdmin(){
        $v = new Views( "articleAdmin", "admin_header" );
        $v->assign("current", 'users');
        $article = new Article();
        $category = new Category();
        $array = array("0"=> "En cours de parution", "1"=>"Paru");
        //$a= $article->getUpdate("status!= '-1' ORDER BY dateparution DESC" , 2, "id, name , dateparution , description, status, id_Category ");
        //$b = $category->getUpdate(" ", 2, "id, description");
        $a= $article->getAllBy(["status" => "-1"] , ["id, name , dateparution , description , status , id_Category"], 4);
        $b=$category->getAllBy([],["id,description"],2);
        $v->assign( "a", $a );
        $v->assign( "b", $b);
        $v->assign( "array",$array);
    }

    //Modifier Article
    public function modifyArticle(){
        
        $article = new Article();
        $category = new Category();
        //$a = $article->getUpdate("id = ".$_GET['id']."", 2, "id, name , dateparution , description, id_Category ");
        //$b = $category->getUpdate(" ", 2, "id, description");
        $a=$article->getAllBy(["id" => $_GET['id']] , ["id, name , dateparution , description , id_Category"], 2);
        $b=$category->getAllBy([],["id,description"],2);
        $v = new Views( "modifyArticleAdmin", "admin_header" );
        $v->assign("current", 'users');
        $v->assign( "a", $a);
        $v->assign( "b", $b);
    }

    public function modifyAdminArticle(){
        $article = new Article();
        $article->setId(htmlentities($_POST['id']));
        $article->setName(htmlentities($_POST['name']));
        $article->setDateParution(htmlentities($_POST['dateparution']));
        $article->setDescription(htmlentities($_POST['description']));
        $article->setImage(htmlentities($_POST['image']));
        $article->setCategory(htmlentities($_POST['category']));

        //$article->getUpdate("id = ".$article->getId()."", 1, "name = '".$article->getName()."', dateparution = '".$article->getDateParution().  "', description = '".$article->getDescription()."', image = '".$article->getImage()."', id_Category = ".$article->getCategory()." ");
        $article->updateTable(["name" => $article->getName(),
                "dateparution" => $article->getDateParution() ,
                "description" => $article->getDescription(),
                "image" => $article->getImage(), 
                "id_Category" => $article->getCategory()],["id"=>$article->getId()]);
        $this->getArticleAdmin();

    } 
    //Supprimer Article
    public function deleteArticle(){
        $article = new Article();
        $a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '-1'");
        $article->updateTable(["status"=>"-1"],["id"=>$a]);
        $this->getArticleAdmin();
    }

    public function parutionArticle(){
        $article = new Article();
        $a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '1' , dateparution=DATE( NOW())");
        $article->updateTable(["status"=>"1","dateparution"=>DATE('Y-m-d')],["id"=>$a]);
        $this->getArticleAdmin();
    }
    //Ajouter un article
    public function addArticle(){
        $v = new Views( "addArticleAdmin", "admin_header" );
         $category = new Category();
         //$b = $category->getUpdate(" ", 2, "id, description");
         $b=$category->getAllBy([],["id,description"],2);
        $v->assign("current", 'article');
        $v->assign( "b", $b);
    }

    public function addAdminArticle(){
        $article = new Article();
        $article->setName(htmlentities($_POST['name']));
        $article->setDescription(htmlentities($_POST['description']));
        $article->setImage(htmlentities($_POST['image']));
        $article->setCategory(htmlentities($_POST['category']));
        
        
        //$article->getUpdate(" ", 4, "(name, dateparution, description, image, status, minidescription, id_Category) VALUES ('".$article->getName()."',DATE( NOW() ), '".$article->getDescription()."', '".$article->getImage()."', 0, '".substr($article->getDescription(), 0,19)."', '".$article->getCategory()."')");
        $article->updateTable(["name" => $article->getName(),
                "dateparution" => DATE('Y-m-d'),
                "description" => $article->getDescription(),
                "image" => $article->getImage(),
                "status" => 0,
                "minidescription" => substr($article->getDescription(), 0,19), 
                "id_Category" => $article->getCategory()]);
        $this->getArticleAdmin();
    }
    public function getCategoryAdmin(){
        $v = new Views( "categoryAdmin", "admin_header" );
        $v->assign("current", 'category');
        $category = new Category();

        $u= $category->getAllBy(["status" => "-1"] , ["id, description"], 4);

        $v->assign( "u", $u );
    }
    public function addCategory(){
        $v = new Views( "addCategory", "admin_header" );
         $category = new Category();
        $v->assign("current", 'category');
    }

    public function addAdminCategory(){
        $category = new Category();
        $category->setDescription(htmlentities($_POST['description']));
        
       // $category->getUpdate(" ", 4, "(description) VALUES ('".$category->getDescription()."')");
        $category->updateTable(["description" => $category->getDescription()]);
        $this->getCategoryAdmin();
    }
    public function modifyCategory(){
        
        $category = new Category();
        //$a = $category->getUpdate("id = ".$_GET['id']."", 2, "id, description");
        $a= $category->getAllBy(["id"=>$_GET['id']],["id, description"], 2);
        $v = new Views( "modifyCategory", "admin_header" );
        $v->assign("current", 'category');
        $v->assign( "a", $a);
    }

    public function modifyAdminCategory(){
        $category = new Category();
        $category->setId(htmlentities($_POST['id']));
        $category->setDescription(htmlentities($_POST['description']));
    

        //$category->getUpdate("id = ".$category->getId()."", 1, "description = '".$category->getDescription()."'");
        $category->updateTable(["description"=>$category->getDescription()],["id"=>$category->getId()]);
        $this->getCategoryAdmin();

    } 
    public function deleteCategory(){
        $category = new Category();
        $a = $_GET['id'];
        //$category->getUpdate("id = ".$a."", 1, "status = '-1'");
        $category->updateTable(["status"=>"-1"],["id"=>$a]);
        $this->getCategoryAdmin();
    }


}
<?php
class AdminController{


    //Partie d'administration globale
    public function getAdmin(){

        $week = self::getWeek();
        $extremums = self::getExtemum();

        $planning = new Appointment();

        $between = [
            //"dateAppointment >= :min AND dateAppointment <= :max ",
            "min" => $extremums[0],
            'max' => $extremums[4],
        ];

        $inner = array(
            'inner_table' => ['user u'],
            'inner_column' => ['id_User'],
            'inner_ref_to' => ['u.id']
        );


        $appointments = $planning->getAllBy( null,
            ['dateAppointment', 'hourAppointment', 'id_User', 'id_Hairdresser', 'id_Package', 'u.firstname' , 'u.lastname'], 3, $inner);


        $v = new Views( "admin", "admin_header" );
        $v->assign("current", 'dashboard');

        $v->assign("appointments", $appointments );
        $v->assign("week", $week );
    }

    public function getUserAdmin(){
        $v = new Views( "userAdmin", "admin_header" );
        $arrayStatus = array("-1"=>"Supprimer", "0"=> "Utilisateur non actif", "1"=> "Utilisateur actif", "2"=>"Coiffeur","3"=>"Admin");
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

    public function getAppointmentAdmin(){
        $v = new Views( 'appointmentAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'articles');

        $appointment = new Appointment();
        $inner = ['inner_table' => ['user u1','user u2','package p'],
                  'inner_column' => ['id_User','id_Hairdresser','id_Package'],
                  'inner_ref_to' => ['u1.id','u2.id','p.id']];

        $appointments = $appointment->getAllBy(null,['appointment.id',
                                                            'dateAppointment',
                                                            'hourAppointment',
                                                            'CONCAT(u1.firstname," ",u1.lastname) as id_User',
                                                            'CONCAT(u2.firstname," ",u2.lastname) as id_Hairdresser',
                                                            'p.description as id_Package'],3,$inner);

        $v->assign("appointments", $appointment->sortOnDate($appointments));
    }

    public function saveCategoryPackage()
    {
        if ($_POST['categoryPackageSubmit'] == 'Valider') {
            $category = new Category();
            $category->setDescription($_POST['categoryDesc']);
            $category->setIdUser($_SESSION['id']);
            $category->setIdCategoryType(3);


            if (!isset($_POST['categoryId'])) {
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
            $category->setId($_POST['categoryId']);
            $category->updateTable(
                ["description" => $category->getDescription()],
                ["id" => $category->getId()]);
        }}

        $this->getPackageAdmin();
    }

    public function savePackage(){
        if($_POST['packageSubmit'] == 'Valider') {
            $package = new Package();
            $package->setDescription($_POST['description']);
            $package->setPrice($_POST['price']);
            $package->setDuration($_POST['duration']);
            $package->setIdCategory($_POST['categoryId']);
            $package->setIdUser($_SESSION['id']);
            if($package->checkIfPackageExistsOrIsNull()){
                if (!isset($_POST['packageId'])){
                    $package->updateTable(
                        [
                            "description" => $package->getDescription(),
                            "price" => $package->getPrice(),
                            "duration" => $package->getDuration(),
                            "id_User" => $package->getIdUser(),
                            "id_Category" => $package->getIdCategory()
                        ]
                    );
                } else {
                    $package->setId($_POST['packageId']);
                    $package->updateTable(
                        ["description" => $package->getDescription(),
                            "price" => $package->getPrice(),
                            "duration" => $package->getDuration()],
                        ["id" => $package->getId()]
                    );
                }
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
        //Modifier fonction pour where in
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
        //var_dump( "ok" ); die;
        $v->assign("current_sidebar", 'pages');
        $v->assign("current", 'content');
    }

    public function addPages(){
        $contents = [];



        if( isset( $_POST['content1'] ) ){
            $contents['content1'] = $_POST['content1'];
        }
        if( isset( $_POST['content2'] ) ){
            $contents['content2'] = $_POST['content2'];
        }
        if( isset( $_POST['content3'] ) ){
            $contents['content3'] = $_POST['content3'];
        }
        if( isset( $_POST['content4'] ) ){
            $contents['content4'] = $_POST['content4'];
        }
        if( isset( $_POST['content5'] ) ){
            $contents['content5'] = $_POST['content5'];
        }
        if( isset( $_POST['content6'] ) ){
            $contents['content6'] = $_POST['content6'];
        }
        $page = new Pages();

        $page->setTitle( $_POST['title'] );
        $page->setIsNavbar( $_POST['isNavbar'] );
        $page->setUrl( $_POST['url'] );
        $page->setActive( 1 );
        $content = $page->joinContents( $contents );
        //var_dump( $content ); die;
        $page->setContent( $content );
        $page->setIdTemplate( $_POST['id_template'] );

        //var_dump( $page->getIdTemplate() ); die;
        //$page->setContent( $template );
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
                    "active" => $page->getActive(),
                    "id_template" => $page->getIdTemplate(),
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


        $contents_bdd = explode( '&@/==/@&', $pages[0]->getContent() );

        $count = count( $contents_bdd );
        unset( $contents_bdd[$count - 1 ] ) ;
        $count -= 1;

        $contents = array();

        for( $i = 0; $i < $count; $i++ ){
            $j = $i + 1;
            $contents['content'.$j] = $contents_bdd[$i];
        }

        $v = new Views( 'pagesAdminEdit', "admin_header" );
        $v->assign("page_id", $pages[0]->getId() );
        $v->assign("page_title", $pages[0]->getTitle() );
        $v->assign("page_content", $contents );
        $v->assign("page_url", $pages[0]->getUrl() );
        $v->assign("page_navbar", $pages[0]->getisNavbar() );
        $v->assign("modify", true );
        $v->assign("current", "content");
        $v->assign("current_sidebar", "pages");
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
        $b=$category->getAllBy(["id_CategoryType"=>"1"],["id,description"],2);
        $v = new Views( "modifyArticleAdmin", "admin_header" );
        $v->assign("current", 'users');
        $v->assign( "a", $a);
        $v->assign( "b", $b);
    }

    public function modifyAdminArticle(){
        $article = new Article();
        $article->setId( $_POST['id'] );
        $article->setName( $_POST['name'] );
        $article->setDateParution( $_POST['dateparution'] );
        $article->setDescription( $_POST['description'] );
        $article->setImage( $_POST['image'] );
        $article->setCategory( $_POST['category'] );

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
        $article = new Article( $_GET['id']);
        //$a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '-1'");
        $article->updateTable(["status"=>"-1"],["id"=>$article->getId() ]);
        $this->getArticleAdmin();
    }

    public function parutionArticle(){
        $article = new Article( $_GET['id'] );
        //$a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '1' , dateparution=DATE( NOW())");
        $article->updateTable(["status"=>"1","dateparution"=>DATE('Y-m-d')],["id"=>$article->getId() ]);
        $this->getArticleAdmin();
    }
    //Ajouter un article
    public function addArticle(){
        $v = new Views( "addArticleAdmin", "admin_header" );
         $category = new Category();
         //$b = $category->getUpdate(" ", 2, "id, description");
         $b=$category->getAllBy(["id_CategoryType"=>"1"],["id,description"],2);
        $v->assign("current", 'article');
        $v->assign( "b", $b);
    }

    public function addAdminArticle(){
        $article = new Article();
        $article->setName( $_POST['name'] );
        $article->setDescription( $_POST['description'] );
        $article->setImage( $_POST['image'] );
        $article->setCategory( $_POST['category'] );

        $params = ["name" => $article->getName(),
            "dateparution" => date('Y-m-d'),
            "description" => $article->getDescription(),
            "image" => $article->getImage(),
            "status" => 0,
            "minidescription" => substr($article->getDescription(), 0,19),
            "id_Category" => $article->getCategory()];

        //var_dump( $params ); die;
        //$article->getUpdate(" ", 4, "(name, dateparution, description, image, status, minidescription, id_Category) VALUES ('".$article->getName()."',DATE( NOW() ), '".$article->getDescription()."', '".$article->getImage()."', 0, '".substr($article->getDescription(), 0,19)."', '".$article->getCategory()."')");
        $article->updateTable( $params );
        $this->getArticleAdmin();
    }
    public function getCategoryAdmin(){
        $v = new Views( "categoryAdmin", "admin_header" );
        $v->assign("current", 'category');
        $category = new Category();

        $u= $category->getAllBy(["id_CategoryType"=>"1","status" => "0"] , ["id, description"], 3);

        $v->assign( "u", $u );
    }
    public function addCategory(){
        $v = new Views( "addCategory", "admin_header" );
        $category = new Category();
        $v->assign("current", 'category');
    }

    public function addAdminCategory(){
        $category = new Category( );
        $category->setDescription(htmlentities( $_POST['description'] ));

       // $category->getUpdate(" ", 4, "(description) VALUES ('".$category->getDescription()."')");
        $category->updateTable(["description" => $category->getDescription(),
        "id_CategoryType" => "1"]);
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
        $category->setId(htmlentities( $_POST['id'] ));
        $category->setDescription(htmlentities( $_POST['description'] ));


        //$category->getUpdate("id = ".$category->getId()."", 1, "description = '".$category->getDescription()."'");
        $category->updateTable(["description"=>$category->getDescription()],["id"=>$category->getId()]);
        $this->getCategoryAdmin();

    }
    public function deleteCategory(){
        $category = new Category( $_GET['id'] );
        //$category->getUpdate("id = ".$a."", 1, "status = '-1'");
        $category->updateTable(["status"=>"-1"],["id"=>$category->getId() ]);
        $this->getCategoryAdmin();
    }



    public static function getWeek(){
        // ==================== Récupération de la semaine dynamiquement pour le planning =======================

        $week = [];

        for ( $i = 0; $i < 7; $i++ ){

            $today =  mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y") );
            $day = date('l', $today);

            if( $day != 'Sunday' && $day != 'Monday' ){
                switch ( $day ){
                    case 'Friday': $day = "Vendredi"; break;
                    case 'Tuesday': $day = "Mardi"; break;
                    case 'Wednesday': $day = "Mercredi"; break;
                    case 'Thursday': $day = "Jeudi"; break;
                    case 'Saturday': $day = "Samedi"; break;
                }


                $date = date( "d F Y", $today );
                //$date = date( "d F Y", $today );
                $day = $day . " " . self::changeMonth( $date );
                $week[$day] = date("Y-m-d", $today);
            }

        }

        return $week;
    }

    public static function getExtemum(){
        $week = [];

        $k = 0;
        for ( $i = 0; $i < 7; $i++ ){

            $today =  mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y") );
            $day = date('D', $today);

            if( $day != 'Sun' && $day != 'Mon' ){
                $week[$k] = date("Y-m-d", $today);
                $k++;
            }

        }

        return $week;
    }

    public static  function changeMonth( $date ){
        $month = date( "F", strtotime($date) );

        switch ( $month ){
            case 'January' : $res = str_replace( 'January', 'Janvier', $date ); break;
            case 'February': $res = str_replace( 'February', 'Février', $date ); break;
            case 'March': $res = str_replace( 'March', 'Mars', $date ); break;
            case 'April': $res = str_replace( 'April', 'Avril', $date ); break;
            case 'May': $res = str_replace( 'May', 'Mai', $date ); break;
            case 'June': $res = str_replace( 'June', 'Juin', $date ); break;
            case 'July': $res = str_replace( 'July', 'Juillet', $date ); break;
            case 'August': $res = str_replace( 'August', 'Août', $date ); break;
            case 'September': $res = str_replace( 'September', 'Septembre', $date ); break;
            case 'October': $res = str_replace( 'October', 'Octobre', $date ); break;
            case 'November': $res = str_replace( 'November', 'Novembre', $date ); break;
            case 'December': $res = str_replace( 'December', 'Décembre', $date ); break;
        }

        return $res;
    }


}
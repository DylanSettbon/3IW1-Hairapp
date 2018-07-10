<?php
use PHPMailer\PHPMailer\PHPMailer;
class AdminController{


    //Partie d'administration globale
    public function getTestAdmin(){
        $v = new Views( "dashboard", "admin_header" );
        $v->assign("current", 'dashboard');
    }

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
        //Faire un appel ajax sur une case:
        // Si elle est cocher afficher tous les rdv
        $v = new Views( 'appointmentAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'appointment');

        $appointment = new Appointment();
        $inner = ['inner_table' => ['user u1','user u2','package p'],
                  'inner_column' => ['id_User','id_Hairdresser','id_Package'],
                  'inner_ref_to' => ['u1.id','u2.id','p.id']];

        $appointments = $appointment->getAllBy(['dateAppointment' => date('Y-m-d'),'planned' => 1],[
                                                            'idAppointment',
                                                            'dateAppointment',
                                                            'hourAppointment',
                                                            'CONCAT(u1.firstname," ",u1.lastname) as id_User',
                                                            'CONCAT(u2.firstname," ",u2.lastname) as id_Hairdresser',
                                                            'p.description as id_Package'],3,$inner);

        $v->assign("appointments", $appointment->sortOnDate($appointments));
    }

    public function saveCategoryPackage()
    {
        //ajouter les erreurs
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

    public function deleteCategoryPackage($params){
        $category = new Category();
        $category->setId($params['URL'][0]);
        $category->updateTable(
            ["status" => 0],
            ["id" => $category->getId()]);
        $this->getPackageAdmin();
    }

    public function ajaxDeletePackage(){
        foreach($_POST['idPackageDeleted'] as $id){
            $package = new Package();
            $package->updateTable(
                ["status" => 0],
                ["id" => $id]);
        }
    }

    //ADMIN : APPOINTMENT
    public function updateAppointment($params){
        $v = new Views( 'appointmentAdminEdit', "admin_header" );

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $hairdresser = new Hairdresser();
        $hairdressers = $hairdresser->getAllBy(['status' => '2'],null,3);

        $appointment = new Appointment();
        //Selection de tous les coiffeurs et des forfaits
        if (isset($params['URL'][0])){

            $inner = ['inner_table' => ['user u1','user u2','package p'],
                'inner_column' => ['id_User','id_Hairdresser','id_Package'],
                'inner_ref_to' => ['u1.id','u2.id','p.id']];

            $currentAppointment = $appointment->getAllBy(['idAppointment' => $params['URL'][0]],[
                'idAppointment',
                'dateAppointment',
                'hourAppointment',
                'CONCAT(u1.firstname," ",u1.lastname) as id_User',
                'CONCAT(u2.firstname," ",u2.lastname) as id_Hairdresser',
                'p.description as id_Package'],3,$inner)[0];

            if(!empty($currentAppointment)){
                $hours = array_diff($appointment->getAllAvailableTimeRange(10),[substr($currentAppointment->getHourAppointment(),0,5)]);
                $v->assign("currentAppointment", $currentAppointment);
                $v->assign("titleEdit", 'Modification du rendez-vous de '.$currentAppointment->getIdUser().' le '.$currentAppointment->getFormatedDateAppointment());
                $v->assign("hours",$hours);
                $v->assign("packages",'a');
            }
        }
        else{

        }
            //Selection du rendez-vous courant
            //Mettre tous les champs qui sont égales au champs du rendez-vous
            //enlever dans les forfaits et dans les coiffeur les coiffeur deja selectionner
        //Sinon
            //Afficher tout dans la vue (package,heure, date, coiffeur, user)
        $v->assign("current_sidebar", 'appointment');
        $v->assign("current", 'content');
    }

    public function deleteAppointment($params){
        $appointment = new Appointment();
        $appointment->updateTable(
            ['planned' => 0],
            ['idAppointment' => $params['URL'][0]]
        );
        $this->getAppointmentAdmin();
    }


    //ADMIN : PAGES
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
        $array= array("0"=> "Utilisateur non actif", "1"=>"Utilisateur actif","2"=>"Coiffeur","3"=>"Admin");
        $u = $user->getAllBy(["id" => $a] , ["id, firstname , lastname , email , status , tel"], 2);
        $v = new Views( "modifyAdmin", "admin_header" );


        $form = $user->formUpdateUser();

        $v->assign("current", 'users');
        $v->assign("config", $form );


        $users = array(
            "id" => $u[0]->getId(),
            "lastname" => $u[0]->getLastname(),
            "prenom" => $u[0]->getFirstname(),
            "email" => $u[0]->getEmail(),
            "tel" => $u[0]->getTel(),
            "status" => $u[0]->getStatus()
        );

        $vars = array(
            "options" => $array,
            "user" => $users
        );


        $v->assign("options", $vars);
        //$v->assign( "u", $u);

    }

    public function modify(){
        $user = new User();
        $user->setId(htmlentities($_POST['id']));
        $user->setFirstname(htmlentities($_POST['prenom']));
        $user->setLastname(htmlentities($_POST['lastname']));
        $user->setEmail(htmlentities($_POST['email']));
        $user->setTel(htmlentities( $_POST['tel'] ));
        $user->setStatus( htmlentities($_POST['status']));
        $user->setDateUpdated(htmlentities(DATE('Y-m-d')));
        $form = $user->formUpdateUser();
        $errors=Validator::validate($form,$_POST);

        if( empty( $errors ) ){
            $message = "Votre compte à été modifié, voici vos nouvelles informations : ";
         #toutes ses infos contenues dans user

            switch( $user->getStatus() ){
                case '0':
                    $status = "Votre compte a été désactivé.";
                    break;
                case '1':
                    $status = "Votre compte a été activé.";
                    break;
                case '2':
                    $status = "Votre compte a été passé coiffeur.";
                    break;
                case '3':
                    $status = "Votre compte a été passé administrateur.";
                    break;
            }



           // $user->getUpdate("id = ".$user->getId()."", 1, "firstname = '".$user->getFirstname()."', lastname = '".$user->getLastname().  "', email = '".$user->getEmail()."',  status = ".$user->getStatus().", tel = ".$user->getTel()."");

            require("vendor/autoload.php");

                    $mail = new PHPMailer();

                    $mail->IsSMTP(); // enable SMTP
                    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                    $mail->SMTPAuth = true;  // authentication enabled
                    $mail->CharSet = "UTF-8";
                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465; //25 ou 465
                    $mail->Username = 'notifications.hairapp@gmail.com' ;
                    $mail->Password = 'zKXJKrMeGMH9';
                    $mail->From = 'notifications.hairapp@gmail.com';
                    $mail->FromName = 'notifications-hairapp';
                    $mail->Subject = 'Modification de vos données';
                    $mail->Body = 'Voici vos nouvelles données: <br>'.$user->getFirstname().'<br>'.$user->getLastname().'<br>'.$user->getEmail().'<br>'.$user->getTel().'<br>'.$status;
                    $mail->IsHTML(true);
                    $mail->AddAddress( $user->getEmail() );
                    if(!$mail->Send()) {
                        echo 'Mail error: '.$mail->ErrorInfo;
                    } else {
                       echo 'Message sent!';
                    }


            $user->updateTable(["firstname" => $user->getFirstname(),
                    "lastname" => $user->getLastname() ,
                    "email" => $user->getEmail(),
                    "tel" => $user->getTel(),
                    "dateUpdated"=>$user->getDateUpdated(),
                    "status" => $user->getStatus()],["id"=>$user->getId()]
                );
            $this->getUserAdmin();
        }
        else{
            $user = new User();
            $a = $_POST['id'];
            $array= array("0"=> "Utilisateur non actif", "1"=>"Utilisateur actif","2"=>"Coiffeur","3"=>"Admin");
            $v = new Views( "modifyAdmin", "admin_header" );


            $form = $user->formUpdateUser();

            $v->assign("current", 'users');
            $v->assign("config", $form );

            $vars = array(
                "options" => $array,
                "user" => $_POST
            );


            $v->assign("options", $vars);
            $v->assign("errors",$errors);
        }



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
        $array= array("0"=> "Utilisateur non actif", "1"=>"Utilisateur actif","2"=>"Coiffeur","3"=>"Admin");
        $v = new Views( "addAdmin", "header" );

        $user = new User();
        $form = $user->formAddUser();
        $v->assign("current", 'user');
        $v->assign("config", $form );
        $v->assign("options", $array);

    }

    public function add(){
        $user = new User();

        $folder = DIRNAME;

        $user->setFirstname(htmlentities($_POST['prenom']));
        $user->setLastname(htmlentities($_POST['nom']));
        $user->setEmail(htmlentities($_POST['email']));
        $user->setToken();
        $user->setTel(htmlentities( $_POST['tel'] ));
        $user->setStatus(htmlentities( $_POST['status'] ));
        $user->setDateInserted(htmlentities(DATE('Y-m-d')));
        $user->setDateUpdated(htmlentities(DATE('Y-m-d')));
        $form = $user->formAddUser();
        $errors=Validator::validate($form,$_POST);
        $errorsUnique=Validator::isUnique($form,$_POST);

        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a{$x}, $i++);

        if (empty($errors) && empty($errorsUnique)){

        require("vendor/autoload.php");

        if ($user->getStatus()==0){

             $mail = new PHPMailer();

                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                $mail->CharSet = 'UTF-8';
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465; //25 ou 465
                $mail->Username = 'notifications.hairapp@gmail.com' ;
                $mail->Password = 'zKXJKrMeGMH9';
                 $mail->From = 'notifications.hairapp@gmail.com';
                 $mail->FromName = 'notifications-hairapp';
                 $mail->IsHTML(true);
                 $mail->Subject = 'Activation de votre compte';
                 $mail->Body = 'Bienvenue sur Hairapp !<br>
                 Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet. <br>
                 ' . DIRNAME .'/signin/activate?token='.urlencode($user->getToken() ).' <br> --------------- <br>
                 Voici le mot de passe de votre compte: '.$s.'<br>
                 Ceci est un mail automatique, Merci de ne pas y répondre.';
                 $mail->AddAddress( $user->getEmail() );
                 if(!$mail->Send()) {
                     //echo 'Mail error: '.$mail->ErrorInfo;
                 } else {
                   // echo 'Message sent!';
                 }

        }else{

                $mail = new PHPMailer();

                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                $mail->CharSet = 'UTF-8';
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465; //25 ou 465
                $mail->Username = 'notifications.hairapp@gmail.com' ;
                $mail->Password = 'zKXJKrMeGMH9';
                $mail->From = 'notifications.hairapp@gmail.com';
                $mail->FromName = 'notifications-hairapp';
                $mail->Subject = 'Mot de passe de votre compte';
                $mail->Body = 'Voici le mot de passe de votre compte: '.$s;
                $mail->AddAddress( $user->getEmail() );
                if(!$mail->Send()) {
                    echo 'Mail error: '.$mail->ErrorInfo;
                } else {
                   //echo 'Message sent!';
                }
         }

        $user->setPwd( $s );
        //$user->getUpdate(" ", 4, "(firstname, lastname, email, pwd, token, tel, status) VALUES ('".$user->getFirstname()."', '".$user->getLastname()."', '".$user->getEmail()."', '".$s."', '".$user->getToken()."', '".$user->getTel()."', '".$user->getStatus()."')");
        $user->updateTable(["firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname() ,
                "email" => $user->getEmail(),
                "tel" => $user->getTel(),
                "status" => $user->getStatus(),
                "changetopwd" => true,
                "token" =>$user->getToken(),
                "dateUpdated"=>$user->getDateUpdated(),
                "dateInserted"=>$user->getDateInserted(),
                "pwd"=>$user->getPwd()]);
        $this->getUserAdmin();
    }else{
        $array= array("0"=> "Utilisateur non actif", "1"=>"Utilisateur actif","2"=>"Coiffeur","3"=>"Admin");
        $v = new Views( "addAdmin", "header" );

        $user = new User();
        $form = $user->formAddUser();
        $v->assign("current", 'user');
        $v->assign("config", $form );
        $v->assign("options", $array);
        $v->assign("errors",$errors);
        $v->assign("errorsUnique",$errorsUnique);
    }
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
        $v->assign("current", 'content');
        $article = new Article();
        $category = new Category();
        $array = array("0"=> "En cours de parution", "1"=>"Paru");
        //$a= $article->getUpdate("status!= '-1' ORDER BY dateparution DESC" , 2, "id, name , dateparution , description, status, id_Category ");
        //$b = $category->getUpdate(" ", 2, "id, description");
        $a= $article->getAllBy(["status" => "-1"] , ["id, name , dateparution , description , status , id_Category"], 4, '' , "ORDER BY status ASC");
        $b=$category->getAllBy([],["id,description"],2);


        $v->assign( "a", $a );
        $v->assign( "b", $b);
        $v->assign( "array",$array);
        $v->assign("current_sidebar", 'article');
    }

    //Modifier Article
    public function modifyArticle(){

        $article = new Article();
        $category = new Category();
        //$a = $article->getUpdate("id = ".$_GET['id']."", 2, "id, name , dateparution , description, id_Category ");
        //$b = $category->getUpdate(" ", 2, "id, description");
        $a=$article->getAllBy(["id" => $_GET['id']] , ["id, name ,image, dateparution , description , id_Category"], 2);
        $array=$category->getAllBy(["id_CategoryType"=>"1"],["id,description"],2);
        $v = new Views( "modifyArticleAdmin", "admin_header" );
        $v->assign("current", 'users');
       // $v->assign( "a", $a);
       // $v->assign( "b", $b);

        $form = $article->formUpdateArticle();

        $v->assign("current", 'users');
        $v->assign("config", $form );


        $articles = array(
            "id" => $a[0]->getId(),
            "name" => $a[0]->getName(),
            "picture" => $a[0]->getImage(),
            "dateparution" => $a[0]->getDateParution(),
            "description" => $a[0]->getDescription(),
            "category" => $a[0]->getCategory()

        );

        $vars = array(
            "options" => $array,
            "article" => $articles
        );


        $v->assign("options", $vars);
        //$v->assign( "u", $u);


    }

    public function modifyAdminArticle(){
        $article = new Article();
        $article->setId(htmlentities($_POST['id']));
        $article->setName(htmlentities($_POST['name']));
        $article->setDateParution(htmlentities($_POST['dateparution']));
        $article->setDescription(htmlentities($_POST['description']));
        //$article->setImage(htmlentities($_POST['picture']));
        if( !empty( $_FILES['picture']['name'] ) ){
            $name = "public/img/a_p/"; // changer le répertoire
            $file_name = basename($_FILES['picture']['name']);
            $size = $_FILES['picture']['size'];
            $extension = strrchr($_FILES['picture']['name'], '.');
//
//            if( is_uploaded_file( $_FILES['picture']['tmp_name'] )){
//                //echo "Upload OK<br>";
//            }
//            if( !is_dir( $name ) ){
//                echo "Naaaah : " . $name;
//            }

            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                //$update['picture'] = $name.$file_name;
                $article->setImage( $name.$file_name );
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo "An error occured: no file uploaded";die;
                //echo self::file_upload_error_message($_FILES['picture']['error']);
                //echo 'Echec de l\'upload !';
                //print_r($_FILES);
            }
        }
        $article->setCategory(htmlentities($_POST['category']));
        $form = $article->formUpdateArticle();
        $errors=Validator::validate($form,$_POST);


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
        $article->setId($_GET['id']);
        //$a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '-1'");
        $article->updateTable(["status"=>"-1"],["id" => $article->getId()]);
        $this->getArticleAdmin();
    }

    public function parutionArticle(){
        $article = new Article();
        $a=$article->getAllBy(["id" => $_GET['id']] , ["id, name , dateparution , description , id_Category, status"], 2);
        //$article->getUpdate("id = ".$a."", 1, "status = '1' , dateparution=DATE( NOW())");
        if ($a[0]->getStatus()==0)
            $article->updateTable(["status"=>"1","dateparution"=>DATE('Y-m-d')],["id"=>$a[0]->getId()]);
        if ($a[0]->getStatus()==1)
            $article->updateTable(["status"=>"0","dateparution"=>DATE('Y-m-d')],["id"=>$a[0]->getId()]);
        $this->getArticleAdmin();
    }
    //Ajouter un article
    public function addArticle(){
        $v = new Views( "addArticleAdmin", "admin_header" );
         $category = new Category();


         $article = new Article();
         $form = $article->formArticle();

         //var_dump( $form ); die;
         //$b = $category->getUpdate(" ", 2, "id, description");
         $b=$category->getAllBy(["id_CategoryType"=>"1", "status" => "1"],["id,description"],3);
        $v->assign("current", 'article');
        $v->assign("config", $form );
        $v->assign( "options", $b);
    }

    public function addAdminArticle(){
        $article = new Article();
        $article->setName(htmlentities($_POST['name']));
        $article->setDescription(htmlentities($_POST['description']));
        $article->setCategory(htmlentities($_POST['category']));


        // le $_FILES['picture'] il faut remplacer le picture par ton name de ton input

        if( !empty( $_FILES['picture']['name'] ) ){
            $name = "public/img/a_p/"; // changer le répertoire
            $file_name = basename($_FILES['picture']['name']);
            $size = $_FILES['picture']['size'];
            $extension = strrchr($_FILES['picture']['name'], '.');
//
//            if( is_uploaded_file( $_FILES['picture']['tmp_name'] )){
//                //echo "Upload OK<br>";
//            }
//            if( !is_dir( $name ) ){
//                echo "Naaaah : " . $name;
//            }

            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                //$update['picture'] = $name.$file_name;
                $article->setImage( $name.$file_name );
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo "An error occured: no file uploaded";die;
                //echo self::file_upload_error_message($_FILES['picture']['error']);
                //echo 'Echec de l\'upload !';
                //print_r($_FILES);
            }
        }
        //$article->setImage($_POST['picture']);
        $form = $article->formArticle();
        $errors=Validator::validate($form,$_POST);
        $params=["name" => $article->getName(),
                "description" => $article->getDescription(),
                "dateparution" => DATE('Y-m-d'),
                "minidescription" => substr($article->getDescription(), 0,19),
                "image" => $article->getImage(),
                "status" => 0,
                "id_Category" => $article->getCategory()];

        //$article->getUpdate(" ", 4, "(name, dateparution, description, image, status, minidescription, id_Category) VALUES ('".$article->getName()."',DATE( NOW() ), '".$article->getDescription()."', '".$article->getImage()."', 0, '".substr($article->getDescription(), 0,19)."', '".$article->getCategory()."')");
        $article->updateTable($params);
        $this->getArticleAdmin();
    }
    public function getCategoryAdmin(){
        $v = new Views( "categoryAdmin", "admin_header" );
        $v->assign("current", 'content');
        $category = new Category();

        $u= $category->getAllBy(["id_CategoryType"=>"1","status" => "1"] , ["id, description"], 3);

        $v->assign( "u", $u );
        $v->assign("current_sidebar", 'category');
    }
    public function addCategory(){
        $v = new Views( "addCategory", "admin_header" );
         $category = new Category();
         $form = $category->formAddCategory();

        $v->assign("config", $form );
        $v->assign("current", 'category');
    }

    public function addAdminCategory(){
        $category = new Category();
        $category->setDescription(htmlentities($_POST['description']));
        $category->setIdUser($_SESSION["id"]);
        $form = $category->formAddCategory();
        $errors=Validator::validate($form,$_POST);
        $errorsUnique=Validator::isUnique($form,$_POST);

        if(empty($errors) && empty($errorsUnique)){
       // $category->getUpdate(" ", 4, "(description) VALUES ('".$category->getDescription()."')");
        $category->updateTable(["description" => $category->getDescription(),
        "id_CategoryType" => "1", "id_User"=> $category->getIdUser() ]);
        $this->getCategoryAdmin();
    }else{
        $v = new Views( "addCategory", "admin_header" );
         $category = new Category();
         $form = $category->formAddCategory();

        $v->assign("config", $form );
        $v->assign("current", 'category');
        $v->assign("errors",$errors);
        $v->assign("errorsUnique",$errorsUnique);

    }

    }
    public function modifyCategory(){

        $category = new Category();
        //$a = $category->getUpdate("id = ".$_GET['id']."", 2, "id, description");
        $a= $category->getAllBy(["id"=>$_GET['id']],["id, description"], 2);
        $v = new Views( "modifyCategory", "admin_header" );
        $v->assign( "a", $a);

         $form = $category->formUpdateCategory();


        $v->assign("current", 'category');
        $v->assign("config", $form );


        $categories = array(
            "id" => $a[0]->getId(),
            "description" => $a[0]->getDescription(),

        );

        $vars = array(
            "category" => $categories
        );

         $v->assign("options", $vars);

    }

    public function modifyAdminCategory(){
        $category = new Category();
        $category->setId(htmlentities($_POST['id']));
        $category->setDescription(htmlentities($_POST['description']));
        $category->setIdUser($_SESSION["id"]);
        $form = $category->formUpdateCategory();
        $errors=Validator::validate($form,$_POST);


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
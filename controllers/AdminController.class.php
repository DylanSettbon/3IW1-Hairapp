<?php

class AdminController{

    public function getAdmin(){
        $user = new User();
        $package = new Package();
        $appointment = new Appointment();

        $countUser = $user->countTable();
        $avgPackage= $package->getAllBy(null,['AVG(price) as price','AVG(duration) as duration'],3)[0];
        $avgPrice = round($avgPackage->getPrice(),2);
        $avgDuration = round($avgPackage->getDuration(),2);

        $appointments = $appointment->getAllBy(['planned' => 1],['dateAppointment'],3);
        $futurAppointment = 0;
        $pastAppointment = 0;
        foreach ($appointments as $appointment){
            $futurAppointment = $appointment->getDateAppointment() >= date('Y-m-d')? $futurAppointment +1 : $futurAppointment;
            $pastAppointment = $appointment->getDateAppointment() < date('Y-m-d')? $pastAppointment +1 : $pastAppointment;;
        }

        $v = new Views( "dashboard", "admin_header" );
        $v->assign('countAppointment',['pastAppointment' => $pastAppointment,'futurAppointment' => $futurAppointment]);
        $v->assign('countUser',$countUser);
        $v->assign('avgPackagePrice',$avgPrice);
        $v->assign('avgPackageDuration',$avgDuration);
        $v->assign("current", 'dashboard');
    }

    /**
     * @return bool
     */
    public function ajaxGetDashboardData(){
        $user = new User();
        $appointment = new Appointment();
        $users = $user->getAllBy(null,null,3);
        $appointments = $appointment->getAllBy(['planned' => 1],['took'],3);

        $arrayStatus = array("-1"=>"Utilisateur supprimé", "0"=> "Utilisateur non actif", "1"=> "Utilisateur actif", "2"=>"Coiffeur","3"=>"Administrateur");
        $data = [];

        if(!empty($users)) {
            foreach ($users as $user) {
                $roleLabel = array_key_exists($user->getStatus(), $arrayStatus) ? $arrayStatus[$user->getStatus()] : $user->getStatus();
                if (isset($data['roles'][$roleLabel])) {
                    $data['roles'][$roleLabel]++;
                } else {
                    $data['roles'][$roleLabel] = 1;
                }

                if ($user->getStatus() == '0' || $user->getStatus() == '1') {
                    $createdMonth = date("n", strtotime($user->getDateInserted()));
                    $createdYear = date("Y", strtotime($user->getDateInserted()));

                    if (date('Y') >= $createdYear && date('n') >= $createdMonth) {
                        if (isset($data['signin'][$createdMonth])) {
                            $data['signin'][$createdMonth]++;
                        } else {
                            $data['signin'][$createdMonth] = 1;
                        }
                    }
                }
            }
            if(!empty($data['signin'])) {
                ksort($data['signin']);
                $firstMonth = array_keys($data['signin'])[0];
                $keys = array_keys($data['signin']);
                $lastMonth = $keys[count(array_keys($data['signin'])) - 1];


                for ($i = $firstMonth; $i <= $lastMonth; $i++) {
                    array_key_exists($i, $data['signin']) ? '' : $data['signin'][$i] = 0;
                }
                ksort($data['signin']);
            }
        }
        else{
            $data['signin'] = 0;
            $data['roles'] = 0;
        }

        if (!empty($appointments)) {
            foreach ($appointments as $appointment) {
                    $makingMonth = date("n", strtotime($appointment->getTook()));
                    if (isset($data['appointment'][$makingMonth])) {
                        $data['appointment'][$makingMonth]++;
                    } else {
                        $data['appointment'][$makingMonth] = 1;
                    }
            }

            ksort($data['appointment']);


            if (is_array($data['signin'])) {
                $data['labelLine'] = array_unique(array_merge(array_keys($data['signin']), array_keys($data['appointment'])));
            }
            else
                $data['labelLine'] = array_unique(array_keys($data['appointment']));
            foreach ($data['labelLine'] as $label) {
                if (!array_key_exists($label, $data['appointment'])) {
                    $data['appointment'][$label] = 0;
                }
                if (!array_key_exists($label, $data['signin'])) {
                    $data['signin'][$label] = 0;
                }
            }
            ksort($data['appointment']);
        }
        else{
            $data['appointment'] = 0;
            $data['labelLine'] = 0;

        }

        echo(json_encode($data));
        return true;
    }

    /*
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
    */

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
       $this->getPackageAdmin();
    }

    public function saveCategoryPackage()
    {
        if (isset($_POST['categoryPackageSubmit']) && $_POST['categoryPackageSubmit'] == 'Valider') {
            $category = new Category(3);
            $category->setDescription($_POST['categoryDesc']);
            $category->setIdUser($_SESSION['id']);
            $displayOrder = empty($_POST['categoryOrder']) ? 9999 : $_POST['categoryOrder'];
            $errors = Validator::checkAvailableCategoryOrderForPackageAdmin($displayOrder);
            $category->setDisplayOrder($displayOrder);
            $oldCategory = $category->getAllBy(['displayOrder' => $category->getDisplayOrder(), 'id_CategoryType' => $category->getIdCategoryType(), 'status_category' => 1], ['id_category', 'id_CategoryType'], 3);
            if (!isset($_POST['categoryId'])) {
                $errors = Validator::checkAvailableCategoryForPackageAdmin($category);
                if (empty($errors)) {
                    if (!empty($oldCategory[0])) {
                        $oldCategory = $oldCategory[0];
                        $oldCategory->setDisplayOrder(9999);
                        $oldCategory->updateTable(
                            ["status_category" => '1', "displayOrder" => $oldCategory->getDisplayOrder()],
                            ["id_category" => $oldCategory->getId()]
                        );
                    }
                    if (!$category->checkIfCategoryDescriptionExists(2)) {
                        //Si order existe = remplacer l'ancien par le derniere ordre possible
                        $category->updateTable(
                            [
                                "description_category" => $category->getDescription(),
                                "id_User" => $category->getIdUser(),
                                "id_CategoryType" => $category->getIdCategoryType(),
                                "displayOrder" => $category->getDisplayOrder()
                            ]);
                    }
                    else if ($category->checkIfCategoryDescriptionExists(0)) {
                        $category->updateTable(
                            ["status_category" => '1', "displayOrder" => $category->getDisplayOrder()],
                            ["description_category" => $category->getDescription()]
                        );
                    }
                }
            }
            else {
                $category->setId($_POST['categoryId']);
                if (!empty($oldCategory[0])) {
                    $currentCategory = $category->getAllBy(['id_category' => $category->getId()],null,3)[0];
                    $oldCategory = $oldCategory[0];
                    $oldCategory->setDisplayOrder($currentCategory->getDisplayOrder());
                    $oldCategory->updateTable(
                        ["status_category" => '1', "displayOrder" => $oldCategory->getDisplayOrder()],
                        ["id_category" => $oldCategory->getId()]
                    );
                }
                $category->updateTable(
                    ["description_category" => $category->getDescription(), "displayOrder" => $category->getDisplayOrder()],
                    ["id_category" => $category->getId()]);
            }
        }
        $this->getPackageAdmin(isset($errors) ? $errors : null);
    }

    //Partie de gestion des forfaits
    public function getPackageAdmin($data = null){
        $v = new Views( 'packageAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'packages');
        $category = new Category(3);
        $categories = $category->getAllBy(['id_CategoryType' => $category->getIdCategoryType(), 'status_category' => '1'],null,3);
        $categories = empty($categories)? $categories : Category::getCategoriesSortedByOrder($categories);

        $form = $category->formAddCategoryForPackageAdmin();
        $v->assign("categories", $categories);
        $v->assign("config", $form );

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $v->assign('packages',$packages);

        //form
        $formAddCategory = $category->formAddCategoryForPackageAdmin();
        $formUpdateCategory = $category->formUpdateCategoryForPackageAdmin();
        $formAddPackage = $package->formAddPackageForPackageAdmin();
        $formUpdatePackage = $package->formUpdatePackageForPackageAdmin();
        $v->assign("configAddCategory", $formAddCategory );
        $v->assign("configUpdateCategory", $formUpdateCategory);
        $v->assign("configAddPackage", $formAddPackage);
        $v->assign("configUpdatePackage", $formUpdatePackage);
        if(isset($data['errors'])){
            $v->assign("errors",$data['errors']);
        }
    }

    public function getAppointmentAdmin($params){
        $v = new Views( 'appointmentAdmin', "admin_header" );
        $v->assign("current", 'content');
        $v->assign("current_sidebar", 'appointment');
        $v->assign("filter",isset($params['URL'][0])?$params['URL'][0]:'');
        $hour = date('H:i');
        $date = date('Y-m-d');

        $max = ['max_to' => date('Y-m-d')];
        $min = ['min_to' => date('Y-m-d')];

        if (isset($params['URL'][0])){
            switch($params['URL'][0]){
                case 'past':
                    $filter = 'min_to';
                    $tab = 6;
                    break;
                default:
                    $filter = 'max_to';
                    $tab = 9;
            }
        }
        else{
            $filter = 'max_to';
            $tab = 7;
        }

        $where = [$filter => $date];


        $appointment = new Appointment();
        $inner = ['inner_table' => ['user u1','user u2','package p'],
                  'inner_column' => ['id_User','id_Hairdresser','id_Package'],
                  'inner_ref_to' => ['u1.id','u2.id','p.id']];


        $appointments = $appointment->getAllBy($where,[
                                                            'dateAppointment',
                                                            'idAppointment',
                                                            'hourAppointment',
                                                            'CONCAT(u1.lastname," ", u1.firstname) as id_user',
                                                            'CONCAT(u2.lastname," ",u2.firstname) as id_Hairdresser',
                                                            'p.description as id_Package',
                                                            'planned'],$tab,$inner,null);



        foreach ($appointments as $key => $appointment) {
            if ($appointment->getPlanned() != 1) {
                unset($appointments[$key]);
            }

            if (isset($params['URL'][0])){
                if($params['URL'][0] == 'past'){
                    if ($appointment->getDateAppointment() == $date && $appointment->getHourAppointment() >= $hour){
                        unset($appointments[$key]);
                    }
                }
                else{
                    if ($appointment->getDateAppointment() == $date && $appointment->getHourAppointment() < $hour){
                        unset($appointments[$key]);
                    }
                }
            }
        }
        $appointments = array_values($appointments);

        $v->assign("appointments", $appointment->sortOnDate($appointments));
    }


    public function savePackage()
    {
        if (isset($_POST['packageSubmit']) && $_POST['packageSubmit'] == 'Valider') {
            $package = new Package();
            $package->setDescription($_POST['description']);
            $package->setPrice($_POST['price']);
            $package->setDuration($_POST['duration']);
            $package->setIdCategory($_POST['categoryId']);
            $package->setIdUser($_SESSION['id']);
            if ($package->checkIfPackageExists()) {
                $errors['errors'][] = 'Ce forfait existe déja pour cette catégorie';
            }
            else{
                    if (!isset($_POST['packageId'])) {
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
            $this->getPackageAdmin(isset($errors)?$errors:'');
        }

    public function saveAppointment($params){
        if ($params['POST']['btn-Valider']) {
            $appointment = new Appointment();
            $month = $_POST['mois']<10 ? '0' . $_POST['mois'] : $_POST['mois'];
            $day = $_POST['jour']<10 ? '0' . $_POST['jour'] : $_POST['jour'];
            $date = $_POST['annee'] . $month . $day;

            if (isset($params['URL'][0])) {
                $appointment->setId($params['URL'][0]);
                $current = $appointment->getAllBy(['idAppointment' => $appointment->getId()],null,3)[0];
                $appointment->setHourAppointment(isset($_POST['appointmentHour'])?$_POST['appointmentHour']:$current->getHourAppointment());
                $appointment->setDateAppointment($date);
                $appointment->setIdHairdresser(isset($_POST['hairdresser'])?$_POST['hairdresser']:$current->getIdHairdresser());
                $appointment->setIdPackage(isset($_POST['package'])?$_POST['package']:$current->getIdPackage());
                $appointment->updateTable( ['dateAppointment' => $appointment->getDateAppointment(),
                                            'hourAppointment' => $appointment->getHourAppointment(),
                                            'id_Hairdresser' => $appointment->getIdHairdresser(),
                                            'id_Package' => $appointment->getIdPackage()],
                                            ['idAppointment' => $appointment->getId()]);


                if (!empty($current)) {
                    $idUser = $current->getIdUser();
                    $user = new User();
                    $mailUser = $user->getAllBy(['id' => $idUser], ['email'], 3)[0]->getEmail();
                    $current->sendUpdateAppointmentMail($appointment,[$mailUser]);
                }
                $this->getAppointmentAdmin($params);
            } else {
                $errors = ['errors' => Validator::checkAvailableAppointment()];
                if(!empty($errors['errors'])) {
                    $this->updateAppointment($params,$errors);
                }
                else {
                    $appointment->setHourAppointment($_POST['selectHour']);
                    $appointment->setDateAppointment($date);
                    $appointment->setIdHairdresser($_POST['hairdresser']);
                    $appointment->setIdPackage($_POST['package']);
                    $appointment->setIdUser($_POST['user']);
                    $appointment->updateTable([
                        'dateAppointment' => $appointment->getDateAppointment(),
                        'hourAppointment' => $appointment->getHourAppointment(),
                        'id_user' => $appointment->getIdUser(),
                        'id_Hairdresser' => $appointment->getIdHairdresser(),
                        'id_Package' => $appointment->getIdPackage(),
                        'took' => date('Ymd')]);
                    $idUser = $appointment->getIdUser();
                    $user = new User();
                    $mailUser = $user->getAllBy(['id' => $idUser], ['email'], 3)[0]->getEmail();
                    $appointment->sendAddAppointmentMail([$mailUser]);
                    $this->getAppointmentAdmin($params);
                }
            }
        }
    }

    public function deleteCategoryPackage($params){
        $category = new Category(3);
        $category->setId($params['URL'][0]);
        $category->updateTable(
            ["status_category" => 0],
            ["id_category" => $category->getId()]);
        $categories = $category->getAllBy(['id_CategoryType' => $category->getIdCategoryType(), 'status_category' => '1'],null,3);
        if (!empty($categories)){
            $categories = Category::getCategoriesSortedByOrder($categories);
            foreach($categories as $key=>$category){
                $category->updateTable(
                    ['displayOrder' => $key +1],
                    ['id_category' => $category->getId()]
                );
            }
        }
        $this->getPackageAdmin();
    }

    public function ajaxDeletePackage(){
        $package = new Package();
        foreach($_POST['idPackageDeleted'] as $id){
            $package->updateTable(
                ["status" => 0],
                ["id" => $id]);
        }
    }

    //ADMIN : APPOINTMENT
    public function updateAppointment($params,$data = null){
        $v = new Views( 'appointmentAdminEdit', "admin_header" );

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $category = new Category(3);
        $categories = $category->getAllBy(['id_CategoryType' => $category->getIdCategoryType(), 'status_category' => '1'],null,3);

        $hairdresser = new Hairdresser();
        $hairdressers = $hairdresser->getAllBy(['status' => '2'],null,3);

        $appointment = new Appointment();
        $hours = $appointment->getAllAvailableTimeRange();

        if (isset($params['URL'][0])){
            $inner = ['inner_table' => ['user u1','user u2','package p'],
                'inner_column' => ['id_User','id_Hairdresser','id_Package'],
                'inner_ref_to' => ['u1.id','u2.id','p.id']];

            $currentAppointment = $appointment->getAllBy(['idAppointment' => $params['URL'][0]],[
                'idAppointment',
                'dateAppointment',
                'hourAppointment',
                'CONCAT(u1.lastname," ", u1.firstname) as id_user',
                'CONCAT(u2.lastname," ",u2.firstname) as id_Hairdresser',
                'p.description as id_Package'],3,$inner);

            if(!empty($currentAppointment)){
                $currentAppointment = $currentAppointment[0];
                $hours = array_diff($hours,[substr($currentAppointment->getHourAppointment(),0,5)]);
                $v->assign("currentAppointment", $currentAppointment);
                $v->assign("hours",$hours);
                $v->assign("titleEdit", 'Rendez-vous de '.$currentAppointment->getIdUser().' le '.$currentAppointment->getFormatedDateAppointment());
                $v->assign("day",str_replace('0','',explode('-', $currentAppointment->getDateAppointment())[2]));
                $v->assign("month",str_replace('0','',explode('-', $currentAppointment->getDateAppointment())[1]));
                $v->assign("year",explode('-', $currentAppointment->getDateAppointment())[0]);
            }
            else {
                $v->assign("titleEdit", 'Ajout d\'un rendez-vous');
                $v->assign("hours",$hours);
            }
            $v->assign('mode','update');
        }
        else{
                $user = new User();
                $users = $user->getAllBy(['status' => '1'],null,3);
                $v->assign('mode','add');
                $v->assign("users",$users);
                $v->assign("titleEdit", 'Ajout d\'un rendez-vous');
                $v->assign("hours",$hours);
        }

        $v->assign("packages",$packages);
        $v->assign("hairdressers",$hairdressers);
        $v->assign("categories",$categories);
        $v->assign("current_sidebar", 'appointment');
        $v->assign("current", 'content');
        isset($data)?$v->assign('data',$data):'';
    }

    public function deleteAppointment($params){
        $appointment = new Appointment();
        $currentAppointment = $appointment->getAllBy(['planned' => 1,'idAppointment' => $params['URL'][0]],null,3);
        if (!empty($currentAppointment)) {
            $idUser = $currentAppointment[0]->getIdUser();
            $user = new User();
            $mailUser = $user->getAllBy(['id' => $idUser], ['email'], 3)[0]->getEmail();
            $currentAppointment[0]->sendDeleteAppointmentMail([$mailUser]);
        }

        $appointment->updateTable(
            ['planned' => 0],
            ['idAppointment' => $params['URL'][0]]
        );
        $this->getAppointmentAdmin($params);
    }

    //ADMIN : PAGES

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
    public function modifyUser($params){

        $user = new User();
        $a = $params['URL'][0];
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

        $errorsUnique = Validator::isUnique( $form, $_POST, $_POST['id'] );
        

        if( empty( $errors ) && empty( $errorsUnique ) ){
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
                   

                  
                    $from = 'notifications.hairapp@gmail.com';
                    $fromName = 'notifications-hairapp';
                    $object = 'Modification de vos données';
                    $body = 'Voici vos nouvelles données: <br>'.$user->getFirstname().'<br>'.$user->getLastname().'<br>'.$user->getEmail().'<br>'.$user->getTel().'<br>'.$status;
                    $to = [$user->getEmail()];

                $mail = new Mail($to, $from, $fromName, $object, $body,'', '', true);

                    if(!$mail->Send()) {
                        //echo 'Mail error: '.$mail->ErrorInfo;
                    } else {
                      // echo 'Message sent!';
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
            $v->assign('errorsUnique', $errorsUnique );
        }



    }

    public function deleteUser($params){
        $user = new User();
        $a = $params['URL'][0];
        $user->getUpdate("id = ".$a."", 1, "status = '-1'");
        $this->getUserAdmin();
    }

    public function delete($params){
        $user = new User();
        $a = $params['URL'][0];
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
        
        if( !Security::checkMailExist( $_POST['email'] ) ){
            $errors[] = "Cet email est déjà utilisé.";
        }

        if( !Security::checkTelExist( $_POST['tel'] ) ){
            $errors[] = "Ce numéro est déjà utilisé.";
        }

        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a{$x}, $i++);

        if (empty($errors) ){


        if ($user->getStatus()==0){
            
                 $from = 'notifications.hairapp@gmail.com';
                 $fromName = 'notifications-hairapp';
                 $object = 'Activation de votre compte';
                 $body = 'Bienvenue sur Hairapp !<br>
                 Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet. <br>
                 ' . $_SERVER['HTTP_HOST'] .'/signin/activate?token='.urlencode($user->getToken() ).' <br> --------------- <br>
                 Voici le mot de passe de votre compte: '.$s;
                 $to = [$user->getEmail()];

                 $mail = new Mail($to, $from, $fromName, $object, $body,'', '', true);

                 if(!$mail->Send()) {
                     //echo 'Mail error: '.$mail->ErrorInfo;
                 } else {
                   // echo 'Message sent!';
                 }

        }else{

                $from = 'notifications.hairapp@gmail.com';
                $fromName = 'notifications-hairapp';
                $object = 'Mot de passe de votre compte';
                $body = 'Voici le mot de passe de votre compte: '.$s;
                $to=[$user->getEmail()];


                 $mail = new Mail($to, $from, $fromName, $object, $body,'', '', true);

                if(!$mail->Send()) {
                    //echo 'Mail error: '.$mail->ErrorInfo;
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
        $b=$category->getAllBy([],["id_category,description_category"],2);


        $v->assign( "a", $a );
        $v->assign( "b", $b);
        $v->assign( "array",$array);
        $v->assign("current_sidebar", 'article');
    }

    //Modifier Article
    public function modifyArticle($params){

        $article = new Article();
        $category = new Category();
        //$a = $article->getUpdate("id = ".$_GET['id']."", 2, "id, name , dateparution , description, id_Category ");
        //$b = $category->getUpdate(" ", 2, "id, description");
        $a=$article->getAllBy(["id" => $params['URL'][0]] , ["id, name ,image, dateparution , description , id_Category"], 2);

        $array=$category->getAllBy(["status_category"=>"-1"],["id_category,description_category, id_CategoryType"],4,""," HAVING id_CategoryType = 1");

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
        $article->setName(htmlentities( $_POST['name'] ) );
        $article->setDateParution(htmlentities( $_POST['dateparution'] ) );
        $article->setDescription($_POST['description'] );
        
        $params = array(

                "minidescription" => substr(strip_tags( $article->getDescription() ), 0,19),
                "name" => $article->getName(),
                "dateparution" => $article->getDateParution() ,
                "description" =>  $article->getDescription()      
            );

                //$article->setImage(htmlentities($_POST['picture']));
        if( !empty( $_FILES['picture']['name'] ) ){

            $name = "public/img/a_p/"; // changer le répertoire
            $file_name = basename($_FILES['picture']['name']);
            $size = $_FILES['picture']['size'];
            $extension = strrchr($_FILES['picture']['name'], '.');


            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                //$update['picture'] = $name.$file_name;
                $article->setImage( $name.$file_name );
                $params['image'] = $article->getImage();
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

        $article->updateTable($params,["id"=>$article->getId()]);
        $this->getArticleAdmin();

    }
    //Supprimer Article
    public function deleteArticle($params){

        $article = new Article();
        $article->setId($params['URL'][0]);
        //$a = $_GET['id'];
        //$article->getUpdate("id = ".$a."", 1, "status = '-1'");
        $article->updateTable(["status"=>"-1"],["id" => $article->getId()]);
        $this->getArticleAdmin();
    }

    public function parutionArticle($params){


        $article = new Article();
        $a=$article->getAllBy(["id" => $params['URL'][0]] , ["id, name , dateparution , description , id_Category, status"], 2);
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
         $b=$category->getAllBy(["id_CategoryType"=>"1", "status_category" => "1"],["id_category,description_category"],3);
        $v->assign("current", 'article');
        $v->assign("config", $form );
        $v->assign( "options", $b);
    }

    public function addAdminArticle(){
        $article = new Article();
        $article->setName(htmlentities(ucfirst($_POST['name'])));
        $article->setDescription($_POST['description']);
        $article->setCategory(htmlentities($_POST['category']));


        // le $_FILES['picture'] il faut remplacer le picture par ton name de ton input

        if( !empty( $_FILES['picture']['name'] ) ){
            $name = "public/img/a_p/"; // changer le répertoire
            $file_name = basename($_FILES['picture']['name']);
            $size = $_FILES['picture']['size'];
            $extension = strrchr($_FILES['picture']['name'], '.');

        
                }
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
        
        //$article->setImage($_POST['picture']);
        $form = $article->formArticle();
        $errors=Validator::validate($form,$_POST);
        $params=["name" => $article->getName(),
                "description" => $article->getDescription(),
                "dateparution" => DATE('Y-m-d'),
                "minidescription" => substr( strip_tags( $article->getDescription() ), 0,19),
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

        $u= $category->getAllBy(["id_CategoryType"=>"1","status_category" => "1"] , ["id_category, description_category"], 3);

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
        $errorsUnique=Validator::isUnique($form,$_POST,null);

        if(empty($errors) && empty($errorsUnique)){
       // $category->getUpdate(" ", 4, "(description) VALUES ('".$category->getDescription()."')");
        $category->updateTable(["description_category" => $category->getDescription(),
        "id_CategoryType" => "1", "id_user"=> $category->getIdUser() ]);
        $this->getCategoryAdmin();
    }else{
        $v = new Views( "addCategory", "admin_header" );
         $category = new Category();
         $form = $category->formAddCategory();

        $v->assign("config", $form );
        $v->assign("current", 'content');
        $v->assign("errors",$errors);
        $v->assign("errorsUnique",$errorsUnique);

    }

    }

    public function modifyCategory($params){
        $category = new Category();
        //$a = $category->getUpdate("id = ".$_GET['id']."", 2, "id, description");
        $a= $category->getAllBy(["id_category"=>$params['URL'][0]],["id_category, description_category"], 2);
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
        $errorsUnique=Validator::isUnique($form,$_POST,$_POST['id']);

        if (empty($errors) && empty($errorsUnique)){
            //$category->getUpdate("id = ".$category->getId()."", 1, "description = '".$category->getDescription()."'");
            $category->updateTable(["description_category"=>$category->getDescription()],["id_category"=>$category->getId()]);
            $this->getCategoryAdmin();
        }else {

        //$a = $category->getUpdate("id = ".$_GET['id']."", 2, "id, description");
        $a= $category->getAllBy(["id_category"=>$category->getId()],["id_category, description_category"], 2);
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
         $v->assign("errors", $errors);
         $v->assign("errorsUnique", $errorsUnique);
        }

    }
    public function deleteCategory($params){
        $category = new Category();
        $a = $params['URL'][0];
        //$category->getUpdate("id = ".$a."", 1, "status = '-1'");
        $category->updateTable(["status_category"=>"-1"],["id_category"=>$a]);
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


    // COMMENTAIRES

        public function getCommentAdmin(){
            $v = new Views( "commentAdmin", "admin_header" );
            $v->assign("current", 'content');
            $v->assign("current_sidebar", 'comments');
            $comment = new Comment();
            $user = new User();
            $article = new Article();
            $articles = $article->select("article ORDER BY dateparution DESC");

            $idArticle = $_GET['article'];

            if($idArticle){
                $comments = $comment->select("comment WHERE id_Article = '". $idArticle ."'ORDER BY date DESC");
            }else{
               $comments = $comment->select("comment ORDER BY date DESC");
            }
//
            $v->assign("comments", $comments);
            $v->assign("articles", $articles);
            $u = $user->select("user");

            $v->assign("u", $u);

            }
        public function declineComment(){
                $comment = new Comment();
                $idComment = $_GET['id'];
                $comment->getUpdate("id = ".$idComment."", 1, "statut = '0'");
                $this->getCommentAdmin();
            }
        public function acceptComment(){
                $comment = new Comment();
                $idComment = $_GET['id'];
                $comment->getUpdate("id = ".$idComment."", 1, "statut = '2'");
                $this->getCommentAdmin();
            }
        public function deleteComment(){
                $comment = new Comment();
                $idComment = $_GET['id'];
                $comment->getUpdate("id = ".$idComment."", 3, " ");
                $this->getCommentAdmin();
            }

        //COLORPAGE

        public function getColorPage(){
                $v = new Views("color", "admin_header");
                $v->assign("current", 'content');
                $v->assign("current_sidebar", 'color');

            }


        public function colorChange(){
                if ($_POST['customColor'] == ""){
                        //Msg d'erreur ou autre
                    }
            else{
                    $color = new Color();

                    $current = $color->getUpdate("name LIKE 'current'", 2, "code");
                    $currentColor = $current[0]->getCode();
                    $newColor = ($_POST['customColor']);
                    $change = "main_color: ". $currentColor .";";
                    $to = "main_color: ". $newColor .";";
                    $path = 'public/scss/_var.scss';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
                    file_put_contents($path, $contentReplace);
                    $color->getUpdate("name LIKE 'current'", 1, "code = '". $newColor ."'");
                    }
            sleep(1);
            $this->getColorPage();
            //$myFile=fopen("./conf.inc.php", "w");
        }

        public function colorStandard(){
                $color = new Color();

                $current = $color->getUpdate("name LIKE 'current'", 2, "code");
                $currentColor = $current[0]->getCode();

                $standard = $color->getUpdate("name LIKE 'standard'", 2, "code");
                $standardColor = $standard[0]->getCode();
                $change = "main_color: ". $currentColor .";";
                $to = "main_color: ". $standardColor .";";
                $path = 'public/scss/_var.scss';
                $content = file_get_contents($path);
                $contentReplace = str_replace($change, $to, $content);
                file_put_contents($path, $contentReplace);
                $color->getUpdate("name LIKE 'current'", 1, "code = '". $standardColor ."'");
                sleep(1);
                $this->getColorPage();
                //$myFile=fopen("./conf.inc.php", "w");
            }

        //COLORPAGE

        public function getColorPageBtn(){
                $v = new Views("colorBtn", "admin_header");
                $v->assign("current", 'content');
                $v->assign("current_sidebar", 'color');
            }


        public function colorChangeBtn(){
                if ($_POST['customColor'] == ""){
                        //Msg d'erreur ou autre
                    }
            else{
                    $color = new Color();

                    $current = $color->getUpdate("name LIKE 'currentBtn'", 2, "code");
                    $currentColor = $current[0]->getCode();
                    $newColor = ($_POST['customColor']);
                    $change = "button_color: ". $currentColor .";";
                    $to = "button_color: ". $newColor .";";
                    $path = 'public/scss/_var.scss';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
               // var_dump( $content ); die;
                    file_put_contents($path, $contentReplace);
                    $color->getUpdate("name LIKE 'currentBtn'", 1, "code = '". $newColor ."'");
                    }
            sleep(1);
            $this->getColorPageBtn();
        }

        public function colorStandardBtn(){
                $color = new Color();

                $current = $color->getUpdate("name LIKE 'currentBtn'", 2, "code");
                $currentColor = $current[0]->getCode();

                $standard = $color->getUpdate("name LIKE 'standardBtn'", 2, "code");
                $standardColor = $standard[0]->getCode();
                $change = "button_color: ". $currentColor .";";
                $to = "button_color: ". $standardColor .";";
                $path = 'public/scss/_var.scss';
                $content = file_get_contents($path);
                $contentReplace = str_replace($change, $to, $content);
                file_put_contents($path, $contentReplace);
                $color->getUpdate("name LIKE 'currentBtn'", 1, "code = '". $standardColor ."'");
                sleep(1);
                $this->getColorPageBtn();
            }

        //templating
        public function getTemplateAdmin(){
            $v = new Views( 'templateAdmin', "admin_header" );
            $v->assign("current", 'content');
            $v->assign("current_sidebar", 'template');
        }

        public function pictureFirstChange(){
            if (empty($_FILES['newFirstPicture']['name'])){
                //Msg d'erreur ou autre
            }
            else{
                $targetDir = "public/img/";
                $fileName = basename($_FILES['newFirstPicture']['name']);
                $size = $_FILES['newFirstPicture']['size'];
                $extension = strrchr($_FILES['newFirstPicture']['name'], '.');
                $fileName = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                //$fileName = str_replace(' ', '_', $fileName);
                
                if(move_uploaded_file($_FILES['newFirstPicture']['tmp_name'], $targetDir.$fileName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $picture = new Color();
                    $current = $picture->getUpdate("code LIKE 'nFirst'", 2, "name");
                    $currentPicture = $current[0]->getName();
                    $newPicture = $fileName;
                    $change = "../public/img/". $currentPicture;
                    $to = "../public/img/". $newPicture;


                    $path = './views/templateAdmin.view.php';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
                    file_put_contents($path, $contentReplace);

                    $secondPath = './views/index.view.php';
                    $secondContent = file_get_contents($secondPath);
                    $secondContentReplace = str_replace($change, $to, $secondContent);
                    file_put_contents($secondPath, $secondContentReplace);

                    $picture->getUpdate("code LIKE 'nFirst'", 1, "name = '". $newPicture ."'");
                }
            }
            $this->getTemplateAdmin();
        }
        public function pictureFirstStandard(){
            
            $picture = new Color();
            $current = $picture->getUpdate("code LIKE 'nFirst'", 2, "name");
            $currentPicture = $current[0]->getName();
            
            $standard = $picture->getUpdate("code LIKE 'first'", 2, "name");
            $standardPicture = $standard[0]->getName();
            $change = "../public/img/". $currentPicture;
            $to = "../public/img/". $standardPicture;

            $path = './views/templateAdmin.view.php';
            $content = file_get_contents($path);
            $contentReplace = str_replace($change, $to, $content);
            file_put_contents($path, $contentReplace);

            $secondPath = './views/index.view.php';
            $secondContent = file_get_contents($secondPath);
            $secondContentReplace = str_replace($change, $to, $secondContent);
            file_put_contents($secondPath, $secondContentReplace);

            $picture->getUpdate("code LIKE 'nFirst'", 1, "name = '". $standardPicture ."'");
            $this->getTemplateAdmin();
        }

        public function pictureSecondChange(){
            if (empty($_FILES['newSecondPicture']['name'])){
                //Msg d'erreur ou autre
            }
            else{
                $targetDir = "public/img/";
                $fileName = basename($_FILES['newSecondPicture']['name']);
                $size = $_FILES['newSecondPicture']['size'];
                $extension = strrchr($_FILES['newSecondPicture']['name'], '.');
                $fileName = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                //$fileName = str_replace(' ', '_', $fileName);
                
                if(move_uploaded_file($_FILES['newSecondPicture']['tmp_name'], $targetDir.$fileName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $picture = new Color();
                    $current = $picture->getUpdate("code LIKE 'nSecond'", 2, "name");
                    $currentPicture = $current[0]->getName();
                    $newPicture = $fileName;
                    $change = "../public/img/". $currentPicture;
                    $to = "../public/img/". $newPicture;


                    $path = './views/templateAdmin.view.php';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
                    file_put_contents($path, $contentReplace);

                    $secondPath = './views/index.view.php';
                    $secondContent = file_get_contents($secondPath);
                    $secondContentReplace = str_replace($change, $to, $secondContent);
                    file_put_contents($secondPath, $secondContentReplace);

                    $picture->getUpdate("code LIKE 'nSecond'", 1, "name = '". $newPicture ."'");
                }
            }
            $this->getTemplateAdmin();
        }
        public function pictureSecondStandard(){
            
            $picture = new Color();
            $current = $picture->getUpdate("code LIKE 'nSecond'", 2, "name");
            $currentPicture = $current[0]->getName();
            
            $standard = $picture->getUpdate("code LIKE 'second'", 2, "name");
            $standardPicture = $standard[0]->getName();
            $change = "../public/img/". $currentPicture;
            $to = "../public/img/". $standardPicture;

            $path = './views/templateAdmin.view.php';
            $content = file_get_contents($path);
            $contentReplace = str_replace($change, $to, $content);
            file_put_contents($path, $contentReplace);

            $secondPath = './views/index.view.php';
            $secondContent = file_get_contents($secondPath);
            $secondContentReplace = str_replace($change, $to, $secondContent);
            file_put_contents($secondPath, $secondContentReplace);

            $picture->getUpdate("code LIKE 'nSecond'", 1, "name = '". $standardPicture ."'");
            $this->getTemplateAdmin();
        }
        public function pictureThirdChange(){
            if (empty($_FILES['newThirdPicture']['name'])){
                //Msg d'erreur ou autre
            }
            else{
                $targetDir = "public/img/";
                $fileName = basename($_FILES['newThirdPicture']['name']);
                $size = $_FILES['newThirdPicture']['size'];
                $extension = strrchr($_FILES['newThirdPicture']['name'], '.');
                $fileName = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                //$fileName = str_replace(' ', '_', $fileName);
                
                if(move_uploaded_file($_FILES['newThirdPicture']['tmp_name'], $targetDir.$fileName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $picture = new Color();
                    $current = $picture->getUpdate("code LIKE 'nThird'", 2, "name");
                    $currentPicture = $current[0]->getName();
                    $newPicture = $fileName;
                    $change = "../public/img/". $currentPicture;
                    $to = "../public/img/". $newPicture;


                    $path = './views/templateAdmin.view.php';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
                    file_put_contents($path, $contentReplace);

                    $secondPath = './views/index.view.php';
                    $secondContent = file_get_contents($secondPath);
                    $secondContentReplace = str_replace($change, $to, $secondContent);
                    file_put_contents($secondPath, $secondContentReplace);

                    $picture->getUpdate("code LIKE 'nThird'", 1, "name = '". $newPicture ."'");
                }
            }
            $this->getTemplateAdmin();
        }
        public function pictureThirdStandard(){
            
            $picture = new Color();
            $current = $picture->getUpdate("code LIKE 'nThird'", 2, "name");
            $currentPicture = $current[0]->getName();
            
            $standard = $picture->getUpdate("code LIKE 'third'", 2, "name");
            $standardPicture = $standard[0]->getName();
            $change = "../public/img/". $currentPicture;
            $to = "../public/img/". $standardPicture;

            $path = './views/templateAdmin.view.php';
            $content = file_get_contents($path);
            $contentReplace = str_replace($change, $to, $content);
            file_put_contents($path, $contentReplace);

            $secondPath = './views/index.view.php';
            $secondContent = file_get_contents($secondPath);
            $secondContentReplace = str_replace($change, $to, $secondContent);
            file_put_contents($secondPath, $secondContentReplace);

            $picture->getUpdate("code LIKE 'nThird'", 1, "name = '". $standardPicture ."'");
            $this->getTemplateAdmin();
        }

        public function pictureAccChange(){
            if (empty($_FILES['newAccPicture']['name'])){
                //Msg d'erreur ou autre
            }
            else{
                $targetDir = "public/img/";
                $fileName = basename($_FILES['newAccPicture']['name']);
                $size = $_FILES['newAccPicture']['size'];
                $extension = strrchr($_FILES['newAccPicture']['name'], '.');
                $fileName = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                //$fileName = str_replace(' ', '_', $fileName);
                
                if(move_uploaded_file($_FILES['newAccPicture']['tmp_name'], $targetDir.$fileName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $picture = new Color();
                    $current = $picture->getUpdate("code LIKE 'nFond'", 2, "name");
                    $currentPicture = $current[0]->getName();
                    $newPicture = $fileName;

                    $change = "../public/img/". $currentPicture;
                    $to = "../public/img/". $newPicture;

                    $path = './views/templateAdmin.view.php';
                    $content = file_get_contents($path);
                    $contentReplace = str_replace($change, $to, $content);
                    file_put_contents($path, $contentReplace);

                    $secondChange = "background-image: url(\"../img/". $currentPicture ."\");";
                    $secondTo = "background-image: url(\"../img/". $newPicture ."\");";

                    $secondPath = './public/scss/_var.scss';
                    $secondContent = file_get_contents($secondPath);
                    $secondContentReplace = str_replace($secondChange, $secondTo, $secondContent);
                    file_put_contents($secondPath, $secondContentReplace);

                    $picture->getUpdate("code LIKE 'nFond'", 1, "name = '". $newPicture ."'");
                    sleep(1);
                }
            }
            $this->getTemplateAdmin();
        }
        public function pictureAccStandard(){
            
            $picture = new Color();
            $current = $picture->getUpdate("code LIKE 'nFond'", 2, "name");
            $currentPicture = $current[0]->getName();
            
            $standard = $picture->getUpdate("code LIKE 'fond'", 2, "name");
            $standardPicture = $standard[0]->getName();
            $change = "../public/img/". $currentPicture;
            $to = "../public/img/". $standardPicture;

            $path = './views/templateAdmin.view.php';
            $content = file_get_contents($path);
            $contentReplace = str_replace($change, $to, $content);
            file_put_contents($path, $contentReplace);

            $secondChange = "background-image: url(\"../img/". $currentPicture ."\");";
            $secondTo = "background-image: url(\"../img/". $standardPicture ."\");";

            $secondPath = './public/scss/_var.scss';
            $secondContent = file_get_contents($secondPath);
            $secondContentReplace = str_replace($secondChange, $secondTo, $secondContent);
            file_put_contents($secondPath, $secondContentReplace);

            $picture->getUpdate("code LIKE 'nFond'", 1, "name = '". $standardPicture ."'");
            sleep(1);
            $this->getTemplateAdmin();
        }
}
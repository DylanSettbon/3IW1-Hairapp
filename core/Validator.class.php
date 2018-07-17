<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/04/2018
 * Time: 16:47
 */

class Validator
{

    public static function validate($form, $params)
    {
        $errorsMsg = [];

        foreach ($form["input"] as $name => $config) {

            if (isset($config["confirm"]) && $params[$name] !== $params[$config["confirm"]]) {
                $errorsMsg[] = "Les deux mots de passe doivent être identiques";
            }
            else if (!isset($config["confirm"] ) ) {
                if ( $config["type"] == "email" ){
                    if(isset($config['disable'])) {

                        if( $config['disable'] != true ){
                            if( !self::checkEmail($params[$name] ) ){
                                $errorsMsg[] = "L'email n'est pas valide";
                            }
                        }
                    }
                    else{
                        if( !self::checkEmail($params[$name] ) ){
                            $errorsMsg[] = "L'email n'est pas valide";
                        }
                    }

                

                } else if ($config["type"] == "password" && !self::checkPwd($params[$name])) {
                    $errorsMsg[] = "Le mot de passe est incorrect (6 à 12, min, maj, chiffres)";
                }

            }

            if( $config["type"] == "tel" ){
                if( !self::checkTel( $params[$name] ) ){
                    $errorsMsg[] = "Numero de téléphone non conforme";
                }
            }


            if (isset($config["required"]) && !self::minLength($params[$name], 1)) {
                $errorsMsg[] = $name . " doit faire plus de 1 caractère";
            }

            if (isset($config["minString"]) && !self::minLength($params[$name], $config["minString"])) {
                $errorsMsg[] = $name . " doit faire plus de " . $config["minString"] . " caractères";
            }

            if (isset($config["maxString"]) && !self::maxLength($params[$name], $config["maxString"])) {
                $errorsMsg[] = $name . " doit faire moins de " . $config["maxString"] . " caractères";
            }

            if( isset( $params['picture'] ) ){
                if( $config['type'] == "file" && !self::VerifImgExt() ){
                    $errorsMsg[] = $name . " doit avoir une extension en .PNG . JPG  .GIF ou .JPEG ";
                }
                if( $config['type'] == "file" && !self::VerifImgSize( $params[$name] ) ){
                    $errorsMsg[] = $name . " La taille du fichier est supérieure à 1MO";
                }
            }


        }

        return $errorsMsg;
    }

    public static function isUnique($form, $params)
    {
        $errorsMsg = [];

        foreach ($form["input"] as $name => $config) {

            if( $config["type"] == "email" ){
                if( !self::isUniqueEmail( $params[$name] ) ){
                    $errorsMsg[] = "Email deja existant";
                }
            }

            if( $config["type"] == "text" ){
                if( !self::isUniqueCategory( $params[$name] ) ){
                    $errorsMsg[] = "Categorie deja existante";
                }
            } 

            if( $config["type"] == "tel" ){
                if( !self::isUniqueTel( $params[$name] ) ){
                    $errorsMsg[] = "Telephone deja existant";
                }
            } 

        }

        //deuxième foreach pour les textarea


        return $errorsMsg;
    }
    public static function checkTel( $phone ){
        if( preg_match( "#^0[1-68]([-. ]?\d{2}){4}$#", $phone ) ){
            return true;
        }
        return false;
    }

    public static function isUniqueEmail( $email ){
        $users = new User();
        $users = $users->getAllBy(["email" => $email], ["id, email, status"], 2);
        foreach ($users as $user) {
        if ($user->getStatus() != '-1')
            return false;
        }
        return true;
    }

    public static function isUniqueTel( $tel ){
        $users = new User();
        $users = $users->getAllBy(["tel" => $tel], ["id, tel, status"], 2);
        foreach ($users as $user) {
        if ( $user->getStatus() != '-1')
            return false;
        }
        return true;
    }

    public static function isUniqueCategory( $categorie ){
        $cat = new Category();
        $cat = $cat->getAllBy(["description" => $categorie], ["id, description, status, id_CategoryType"], 2);
        foreach ($cat as $category) {
        if ( $category->getStatus() != '-1' && $category->getIdCategoryType()==1)
            return false;
        }
        return true;
    }


    public static function login( $form, $params ){

        $errorsMsg = [];

        if( !self::checkLogin( $params['email'], $params['pwd'] ) ){
            $errorsMsg[] = "Email ou mot de passe incorrect.";
        }

        return $errorsMsg;

    }

    public static function checkEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function checkPwd($pwd){
        return strlen($pwd)>6 &&  strlen($pwd)<12 && preg_match("/[A-Z]/", $pwd)  && preg_match("/[a-z]/", $pwd)  && preg_match("/[0-9]/", $pwd);
    }

    public static function minLength($value, $length){
        return strlen(trim($value))>=$length;
    }
    public static function maxLength($value, $length){
        return strlen(trim($value))<=$length;
    }

    public static function VerifImgExt (){
        $extension = strrchr($_FILES['picture']['name'], '.');
        global $list_of_extensions;
        if(!in_array($extension, $list_of_extensions)) //Si l'extension n'est pas dans le tableau
        {
            return false;
        }
        return true;
    }

    public static function VerifImgSize ( $max_size ) {
        if( $_FILES['picture']['size'] > $max_size )
        {
            return false;
        }
        return true;
    }

    public static function file_upload_error_message($error_code) {
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
            case UPLOAD_ERR_PARTIAL:
                return 'Le fichier a été téléchargé partiellement, veuillez réessayer.';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'File upload stopped by extension';
            default:
                return 'Unknown upload error';
        }
    }


    public static function checkLogin($email, $pwd){

        if (password_verify( $_POST['pwd'], $pwd ) == false ){
            return false;
        }
        else if( $_POST['email'] != $email ){
            return false;
        }
        else{
            return true;
        }
    }

    public static function checkAvailableCategoryOrderForPackageAdmin($displayOrder){
        return ctype_digit($displayOrder)? true : $errors['errors'][] = 'L\'ordre de la catégorie doit être un nombre';;
    }

    public static function checkAvailableCategoryForPackageAdmin($category){
        if ($category->checkIfCategoryDescriptionExists(1)) {
            $errors['errors'][] = 'Cette catégorie est déja existante';
        }
        return isset($errors)?$errors:0;
    }



    public static function checkAvailableAppointment(){

        $appointment = new Appointment();
        $errors = [];
        //Verifie si coiffeur existe, forfait existe
        if(!isset($_POST['mois']) || !isset($_POST['jour']) ||  !isset($_POST['annee'])){
            $errors[] = 'Aucune date selectionnée';
        }
        if(!isset($_POST['hairdresser'])){
            $errors[] = 'Aucun coiffeur selectionée';
        }
        if(!isset($_POST['package'])){
            $errors[] = 'Aucun forfait selectioné';
        }
        if(!isset($_POST['cbHeure']) && !isset($_POST['appointmentHour'])){
            $errors[] = 'Aucune horaires selectionée';
        }
        else{
            $now = new DateTime();
            $month = $_POST['mois']<10?'0'.$_POST['mois']:$_POST['mois'];
            $day = $_POST['jour']<10?'0'.$_POST['jour']:$_POST['jour'];
            $date = $_POST['annee'].$month.$day;
            if($now->format('Ymd') > $date){
                $errors[] = 'La date est inférieure à la date du jour';
            }
        }

        if(empty($errors)){
            if ($appointment->countTable('Appointment', ['dateAppointment' => $date, 'hourAppointment' => isset($_POST['cbHeure'])?$_POST['cbHeure']:$_POST['appointmentHour'], 'id_Hairdresser' => $_POST['hairdresser'],'planned' => 1]) > 0) {
                $errors[] = 'Ce creneau horaire n\'est pas disponible';
            }

            if ($appointment->countTable('Appointment', ['dateAppointment' => $date, 'hourAppointment' => isset($_POST['cbHeure'])?$_POST['cbHeure']:$_POST['appointmentHour'], 'id_User' => $_SESSION['id'],'planned' => 1]) > 0) {
                $errors[] = 'Vous avez déja un rendez-vous pour cette date et ce créneau horaire';
            }

        }

        return empty($errors)? [] : $errors;
    }

    public static function validateInstall( $form, $params ){

        $errorsMsg = [];

        foreach ( $form["div"] as $groups => $config ){

            foreach ( $config['input'] as $nameIpt => $paramsIpt ){
                if (isset($paramsIpt["confirm"]) && $params[$nameIpt] !== $params[$paramsIpt["confirm"]]) {
                    $errorsMsg[] = "Les deux mots de passe doivent être identiques";
                }
                else if (!isset($paramsIpt["confirm"] ) ) {

                    if ( $paramsIpt["type"] == "email" ){
                        if(isset($paramsIpt['disable'])) {

                            if( $paramsIpt['disable'] != true ){
                                if( !self::checkEmail($params[$nameIpt] ) ){
                                    $errorsMsg[] = "L'email n'est pas valide";
                                }
                            }
                        }
                        else{
                            if( !self::checkEmail($params[$nameIpt] ) ){
                                $errorsMsg[] = "L'email n'est pas valide";
                            }
                        }

                    } else if ($paramsIpt["type"] == "password" && !self::checkPwd($params[$nameIpt])) {
                        $errorsMsg[] = "Le mot de passe est incorrect (6 à 12, min, maj, chiffres)";
                    }

                }

                if( $paramsIpt["type"] == "tel" ){
                    if( !self::checkTel( $params[$nameIpt] ) ){
                        $errorsMsg[] = "Numero de téléphone non conforme";
                    }
                }


                if (isset($paramsIpt["required"]) && !self::minLength($params[$nameIpt], 1)) {
                    $errorsMsg[] = $name . " doit faire plus de 1 caractère";
                }

                if (isset($paramsIpt["minString"]) && !self::minLength($params[$nameIpt], $paramsIpt["minString"])) {
                    $errorsMsg[] = $nameIpt . " doit faire plus de " . $paramsIpt["minString"] . " caractères";
                }

                if (isset($paramsIpt["maxString"]) && !self::maxLength($params[$nameIpt], $paramsIpt["maxString"])) {
                    $errorsMsg[] = $nameIpt . " doit faire moins de " . $paramsIpt["maxString"] . " caractères";
                }

                if( isset( $params['picture'] ) ){
                    if( $paramsIpt['type'] == "file" && !self::VerifImgExt() ){
                        $errorsMsg[] = $nameIpt . " doit avoir une extension en .PNG . JPG  .GIF ou .JPEG ";
                    }
                    if( $paramsIpt['type'] == "file" && !self::VerifImgSize( $params[$nameIpt] ) ){
                        $errorsMsg[] = $nameIpt . " La taille du fichier est supérieure à 1MO";
                    }
                }
            }
        }

        return $errorsMsg;
    }
}
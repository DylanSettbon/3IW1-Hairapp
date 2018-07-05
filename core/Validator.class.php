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
            } else if (!isset($config["confirm"] ) ) {
                if ($config["type"] == "email" && $config['disable'] != true ) {

                    if( !self::checkEmail($params[$name] ) ){
                        $errorsMsg[] = "L'email n'est pas valide";
                    }



                } else if ($config["type"] == "password" && !self::checkPwd($params[$name])) {
                    $errorsMsg[] = "Le mot de passe est incorrect (6 à 12, min, maj, chiffres)";
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
        if(!isset($_POST['cbHeure'])){
            $errors[] = 'Aucune horaires selectionée';
        }
        else{
            $now = new DateTime();
            $month = $_POST['mois']<10?'0'.$_POST['mois']:$_POST['mois'];
            $day = $_POST['jour']<10?'0'.$_POST['jour']:$_POST['jour'];
            $date = $_POST['annee'].$month.$day;
            if($now->format('Ymd') > $date){
                $errors[] = ['La date est inférieure à la date du jour'];
            }
        }

        if(empty($errors)){
            if ($appointment->countTable('Appointment', ['dateAppointment' => $date, 'hourAppointment' => $_POST['cbHeure'], 'id_Hairdresser' => $_POST['hairdresser']]) > 0) {
                $errors[] = 'Ce creneau horaire n\'est pas disponible';
            }

            if ($appointment->countTable('Appointment', ['dateAppointment' => $date, 'hourAppointment' => $_POST['cbHeure'], 'id_User' => $_SESSION['id']]) > 0) {
                $errors[] = 'Vous avez déja un rendez-vous pour cette date et ce créneau horaire';
            }

        }

        return empty($errors)? [] : $errors;
    }
}
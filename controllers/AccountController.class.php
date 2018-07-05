<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:10
 */

class AccountController{

    public function getAccount(){

        $user = new User();
        $form = $user->AccountForm();

        $form_pwd = $user->ChangePwdForm();

        $account = $user->populate( ['email' => $_SESSION['email'] ] );

        $v = new Views( "account", "header" );
        $infos = array(
            "email"=> $account->getEmail(),
            "tel" => $account->getTel(),
            "prenom" => $account->getFirstname(),
            'nom' => $account->getLastname(),
            'picture' => $account->getPicture(),
            "offers" => $account->getReceivePromOffer()
        );

        $appointment = new Appointment();

        $where = [
            "id_User" => $_SESSION['id'],
            "max_to" => date("Y-m-d"),
        ];

        $inner = array(
            'inner_table' => ['user u'],
            'inner_column' => ['id_Hairdresser'],
            'inner_ref_to' => ['u.id']
        );

        $appointments = $appointment->getAllBy(
            $where,
            ['dateAppointment', 'hourAppointment', 'id_User', 'id_Hairdresser', 'id_Package', 'u.firstname' , 'u.lastname'], 7, $inner);

        $v->assign("account", $infos);

        foreach ( $appointments as $appointment ){
            $hour = $appointment->getHourAppointment();
            $date = $appointment->getDateAppointment();
            $date2 = date( "d F Y", strtotime($date) );

            $new_date = $appointment::changeMonth( $date2 );

            $month = date( "F", strtotime( $date2 ) );

            if( preg_match( "/[0-9]{2}[:][0-9]{2}[:][0]{2}/", $hour ) ){
                $hour = substr( $hour, 0, 5);
                $hour = str_replace(':', 'h', $hour);
                $appointment->setHourAppointment( $hour );
            }

            $appointment->setDateAppointment( $new_date );
        }

        $v->assign("appointments", $appointments );
        $v->assign("config",$form);
        $v->assign("config_pwd", $form_pwd );
        $v->assign("current", 'account');
    }

    public function saveAccount( $params ){


        $user = new User();
        $form = $user->AccountForm();

        $update = array(
            "firstname" => $_POST['prenom'],
            "lastname" => $_POST['nom'],
            'tel' => $_POST['tel'],
            'dateUpdated' => date("Y-m-d"),
        );
        unset($_POST['email'] );

        if( !empty( $_FILES['picture']['name'] ) ){
            $name = "public/img/U_p_p/";
            $file_name = basename($_FILES['picture']['name']);
            $size = $_FILES['picture']['size'];
            $extension = strrchr($_FILES['picture']['name'], '.');


            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            if(move_uploaded_file($_FILES['picture']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $update['picture'] = $name.$file_name;
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo "An error occured: no file uploaded";
                //echo self::file_upload_error_message($_FILES['picture']['error']);
                //echo 'Echec de l\'upload !';
                //print_r($_FILES);
            }
        }


        $errors = Validator::validate($form, $_POST);
        if( empty( $errors ) ){

            $user->updateTable( $update, ["id" => $_SESSION['id'] ]);

            self::getAccount();

        }else{
            $v = new Views( "account", "header" );
            $v->assign( "current", "account" );
            $v->assign( "account", $_POST );
            $v->assign("config",$form);
            $v->assign("errors",$errors);
        }


    }


}
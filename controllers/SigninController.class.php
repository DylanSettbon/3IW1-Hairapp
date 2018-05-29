<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:32
 */


class SigninController{

    public function getSignin(){

        $user = new User();
        $form = $user->FormSignIn();
        $v = new Views( "signin", "header" );
        $v->assign( "current", "login" );
        $v->assign("config",$form);
    }

    /**
     *
     */
    public function Validate( $params ){

        $user = new User();
        $form = $user->FormSignIn();

        if(!empty($params["POST"])) {
            //Verification des saisies

            $errors = Validator::validate($form, $params["POST"]);
            //var_dump( $errors ); die;
            if( empty( $errors ) ){
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

                $params = array(
                    "firstname" => $user->getFirstname(),
                    "lastname" => $user->getLastname(),
                    "email" => $user->getEmail(),
                    "pwd" => $user->getPwd(),
                    "token" => $user->getToken() ,
                    "tel" => $user->getTel(),
                    "receivePromOffer" => $user->getReceivePromOffer(),
                    "status" => $user->getStatus(),
                    "dateInserted" => date( "Y-m-d"),
                    "dateUpdated" => date( "Y-m-d" ),
                    "lastConnection" => null
                );
                //var_dump( $params ); die;
                $user->updateTable( $params );
                //var_dump( $user ); die;
                require("vendor/autoload.php");
                //require("vendor/phpmailer/phpmailer/src/SMTP.php");

                $mail = new PHPMailer();

                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465; //25 ou 465
                $mail->Username = 'notifications.hairapp@gmail.com' ;
                $mail->Password = 'zKXJKrMeGMH9';
                $mail->From = 'notifications.hairapp@gmail.com';
                $mail->FromName = 'notifications-hairapp';
                $mail->Subject = 'Activation de votre compte';
                $mail->Body = 'Pour activer votre compte, veuillez suive le lien suivant : ';
                $mail->AddAddress( $user->getEmail() );
                if(!$mail->Send()) {
                    //echo 'Mail error: '.$mail->ErrorInfo;
                } else {
                   // echo 'Message sent!';
                }

                header("Location: ".DIRNAME."home/getHome");

            }
            else{
                $v = new Views( "signin", "header" );
                $v->assign( "current", "login" );
                $v->assign("config",$form);
                $v->assign("errors",$errors);
            }

        }
    }
}
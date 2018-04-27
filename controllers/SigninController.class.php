<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:32
 */


class SigninController{

    public function getSignin(){

        $v = new Views( "signin", "header" );
    }

    /**
     *
     */
    public function Validate(){

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


        $user->updateTable( $params );

        header("Location: ".DIRNAME."home/getHome");
    }
}
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
        $user->setNumber( $_POST['tel'] );


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
            "number" => $user->getNumber(),
            "receivePromOffer" => $user->getReceivePromOffer(),
            "status" => $user->getStatus()
        );

        $user->updateTable( $params );

        header("Location: ".DIRNAME."home/getHome");
    }
}
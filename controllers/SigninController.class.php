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

    public function Validate(){

        $user = new User();
        $params = array(
            "firstname" => $user->setFirstname($_POST['prenom']),
            "firstname" =>$user->setEmail($_POST['email']),
            "firstname" =>$user->setLastname($_POST['nom']),
            "firstname" =>$user->setNumber($_POST['tel']),
            $user->setPwd($_POST['pwd']),
        );

        if( $_POST['offers'] == 'on' ){
            $user->setReceivePromOffer(true);
        }
        else{
            $user->setReceivePromOffer(false);
        }

        $user->setToken();

        $user->updateTable( 'user', $params );

        header("Location: ".DIRNAME."home/getHome");
    }
}
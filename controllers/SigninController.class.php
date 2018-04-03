<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:32
 */

class SigninController{


    /**
     * SigninController constructor.
     */
    public function __construct()
    {
    }

    public function getSignin(){

    }

    public function Validate(){

        print_r( $_POST );

        $user = new User();
        $user->setFirstname($_POST['nom']);
        $user->setEmail($_POST['email']);
        $user->setKind($_POST['civilite']);
        $user->setLastname($_POST['prenom']);
        $user->setNumber($_POST['tel']);
        $user->setPwd($_POST['pwd']);
        if( $_POST['offers'] == 'on' ){
            $user->setReceivePromOffer(true);
        }
        else{
            $user->setReceivePromOffer(false);
        }

        $user->setToken();

        echo "insertion";
    }
}
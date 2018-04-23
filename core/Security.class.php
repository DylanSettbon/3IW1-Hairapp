<?php
class Security{


    public static function isConnected(){

        $user = new User();
        $user = $user->populate( ["email" => $_SESSION['email'] ] );

        if(!empty($_SESSION["token"]) && !empty($_SESSION["email"])){

            if( $user->getToken() == $_SESSION['token'] && $user->getEmail() == $_SESSION['email'] ){
                return true;
            }
            else{
                return false;
            }
        }
        return false;
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


    public static function setSession( User $user){

        $_SESSION['firstname'] = $user->getFirstname();
        $_SESSION['lastname'] = $user->getLastname();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['token'] = $user->getToken();
        $_SESSION['id'] = $user->getId();
    }



}
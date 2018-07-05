<?php
class Security{


    public static function isConnected(){

        if(!empty($_SESSION["token"]) && !empty($_SESSION["email"])){
            $user = new User();
            $user = $user->populate( ["email" => $_SESSION['email'] ] );

            if( $user->getToken() == $_SESSION['token'] && $user->getEmail() == $_SESSION['email'] ){
                return true;
            }
            else{
                return false;
            }
        }
        return false;
    }

    public static function checkActivate( User $user ){
        if( $user->getStatus() == 0 || $user->getStatus() == -1 ){
            return false;
        }
        return true;
    }


    public static function setSession( User $user){

        $_SESSION['firstname'] = $user->getFirstname();
        $_SESSION['lastname'] = $user->getLastname();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['token'] = $user->getToken();
        $_SESSION['id'] = $user->getId();
    }

    public static function isAdmin(){
        $user = new User();
        $user = $user->populate( ["email" => $_SESSION['email'] ] );

        if( $user->getStatus() == 3 ){
            return true;
        }
        return false;
    }


    public static function isCoiffeur(){
        $user = new User();
        $user = $user->populate( ["email" => $_SESSION['email'] ] );

        if( $user->getStatus() == 2 ){
            return true;
        }
        return false;
    }

    public static function checkMailExist( $email ){
        $user = new User();
        $user = $user->getAllBy( ["email" =>$email ], null, 3 );

        if( count( $user ) > 0 ){
            return false;
        }
        else{
            return true;
        }
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class LoginController {



    /**
     * @return mixed
     */
    public function getLogin()
    {
        $v = new Views( "login", "header" );
    }


    /**
     * @internal param $login_
     * @internal param $mdp_
     */
    public function getVerify(){

        //Ca doit etre un objet
        $user = new User();

        $userInformations = $user->populate(
            array( "email" => $_POST['email'] )
        );

        if(  Security::checkLogin( $userInformations->getEmail(), $userInformations->getPwd() ) ) {
            $userInformations->setToken();
            $params = array(
                "token" => $userInformations->getToken(),

            );

            $user->updateTable('user', $params, ["id" => $userInformations->getId()]);

            Security::setSession($userInformations);

            header("Location: " . DIRNAME . "home/getHome");

        }
        else{
            echo "faux";
        }


    }

    /**
     * @param $email
     */
    public function getNewPwd($email ){

    }
}
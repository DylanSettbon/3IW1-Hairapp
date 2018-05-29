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
        $v->assign( "current", "login" );
    }


    /**
     * @internal param $login_
     * @internal param $mdp_
     */
    public function getVerify(){

        //Ca doit etre un objet
        $user = new User();

        if( $_POST['email'] != '' ){

            $userInformations = $user->populate(
                array( "email" => $_POST['email'] )
            );
            //var_dump( $userInformations ); die;

            if(  Security::checkLogin( $userInformations->getEmail(), $userInformations->getPwd() ) ) {
                $userInformations->setToken();
                //var_dump( $_POST ); die;
                $params = array(
                    "token" => $userInformations->getToken(),
                );
                //var_dump( $_POST ); die;
                $user->updateTable( $params, ["id" => $userInformations->getId()] );

                Security::setSession($userInformations);

                header("Location: " . DIRNAME . "home/getHome");

            }
            else{
                echo "faux";
            }

        }
        else{
            echo "veuillez saisir des informations";
        }



    }

    /**
     * @param $email
     */
    public function getNewPwd($email ){

    }
}
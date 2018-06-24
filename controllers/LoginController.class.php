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
        $user = new User();
        $form = $user->LoginForm();

        $v = new Views( "login", "header" );
        $v->assign("config", $form );
        $v->assign( "current", "login" );
    }


    /**
     * @internal param $login_
     * @internal param $mdp_
     */
    public function getVerify(){

        //Ca doit etre un objet
        $user = new User();
        $form = $user->LoginForm();
        //$errors = Validator::

        if( $_POST['email'] != '' ){

            $userInformations = $user->populate(
                array( "email" => $_POST['email'] )
            );

            if( empty( $userInformations) ){
                $errors[] = "L'utilisateur n'existe pas.";
            }
            else{
                $to_verify = array(
                    "email" => $userInformations->getEmail(),
                    "pwd" => $userInformations->getPwd()
                );

                $errors = Validator::login( $form, $to_verify );
            }


            if( empty( $errors ) ){
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
                $v = new Views( "login", "header" );
                $v->assign( "current", "login" );
                $v->assign("config",$form);
                $v->assign("errors",$errors);
            }


        }

    }

    /**
     * @param $email
     */
    public function getNewPwd($email ){

    }

    public function logout(){
        session_destroy();

        header("Location: ".DIRNAME."home/getHome");
    }
}
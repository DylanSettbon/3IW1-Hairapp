<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class LoginController extends BaseSql {



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

        $user = $this->getUser( $_POST['email'] );

        // verification du mdp
        if (password_verify( $_POST['pwd'], $user[0]['pwd'] ) == false ){
            echo "faux !";
        }
        else{
            echo "ok bien joué.";
        }



    }

    /**
     * @param $email
     */
    public function getNewPwd($email ){

    }
}
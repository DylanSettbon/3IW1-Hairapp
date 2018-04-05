<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class LoginController{


    private $login_;
    private $mdp_;



    /**
     * @return mixed
     */
    public function getLogin()
    {
        $v = new Views( "login", "header" );
    }



    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp_;
    }

    /**
     * @param mixed $mdp_
     */
    public function setMdp($mdp_)
    {
        $this->mdp_ = $mdp_;
    }


    /**
     * @param $login_
     * @param $mdp_
     */
    public function getVerify($login_, $mdp_ ){

    }

    /**
     * @param $email
     */
    public function getNewPwd($email ){

    }

}
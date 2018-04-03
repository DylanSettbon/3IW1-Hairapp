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
     * LoginController constructor.
     * @param $login_
     * @param $mdp_
     */
    public function __construct($login_, $mdp_)
    {
        $this->login_ = $login_;
        $this->mdp_ = $mdp_;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login_;
    }

    /**
     * @param mixed $login_
     */
    public function setLogin($login_)
    {
        $this->login_ = $login_;
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
<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:18
 */

class User extends BaseSql {

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $token;
    protected $number;
    protected $receivePromOffer = 0;
    protected $status=0;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = ucfirst(strtolower(trim($firstname)));
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname_
     */
    public function setLastname($lastname)
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email_
     */
    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd_
     */
    public function setPwd($pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null $token
     * @internal param mixed $token_
     */
    public function setToken($token = null){
        if( $token ){
            $this->token = $token;
        }else if(!empty($this->email)){
            $this->token = substr(sha1("GDQgfds4354".$this->email.substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }else{
            die("Veuillez préciser un email");
        }
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number_
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getReceivePromOffer()
    {
        return $this->receivePromOffer;
    }

    /**
     * @param int $receivePromOffer_
     */
    public function setReceivePromOffer($receivePromOffer)
    {
        $this->receivePromOffer = $receivePromOffer;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function sendConfirmEmail(){

    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getKind(). " ". $this->getLastname() . " " . $this->getFirstname() . " ".$this->getEmail() . " " .
            $this->getNumber() . " " . $this->getToken() . " " . $this->getReceivePromOffer() . " " . $this->getStatus() .
            " " . $this->getPwd();
    }


}
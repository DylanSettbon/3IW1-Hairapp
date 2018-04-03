<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:18
 */

class User extends BaseSql {

    private $id_ = null;
    private $firstname_;
    private $lastname_;
    private $email_;
    private $pwd_;
    private $token_;
    private $number_;
    private $kind_;
    private $receivePromOffer_ = 0;

    private $status=0;


    public function __construct(){
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id_;
    }

    /**
     * @param null $id_
     */
    public function setId($id_)
    {
        $this->id_ = $id_;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname_;
    }

    /**
     * @param mixed $firstname_
     */
    public function setFirstname($firstname_)
    {
        $this->firstname_ = ucfirst(strtolower(trim($firstname_)));
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname_;
    }

    /**
     * @param mixed $lastname_
     */
    public function setLastname($lastname_)
    {
        $this->lastname_ = strtoupper(trim($lastname_));
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email_;
    }

    /**
     * @param mixed $email_
     */
    public function setEmail($email_)
    {
        $this->email_ = strtolower(trim($email_));
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd_;
    }

    /**
     * @param mixed $pwd_
     */
    public function setPwd($pwd_)
    {
        $this->pwd_ = password_hash($pwd_, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token_;
    }

    /**
     * @param mixed $token_
     */
    public function setToken($token = null){
        if( $token ){
            $this->token_ = $token;
        }else if(!empty($this->email)){
            $this->token_ = substr(sha1("GDQgfds4354".$this->email_.substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }else{
            die("Veuillez préciser un email");
        }
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number_;
    }

    /**
     * @param mixed $number_
     */
    public function setNumber($number_)
    {
        $this->number_ = $number_;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind_;
    }

    /**
     * @param mixed $kind_
     */
    public function setKind($kind_)
    {
        $this->kind_ = $kind_;
    }

    /**
     * @return int
     */
    public function getReceivePromOffer()
    {
        return $this->receivePromOffer_;
    }

    /**
     * @param int $receivePromOffer_
     */
    public function setReceivePromOffer($receivePromOffer_)
    {
        $this->receivePromOffer_ = $receivePromOffer_;
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



}
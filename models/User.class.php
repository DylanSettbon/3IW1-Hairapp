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
    protected $tel;
    protected $receivePromOffer = 0;
    protected $status=0;
    protected $dateInserted;
    protected $dateUpdated;
    protected $lastConnection;
    protected $picture;


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
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $number_
     */
    public function setTel($number)
    {
        $this->tel = $number ;
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

    /**
     * @return mixed
     */
    public function getDateInserted()
    {
        return $this->dateInserted;
    }

    /**
     * @param mixed $dateInserted
     */
    public function setDateInserted($dateInserted)
    {
        $this->dateInserted = $dateInserted;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @param mixed $dateUpdated
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * @return mixed
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * @param mixed $lastConnection
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;
    }

    public function FormSignIn(){

        return [
            "config"=>["method"=>"POST", "action"=>"validate", "submit"=>"S'inscrire"],
            "input"=>[

                "prenom"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre prénom",
                    "required"=>true,
                    "minString"=>2,
                    "maxString"=>100
                ],
                "nom"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre nom",
                    "required"=>true,
                    "minString"=>2,
                    "maxString"=>100
                ],
                "email"=>[
                    "type"=>"email",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre email",
                    "required"=>true
                ],
                "emailConfirm"=>[
                    "type"=>"email",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Confirmation",
                    "required"=>true,
                    "confirm"=>"email"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Confirmation",
                    "required"=>true,
                    "confirm"=>"pwd"
                ],
                "tel" => [
                    "type" => "tel",
                    "class"=>"input input_sign-in",
                    "placeholder" => "Téléphone",
                    "required" => true
                ],
                "offers" => [
                    "type" => "checkbox",
                    "id" => "checkBox",
                    "span" => "Je souhaite recevoir par e-mail des offres promotionnelles"
                ]

            ],

            /*"textarea" =>[
                "commentaire" =>[
                    "placeholder" => 'texte'
                ]
            ]*/

        ];
    }

    public function AccountForm(){

        return [
            "config"=>["method"=>"POST", "action"=>"saveAccount", "submit"=>"Enregistrer"],
            "input"=>[


                "prenom"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre prénom",
                    "minString"=>2,
                    "maxString"=>100,
                    "value" => '',


                ],
                "nom"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre nom",
                    "minString"=>2,
                    "maxString"=>100,
                    "value" => ''
                ],
                "email"=>[
                    "type"=>"email",
                    "disable" => true,
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre email"
                ],
                /*"emailConfirm"=>[
                    "type"=>"email",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Confirmation",
                    "required"=>true,
                    "confirm"=>"email"
                ],*/
//                "pwd"=>[
//                    "type"=>"password",
//                    "class"=>"input input_sign-in",
//                    "placeholder"=>"Votre mot de passe"
//                ],
//                "pwdConfirm"=>[
//                    "type"=>"password",
//                    "class"=>"input input_sign-in",
//                    "placeholder"=>"Confirmation",
//                    "confirm"=>"pwd"
//                ],
                "tel" => [
                    "type" => "tel",
                    "class"=>"input input_sign-in",
                    "placeholder" => "Téléphone",
                    "required" => true
                ],
                "picture" => [
                    "type" => 'file',
                    "class"=>"input input_sign-in",
                    'id' => 'picture',
                    "placeholder" => "Photo de profile"
                ],
                "offers" => [
                    "type" => "checkbox",
                    "id" => "checkBox",
                    "span" => "Je souhaite recevoir par e-mail des offres promotionnelles"
                ],

            ],

            /*"textarea" =>[
                "commentaire" =>[
                    "placeholder" => 'texte'
                ]
            ]*/

        ];
    }

    public function ChangePwdForm(){

        return [
            "config"=>["method"=>"POST", "action"=>"saveAccount", "submit"=>"Changer le mot de passe"],
            "input"=>[
                "pwd"=>[
                    "type"=>"password",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre mot de passe"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Confirmation",
                    "confirm"=>"pwd"
                ],
            ],
        ];
    }

    public function LoginForm(){
        return [
            "config"=>["method"=>"POST", "action"=>"getVerify", "submit"=>"Se connecter"],
            "input"=>[
                "email"=>[
                    "type"=>"email",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre email",
                    "required"=>true
                ],
                "pwd"=>[
                    "type"=>"password",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }




    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getLastname() . " " . $this->getFirstname() . " ".$this->getEmail() . " " .
            $this->getTel() . " " . $this->getToken() . " " . $this->getReceivePromOffer() . " " . $this->getStatus() .
            " " . $this->getPwd();
    }


}
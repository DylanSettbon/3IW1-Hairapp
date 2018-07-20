<?php


class Message extends BaseSql {

    protected $id = null;
    protected $lastname;
    protected $email;
    protected $objet;
    protected $message;
   


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
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param mixed $pwd_
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
   

    /**
     * @param mixed $number_
     */
    public function setMessage($message)
    {
        $this->message = $message ;
    }

    public function formContact(){

        return [
            "config"=>["method"=>"POST", "action"=>"validate", "submit"=>"Enregistrer"],
            "input"=>[



                "nom"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Nom",
                    "required"=>true
                    

                ],

                "email"=>[
                    "type"=>"email",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre Email",
                    "required"=>true
                    
                ],
            
                "objet"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Objet",
                    "required"=>true
                    
                ]


            ],

			"textarea" =>[
                "message" =>[
                    "type"=>"textarea",
                    "placeholder" => 'Message',
                    "class"=>"input input_sign-in ckeditor",
                    "rows" => "4",
                    "cols" => "40",
                    "maxString" => 2000,
                    "required"=>true
                ]
            ]

        ];
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 09/04/2018
 * Time: 19:05
 */

class Install extends BaseSql {
    protected $id=null;
    protected $admin;
    protected $logo;
    protected $image;
    protected $color;

    private $client_id;
    private $domain;
    private $domain_address;
    private $main_colors;

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
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getDomainAddress()
    {
        return $this->domain_address;
    }

    /**
     * @param mixed $domain_address
     */
    public function setDomainAddress($domain_address)
    {
        $this->domain_address = $domain_address;
    }

    /**
     * @return mixed
     */
    public function getMainColors()
    {
        return $this->main_colors;
    }

    /**
     * @param mixed $main_colors
     */
    public function setMainColors($main_colors)
    {
        $this->main_colors = $main_colors;
    }


    public function configForm(){

        return [
            "config"=>["method"=>"POST", "action"=>"install/save", "submit"=>"Valider", "class" => "", "id" => "configForm"],

            "div" => [

                "1" => [
                    "input"=>[

                        "name"=>[
                            "type"=>"text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Nom de votre site",
                            "required"=>true,
                            "minString"=>2,
                            "maxString"=>100
                        ],
                        "domain"=>[
                            "type"=>"text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Nom de domaine",
                            "required"=>true,
                            "minString"=>2,
                            "maxString"=>100
                        ],
                    ],
                    "class" => 'tab',
                    "steps" => "Etape 1 : Identité du site",
                ],

                "2" => [
                    "input"=>[

                        "application_mail"=>[
                            "type"=>"email",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Email ( utilisé pour les notifications aux utilisateurs )",
                            "required"=>true,
                            "maxString"=>150
                        ],
                        "application_pwd"=>[
                            "type"=>"password",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Mot de passe du compte mail",
                            "required"=>true,
                            "maxString"=>100
                        ],
                        "logo" => [
                            "type" => 'file',
                            "class"=>"input input_sign-in",
                            'id' => 'logo',
                            "placeholder" => "Logo du site"
                        ],
                        "favicon" => [
                            "type" => 'file',
                            "class"=>"input input_sign-in",
                            'id' => 'favicon',
                            "placeholder" => "Favicon ( utilisé dans les onglets )"
                        ],

                        "facebook" => [
                            "type" => "text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Lien de votre compte Facebook",
                        ],
                        "twitter" => [
                            "type" => "text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Lien de votre compte Twitter",
                        ],
                        "instagram" => [
                            "type" => "text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Lien de votre compte Instagram",
                        ],
                        "pinterest" => [
                            "type" => "text",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Lien de votre compte Pinterest",
                        ]
                    ],
                    "class" => "tab",
                    "steps" => "Etape 2 : Configuration du site",
                ],

                "3" => [
                    "input"=>[

                        "opening"=>[
                            "type"=>"time",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Horaire d'ouverture",
                            "required"=>true,
                            "id" => "opening"
                        ],
                        "closing"=>[
                            "type"=>"time",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Horaire de fermeture",
                            "required"=>true,
                            "id" => "closing"
                        ],
                        "duration" => [
                            "type"=>"time",
                            "class"=>"input input_sign-in",
                            "placeholder"=>"Durée moyenne d'un rendez-vous",
                            "required"=>true,
                            "id" => "duration"
                        ],
                        "address" => [
                          "type" => "text",
                          "class"=>"input input_sign-in",
                          "placeholder"=>"Adresse du salon",
                          "required"=>true,
                        ]
                    ],
                    "class" => "tab",
                    "steps" => "Etape 3 : Informations sur le salon",
                ],

                "4" => [
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
                        "data" => [
                          "type" => 'checkbox',
                          "span" => "Je souhaite remplir mon site avec un jeu de données par défaut"
                        ]

                    ],
                    "class" => "tab",
                    "steps" => "Etape 4 : Création de votre compte",
                ],


            ],

        ];
    }
}

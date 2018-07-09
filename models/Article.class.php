<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:19
 */

class Article extends BaseSql {
    protected $id=null;
    protected $name;
    protected $description;
    protected $dateparution;
    protected $minidescription;
    protected $image;
    protected $status;
    protected $id_Category;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getDateParution()
    {
        return $this->dateparution;
    }

    /**
     * @param mixed $name
     */
    public function setDateParution($dateparution)
    {
        $this->dateparution = $dateparution;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getMiniDescription()
    {
        return $this->minidescription;
    }

    /**
     * @param mixed $minidescription
     */
    public function setMiniDescription($minidescription)
    {
        $this->minidescription = $minidescription;
    }
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $minidescription
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $minidescription
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->id_Category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->id_Category = $category;
    }

    /*public function sortArticleOnStatus($articles){
        $sortArticles = []
        foreach ($articles as $article ) {
            $sortArticles[$article->getStatus()]= $article
        }
        krsort($sortArticles);
        return array_values($sortArticles);
    }*/

    public function formArticle(){

        return [
            "config"=>["method"=>"POST", "action"=>"addAdminArticle", "submit"=>"Enregistrer"],
            "input"=>[

                "name"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Titre de l'article",
                    "required"=>true


                ],
                "picture"=>[
                    "type"=>"file",
                    "class"=>"input input_sign-in",
                    'id' => 'picture',
                    "placeholder"=>"Votre image"
                ]

            ],

            "textarea" =>[
                "description" =>[
                    "placeholder" => 'description',
                    "class"=>"input input_sign-in",
                    "rows" => "4",
                    "cols" => "40",
                    "maxString" => 2000,
                    "required"=>true
                ]
            ],

            "select" => [
                "category" =>[
                    "class" => "input input_sign-in"
                ]
            ]

        ];
    }

    public function formUpdateArticle(){

        return [
            "config"=>["method"=>"POST", "action"=>"modifyAdminArticle", "submit"=>"Enregistrer"],
            "input"=>[

                "id"=>[
                    "type"=>"hidden",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Id",


                ],

                "name"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Titre de l'article",
                    "required"=>true


                ],
                "dateparution"=>[
                    "type"=>"date",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Date"


                ],
                "picture"=>[
                    "type"=>"file",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Votre image"
                ]


            ],

            "textarea" =>[
                "description" =>[
                    "type"=>"textarea",
                    "placeholder" => 'description',
                    "class"=>"input input_sign-in",
                    "rows" => "4",
                    "cols" => "40",
                    "maxString" => 2000,
                    "required"=>true
                ]
            ],

            "select" => [
                "category" =>[
                    "class" => "input input_sign-in"
                ]
            ]

        ];
    }

}
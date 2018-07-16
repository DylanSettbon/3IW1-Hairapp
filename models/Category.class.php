<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 24/04/2018
 * Time: 14:33
 */
class Category extends BaseSql
{
    protected $id_category = null;
    protected $description_category;
    protected $id_User;
    protected $id_CategoryType;
    protected $status_category;

    /*
    public function __construct()
    {
        $ctps = func_num_args();
        $args = func_get_args();

        switch ($ctps){
            case 0:
                break;
            case 1:
                $this->description = $args[0];
                break;
            case 2:
                $this->description = $args[0];
                $this->id_User = $args[1];
                break;
            case 3 :
                $this->description = $args[0];
                $this->id_User = $args[1];
                $this->id_CategoryType = $args[2];
                break;
            default:
                exit();
                break;
        }
    }
    */

    public function getId()
    {
        return $this->id_category;
    }

    public function setId($id)
    {
        $this->id_category = $id;
    }


    public function getDescription()
    {
        return $this->description_category;
    }

    public function setDescription($description)
    {
        $this->description_category = $description;
    }


    public function getIdUser()
    {
        return $this->id_User;
    }

    public function setIdUser($id_User)
    {
        $this->id_User = $id_User;
    }

    public function getIdCategoryType()
    {
        return $this->id_CategoryType;
    }


    public function setIdCategoryType($id_CategoryType)
    {
        $this->id_CategoryType = $id_CategoryType;
    }

    public function getStatus()
    {
        return $this->status_category;
    }

    public function setStatus($id_Status)
    {
        $this->status_category = $id_Status;
    }

    public function checkIfCategoryDescriptionExistsAndNotNull($status = null){
        if($this->description_category == ""){return false;}
        //Status = 0, les categorie sont inactif
        //Status = 1, les categoris actifs
        //Status = 2, Toutes les categories;

        if($status == 0){
            return $this->countTable('Category',['description' => $this->description_category,'status' => $status]) != 0 ? true : false;
        }
        else if($status == 1){
            return $this->countTable('Category',['description' => $this->description_category,'status' => '1']) != 0 ? true : false;
        }
        else if($status == 2) {
            return $this->countTable('Category', ['description' => $this->description_category]) > 0 ? true : false;
        }
    }

    public static function getCategoriesWithPackage($categories){
        foreach($categories as $i=>$category) {
            $package = new Package();
            $packages = $package->getAllBy(['id_Category' => $category->getId()], null, 2);
            if (empty($packages)) {
                unset($categories[$i]);
            }
        }
        return array_values($categories);
    }

    public function formAddCategory(){

        return [
            "config"=>["method"=>"POST", "action"=>"addAdminCategory", "submit"=>"Enregistrer"],
            "input"=>[

                "description"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Nom de la categorie",
                    "required"=>true


                ]

            ],


            

        ];
    }

     public function formUpdateCategory(){

        return [
            "config"=>["method"=>"POST", "action"=>"modifyAdminCategory", "submit"=>"Enregistrer"],
            "input"=>[
                "id"=>[
                    "type"=>"hidden",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Nom de la categorie"
                ],

                "description"=>[
                    "type"=>"text",
                    "class"=>"input input_sign-in",
                    "placeholder"=>"Nom de la categorie",
                    "required"=>true


                ]

            ],


            

        ];
    }
}


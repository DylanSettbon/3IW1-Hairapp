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
    protected $displayOrder;

    /**
     * @return mixed
     */

    public function __construct($type = null)
    {
        // 1 : Article
        // 2 : Produit
        // 3 : Forfaits
        parent::__construct();
        isset($type)?$this->id_CategoryType = $type : '';
    }

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

    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder($displayOrder)
    {
        $countCategory = $this->countTable(null,['status_category' => '1','id_CategoryType' => $this->getIdCategoryType()]);
        $displayOrder = $displayOrder > $countCategory ? $countCategory +1 : $displayOrder;
        $displayOrder = $displayOrder < 1 ? 1 : $displayOrder;
        $this->displayOrder = $displayOrder;
    }

    public function checkIfCategoryDescriptionExists($status = null)
    {
        //Status = 0, les categorie sont inactif
        //Status = 1, les categoris actifs
        //Status = 2, Toutes les categories;
        if ($status == 0) {
            return $this->countTable(null,['description_category' => $this->description_category, 'status_category' => $status,'id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;
        } else if ($status == 1) {
            return $this->countTable(null,['description_category' => $this->description_category, 'status_category' => '1','id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;
        } else if ($status == 2) {
            return $this->countTable(null,['description_category' => $this->description_category,'id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;

        }
    }

    public static function getCategoriesWithPackage($categories)
    {
        foreach ($categories as $i => $category) {
            $package = new Package();
            $packages = $package->getAllBy(['id_Category' => $category->getId()], null, 2);
            if (empty($packages)) {
                unset($categories[$i]);
            }
        }
        return array_values($categories);
    }

    public static function getCategoriesSortedByOrder($categories)
    {
        usort($categories, function($a, $b)
        {
            return $a->getDisplayOrder() > $b->getDisplayOrder();
        });
        return $categories;
    }

    public function formAddCategory()
    {

        return [
            "config" => ["method" => "POST", "action" => "addAdminCategory", "submit" => "Enregistrer"],
            "input" => [

                "description" => [
                    "type" => "text",
                    "class" => "input input_sign-in",
                    "placeholder" => "Nom de la categorie",
                    "required" => true
                ]

            ],


        ];
    }

    public function formUpdateCategory()
    {

        return [
            "config" => ["method" => "POST", "action" => "modifyAdminCategory", "submit" => "Enregistrer"],
            "input" => [
                "id" => [
                    "type" => "hidden",
                    "class" => "input input_sign-in",
                    "placeholder" => "Nom de la categorie"
                ],

                "description" => [
                    "type" => "text",
                    "class" => "input input_sign-in",
                    "placeholder" => "Nom de la categorie",
                    "required" => true


                ]

            ],


        ];
    }

    public function formAddCategoryForPackageAdmin()
    {
        return [
            "config" => ["class" => "formPackage createCategoryPackage", "method" => "POST", "action" => "admin/saveCategoryPackage"],
            "h2" => [
                "value" => "Ajouter une catégorie"
            ],
            "input" => [
                "categoryDesc" => [
                    "id" => "categoryDesc",
                    "type" => "text",
                    "placeholder" => "Entrez le nom de votre catégorie",
                    "required" => true
                ],
                "categoryOrder" => [
                    "id" => "categoryOrder",
                    "type" => "text",
                    "placeholder" => "Entrez l'ordre d'apparition",
                ],
                "categoryPackageSubmit" => [
                    "class" => "btnFormCategory",
                    "type" => "submit",
                    "value" => "Valider"
                ],
                "categoryPackageCancel" => [
                    "class" => "btnFormCategory",
                    "type" => "submit",
                    "value" => "Annuler",
                ],

            ],
        ];
    }

    public function formUpdateCategoryForPackageAdmin()
    {
        return [
            "config" => ["class" => "formPackage createCategoryPackage", "method" => "POST", "action" => "admin/saveCategoryPackage"],
            "h2" => [
                "value" => "Modifier le nom de la catégorie"
            ],
            "input" => [
                "categoryId" => [
                    "id" => "categoryIdUpdate",
                    "type" => "hidden",
                ],
                "categoryDesc" => [
                    "id" => "categoryDescUpdate",
                    "type" => "text",
                ],
                "categoryOrder" => [
                    "id" => "categoryOrderUpdate",
                    "type" => "text",
                    "placeholder" => "Entrez l'ordre d'apparition",
                ],
                "categoryPackageSubmit" => [
                    "class" => "btnFormCategory",
                    "type" => "submit",
                    "value" => "Valider"
                ],
                "categoryPackageCancel" => [
                    "class" => "btnFormCategory",
                    "type" => "submit",
                    "value" => "Annuler",
                ],
            ],
        ];
    }
}


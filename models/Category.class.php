<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 24/04/2018
 * Time: 14:33
 */
class Category extends BaseSql
{
    protected $id = null;
    protected $description;
    protected $id_User;
    protected $id_CategoryType;
    protected $status;
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
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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
        return $this->status;
    }

    public function setStatus($id_Status)
    {
        $this->status = $id_Status;
    }

    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder($displayOrder)
    {
        $countCategory = $this->countTable(null,['status' => '1','id_CategoryType' => $this->getIdCategoryType()]);
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
            return $this->countTable(null,['description' => $this->description, 'status' => $status,'id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;
        } else if ($status == 1) {
            return $this->countTable(null,['description' => $this->description, 'status' => '1','id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;
        } else if ($status == 2) {
            return $this->countTable(null,['description' => $this->description,'id_CategoryType' => $this->getIdCategoryType()]) > 0 ? true : false;
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
            "config" => ["class" => "formPackage createCategoryPackage", "method" => "POST", "action" => "/admin/saveCategoryPackage"],
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
            "config" => ["class" => "formPackage createCategoryPackage", "method" => "POST", "action" => "/admin/saveCategoryPackage"],
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


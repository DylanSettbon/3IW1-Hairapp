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

    public function checkIfCategoryDescriptionExists(){
        return $this->countTable('Category',['description' => $this->description]) != 0 ? true : false;
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
}


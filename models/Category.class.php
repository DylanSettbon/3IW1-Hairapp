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
}


<?php
class Package extends BaseSql {
    protected $id = null;
    protected $description;
    protected $price;
    protected $id_Category;
    protected $id_User;

    //getters and setters
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->id_Category;
    }

    /**
     * @param mixed $id_Category
     */
    public function setIdCategory($id_Category)
    {
        $this->id_Category = $id_Category;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_User;
    }

    /**
     * @param mixed $id_User
     */
    public function setIdUser($id_User)
    {
        $this->id_User = $id_User;
    }





}
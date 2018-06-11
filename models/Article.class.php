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
    public function setId($id): void
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
    public function setName($name): void
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
    public function setDateParution($dateparution): void
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
    public function setDescription($description): void
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
    public function setMiniDescription($minidescription): void
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
    public function setImage($image): void
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
    public function setStatus($status): void
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
    public function setCategory($category): void
    {
        $this->id_Category = $category;
    }

}
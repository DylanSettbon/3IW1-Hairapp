<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 08/04/2018
 * Time: 20:59
 */

class ArticleCategory extends BaseSql
{
    protected $id=null;
    protected $name;

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
}
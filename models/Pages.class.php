<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 24/04/2018
 * Time: 14:23
 */

class Pages extends BaseSql
{

    private $title;
    private $id;
    private $content;
    private $isNavbar;
    private $url;
    private $active;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $title = str_replace(' ', '_', $title );
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getisNavbar()
    {
        return $this->isNavbar;
    }

    /**
     * @param mixed $isNavbar
     */
    public function setIsNavbar($isNavbar)
    {
        $this->isNavbar = $isNavbar;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }



}
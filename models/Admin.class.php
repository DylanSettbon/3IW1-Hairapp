<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:20
 */

class Admin extends BaseSql {

    private $theme;

    private $main_color;
    private $second_color;
    private $title_color;
    private $main_button_color;
    private $second_button_color;

    private $planning;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getMainColor()
    {
        return $this->main_color;
    }

    /**
     * @param mixed $main_color
     */
    public function setMainColor($main_color)
    {
        $this->main_color = $main_color;
    }

    /**
     * @return mixed
     */
    public function getSecondColor()
    {
        return $this->second_color;
    }

    /**
     * @param mixed $second_color
     */
    public function setSecondColor($second_color)
    {
        $this->second_color = $second_color;
    }

    /**
     * @return mixed
     */
    public function getTitleColor()
    {
        return $this->title_color;
    }

    /**
     * @param mixed $title_color
     */
    public function setTitleColor($title_color)
    {
        $this->title_color = $title_color;
    }

    /**
     * @return mixed
     */
    public function getMainButtonColor()
    {
        return $this->main_button_color;
    }

    /**
     * @param mixed $main_button_color
     */
    public function setMainButtonColor($main_button_color)
    {
        $this->main_button_color = $main_button_color;
    }

    /**
     * @return mixed
     */
    public function getSecondButtonColor()
    {
        return $this->second_button_color;
    }

    /**
     * @param mixed $second_button_color
     */
    public function setSecondButtonColor($second_button_color)
    {
        $this->second_button_color = $second_button_color;
    }

    public function getPlanning( $id_coiffeur = null ){
        

    }

}
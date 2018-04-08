<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:19
 */

class Home extends BaseSql {

    private $is_connected = false;

    private $number_of_articles;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function isConnected(): bool
    {
        return $this->is_connected;
    }

    /**
     * @param bool $is_connected
     */
    public function setIsConnected(bool $is_connected)
    {
        $this->is_connected = $is_connected;
    }

    /**
     * @return mixed
     */
    public function getNumberOfArticles()
    {
        return $this->number_of_articles;
    }

    /**
     * @param mixed $number_of_articles
     */
    public function setNumberOfArticles($number_of_articles)
    {
        $this->number_of_articles = $number_of_articles;
    }

    
}
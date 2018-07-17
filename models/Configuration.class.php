<?php

/**
 *
 */
class Configuration extends BaseSql
{



    private $id_config = null;
    private $logo;
    private $email_address;
    private $email_pwd;
    private $postal_address;
    private $status_configuration;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getIdConfig()
    {
        return $this->id_config;
    }

    /**
     * @param null $id_config
     */
    public function setIdConfig($id_config)
    {
        $this->id_config = $id_config;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * @param mixed $email_address
     */
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
    }

    /**
     * @return mixed
     */
    public function getEmailPwd()
    {
        return $this->email_pwd;
    }

    /**
     * @param mixed $email_pwd
     */
    public function setEmailPwd($email_pwd)
    {
        $this->email_pwd = password_hash($email_pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postal_address;
    }

    /**
     * @param mixed $postal_address
     */
    public function setPostalAddress($postal_address)
    {
        $this->postal_address = $postal_address;
    }

    /**
     * @return mixed
     */
    public function getStatusConfiguration()
    {
        return $this->status_configuration;
    }

    /**
     * @param mixed $status_configuration
     */
    public function setStatusConfiguration($status_configuration)
    {
        $this->status_configuration = $status_configuration;
    }



  
}

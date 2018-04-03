<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:16
 */

class BaseSql{

    public function __construct(){
        try{
            $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME , DBUSER, DBPWD);
        }catch(Exception $e){
            die("Erreur SQL :".$e->getMessage());
        }
    }

    public function save(){

    }
}
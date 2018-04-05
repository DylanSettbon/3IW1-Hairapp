<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:16
 */

class BaseSql{

    private $pdo;
    private $table;
    private $columns;

    public function __construct(){
        try{
            $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME , DBUSER, DBPWD);
        }catch(Exception $e){
            die("Erreur SQL :".$e->getMessage());
        }
        $this->table = strtolower(get_called_class());
    }


    public function setColumns(){


        $this->columns = array_diff_key(
            get_object_vars( $this ),
            get_class_vars( get_class() )
        );
    }


    public function save(){

        $this->setColumns();

        if( $this->id ){
            //UPDATE
            foreach ($this->columns as $key => $value) {
                $sqlSet[] = $key."=:".$key;
            }

            $query = $this->pdo->prepare(" UPDATE ".$this->table." SET ".implode(",", $sqlSet)." WHERE id=:id ");

            $query->execute($this->columns);


        }else{
            //INSERT
            unset($this->columns['id']);

            $query = $this->pdo->prepare("
					INSERT INTO ".$this->table." 
					(". implode(",", array_keys($this->columns)) .")
					VALUES
					(:". implode(",:", array_keys($this->columns)) .")
				");
            //print_r ( $this->columns );
            $query->execute($this->columns);

        }



    }
}
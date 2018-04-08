<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:16
 */

class BaseSql{

    protected $db;
    private $table;
    private $columns;
    private static $_instance;



    public function __construct(){
        try{
            $this->db = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME , DBUSER, DBPWD);
        }catch(Exception $e){
            die("Erreur SQL :".$e->getMessage());
        }
        //$this->db = new Database();

        $this->table = strtolower(get_called_class());
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
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

            $query = $this->db->prepare(" UPDATE ".$this->table." SET ".implode(",", $sqlSet)." WHERE id=:id ");

            $query->execute($this->columns);


        }else{
            //INSERT
            unset($this->columns['id']);

            $query = $this->db->prepare("
					INSERT INTO ".$this->table." 
					(". implode(",", array_keys($this->columns)) .")
					VALUES
					(:". implode(",:", array_keys($this->columns)) .")
				");
            print_r ( $this->columns );
            $query->execute($this->columns);

        }

    }

    public function select( $sql, $params ){
        $query = $this->db->prepare( $sql );
        $query->execute( $params );
        $res = $query->fetchAll();
        return $res;
    }

    public function getUser( $email ){

        $sql = "SELECT email, pwd FROM user WHERE email = :mail";
        $params = array( "mail" => $email );

        $res = self::select( $sql, $params );

        return $res;

    }


}
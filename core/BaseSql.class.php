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

    /**
     * Tab for prepare statement
     */

    public function __construct(){
        try{;
            $this->db = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME , DBUSER, DBPWD);
        }catch(Exception $e){
            die("Erreur SQL :".$e->getMessage());
        }
        //$this->db = new Database();

        $this->table = strtolower(get_called_class()) == "hairdresser" ? "user" : strtolower(get_called_class());
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

    public function update( $statement, $params ){

        $query = $this->db->prepare( $statement );

        $query->execute( $params );
    }

    public function generateToken( $email ){
       $token = substr(sha1("GDQgfds4354".$email.substr(time(), 5).uniqid()."gdsfd"), 2, 10);

       return $token;
    }

    public static function bindParams($params, $params_remove=array()) {
        $result = array();
        if(empty($params)) {
            throw new PDOException('Empty array for binding');
        }
        $result['fields'] = implode(',', array_keys($params));
        $tmp1 = array();
        $tmp2 = array();
        $tmp3 = array();
        $tmp4 = array();
        $tmp5 = array();

        foreach($params as $key => $value) {
            $tmp1[] = ':'.$key;
            $tmp2[] = $key.'=:'.$key;
            $tmp4[] = $key.' <> :'.$key;
            if(!in_array($key, $params_remove)) {
                $tmp3[] = $key.'=:'.$key;
            }
        }

        if( isset( $params['min'] ) && isset( $params['max'] )  ){
            $result['min_max'] = " BETWEEN '" . $params['min'] . "' AND '" . $params['max'] ."'";
        }

        if( isset( $params['min_to'] )   ){
            $result['min_to'] = " <= '" . $params['min_to'] . "'";
        }
        if( isset( $params['max_to'] )   ){
            $result['max_to'] = " >= '" . $params['max_to']. "'";
        }

        if( isset( $params['inner_table']) && isset( $params['inner_table']) && isset($params['inner_column']) ){
            $result['inner'] = '';
            for ($i=0; $i < count($params['inner_table']) ; $i++) {
                $result['inner'] .= " INNER JOIN ". $params['inner_table'][$i] . " ON " . $params['inner_column'][$i] . " = " . $params['inner_ref_to'][$i];
                $result['inner'];
            }
        }


        $result['bind_insert'] = implode(',', $tmp1);
        $result['bind_update'] = implode(',', $tmp2);
        $result['bind_delete'] = implode(' OR ', $tmp2);
        $result['bind_onduplicate'] = implode(',', $tmp3);
        $result['bind_primary_key'] = implode(' AND ', $tmp3);
        $result['not_in'] = implode(' AND ', $tmp4);
        return $result;
    }


    public function beginTransaction() {
        $this->db->beginTransaction();
    }
    /**
     *
     */
    public function commit() {
        $this->db->commit();
    }
    /**
     *
     */
    public function rollback() {
        $this->db->rollback();
    }


    /**
     *
     */
    private function fetch($sql, $params, $type, $index_by = null) {
        $result = false;
        $time = microtime(true);
        //$this->history($sql, $params);
        $st = $this->db->prepare($sql);
        $res = $st->execute($params);

        if('fetch_row'===$type) {
            $result = $st->fetch();
        } else if('fetch_one'===$type) {
            $result = $st->fetchColumn();
        } else {
            $tmp = $st->fetchAll();
            if(!empty($index_by) && isset($tmp[0][$index_by])) {
                $result = array();
                for($i=0; isset($tmp[$i]); $i++) {
                    $index = $tmp[$i][$index_by];
                    if(!isset($result[$index])) {
                        $result[$index] = array();
                    }
                    $result[$index][] = $tmp[$i];
                }
            } else {
                $result = $tmp;
            }
        }
        return $result;
    }

    /**
     *
     */
    public function fetchAll($sql, $params=null, $index_by = null) {
        return $this->fetch($sql, $params, 'fetch_all', $index_by);
    }
    /**
     *
     */
    public function fetchRow($sql, $params=null) {
        return $this->fetch($sql, $params, 'fetch_row');
    }
    /**
     *
     */
    public function fetchOne($sql, $params=null) {
        return $this->fetch($sql, $params, 'fetch_one');
    }


    /**
     * @param $table
     * @param $fields
     * @param $fields_primary_key
     * @param array $options
     */
    public function updateTable($fields, $fields_primary_key = null , $options=array()) {
        $res = null;
        $found = 0;
        $table = $this->table;
        //$options = array_change_key_case((array)$options, CASE_LOWER);

        if( $fields_primary_key != null ){
            $bind_pk = $this->bindParams($fields_primary_key);
            $found = $this->countTable($table, $fields_primary_key);
        }
        $bind = $this->bindParams($fields);

        if( isset( $fields_primary_key ) ){
            $sql_params = array_merge($fields, $fields_primary_key);
        }
        else{
            $sql_params = $fields;
        }

        if( $found == 0 ){
            $bind['fields'] = ltrim( $bind['fields'], ',' );
            $sql_upd = 'INSERT INTO '.$table.' ('.$bind['fields'].') VALUES ('.$bind['bind_insert'].')';

        }
        else{
            $sql_upd = 'UPDATE '.$this->table.' SET '.$bind['bind_update'].' WHERE '.$bind_pk['bind_primary_key'];

        }

        $this->update($sql_upd, $sql_params);
    }

    public function delete($fields){
        $table = $this->table;
        $bind_pk = $this->bindParams($fields)['bind_update'];
        $bind_pk = ltrim( $bind_pk, ' ,' );
        $sql_upd = 'DELETE FROM  '.$this->table.' WHERE '.$bind_pk.';';
        $this->update($sql_upd, $fields);
    }
    /**
     * @param $table
     * @param $fields_primary_key
     * @return array|bool|mixed
     */
    public function countTable($table, $fields_primary_key) {
        $table = basename($table);
        $bind_pk = $this->bindParams($fields_primary_key);
        $sql_count = 'SELECT COUNT(*) FROM '.$table.' WHERE '.$bind_pk['bind_primary_key'];
        $found = $this->fetchOne($sql_count, $fields_primary_key);
        return $found;
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

            $query = $this->db->prepare("INSERT INTO ".$this->table."(". implode(",", array_keys($this->columns)) .")VALUES(:". implode(",:", array_keys($this->columns)) .")");
            $query->execute($this->columns);

        }

    }
    public function getUpdate($where,$choix, $column ){
        // $where = ["diff_status"=>-1, "id"=>3 ]
            if($choix == 1){
             $sql = $this->db->prepare('Update ' .$this->table.' set ' .$column.' WHERE '
                 .$where);
            }
            if ($choix == 2){
                $sql = $this->db->prepare('Select ' .$column. ' FROM ' .$this->table. ' WHERE '
                .$where);
            }
            if ($choix == 3){
                $sql = $this->db->prepare('Delete from ' .$this->table. ' WHERE ' .$where);
            }
            if ($choix ==4){
                $sql = $this->db->prepare('Insert into ' .$this->table. ' ' .$column. '');
            }
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_CLASS, ucfirst( $this->table ) );
            return $result;
        }

    public function select($params){
        $query = $this->db->prepare("SELECT * FROM ".$params.";");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function getAllBy($where = [], $columns = null, $tab = null,$inner = null){
        // $where = ["diff_status"=>-1, "id"=>3 ]
         if(is_null($columns)){
             $select="*";
         }else {
             $select = implode(",", $columns);
         }

         if( $where != null ){
             $bind= $this->bindParams($where);
             $sql_params= $where;

             if( isset( $inner['inner_table']) ){
                 $bind_inner = $this->bindParams($inner);
                 $from = $this->table . $bind_inner['inner'];
             }
             else{
                 $from = $this->table;
             }

             if( $tab == 1 ){
                 $where_type = $bind['bind_insert'];
             }elseif ( $tab == 2 ){
                 $where_type = $bind['bind_update'];
             }elseif ( $tab == 3 ){
                 $where_type = $bind['bind_primary_key'];
             }elseif ( $tab == 4 ){
                 $where_type = $bind['not_in'];
             }elseif ( $tab == 5 ){
                 $where_type = $columns[0] . $bind['min_max'];
             }
             elseif ( $tab == 6 ){
                 $where_type = $columns[0] . $bind['min_to'];
             }
             elseif ( $tab == 7 ){
                 $where_type = $columns[0] . $bind['max_to'];
             }

             $sql = $this->db->prepare('SELECT ' .$select.
                 ' FROM '.$from.' WHERE '
                 .$where_type);

             $sql->execute($sql_params);

         }
         else{
             if( isset( $inner['inner_table']) ){
                 $bind = $this->bindParams($inner);
                 $from = $this->table . $bind['inner'];
             }
             else{
                 $from = $this->table;
             }
             $sql = $this->db->prepare('SELECT ' .$select.
                 ' FROM '.$from
             );
             $sql->execute();
         }

            $result = $sql->fetchAll(PDO::FETCH_CLASS, ucfirst( $this->table ) );
            return $result;
        }


    /**
     * @param array $where
     * @return Object
     */
    public function populate($where = []){

        $sql = $this->db->prepare( "SELECT * FROM user WHERE email = :email" );
        //->fetchObject('User');
        $sql->execute( $where );
        $result = $sql->fetchObject('User');


        //return objet
        return $result;

    }

}

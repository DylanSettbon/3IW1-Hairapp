<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:11
 */

class InstallController{


    public function __construct($opts = array()) {
//        if( '3ce5e903315a66057c73a4d7d4105c4a' !== md5('gjdhgk5675'.$_SERVER['PHP_AUTH_USER'].$_SERVER['PHP_AUTH_PW'])) {
//            header('WWW-Authenticate: Basic realm="Identification"');
//            header('HTTP/1.0 401 Unauthorized');
//            die('access denied');
//        }
    }

    public function getInstall(){

        $view = new Views( 'install', 'install_header');
        $view->assign("current", 'install' );
        $install = new Install();
        $form = $install->configForm();

        $view->assign( "config", $form);

    }

    public function save( $params ){

        /*
         * TODO:
         * 1) vérifications des champs ✓
         * 2) séparation entre infos user et infos site
         * 5) voir comment créer bdd auto avec nom du client ✓
         * 6) intégrer le fichier SQL dedans ✓
         * 7) insérer les données du User dans users en tant qu'admin
         * 8) modifier le conf.inc.php et ajouter les globales pour les horaires du salon si elles n'existent pas ✓
         */

        self::changeConfigFile( "conf.inc.php", $params['POST'] );

        $install = new Install();
        $user = new User();

        $form = $install->configForm();

        //var_dump( $params['POST'] ); die;
        $user->setFirstname($params['POST']['prenom']);
        $user->setLastname($params['POST']['nom']);
        $user->setEmail($params['POST']['email']);
        $user->setPwd($params['POST']['pwd']);
        $user->setToken();
        $user->setTel( $params['POST']['tel'] );
        $user->setStatus( 3 );

        $errors = Validator::validateInstall( $form, $params['POST'] );

        //self::changeConfigFile( "conf.inc.php", $params['POST'] );

        if( empty( $errors ) ){

            // Execution du fichier SQL
            $sql = self::executeQueryFile( "sql/HairApp.sql", $params['POST']['name'] );

            //var_dump( $sql ); die;
            /*
             * Debut de la transaction
             * Creation de la base de données
             */
            $install->beginTransaction();
            try{
                for ($i=0; $i < count($sql) ; $i++) {
                    $str = $sql[$i];
                    if ($str != '') {
                        $str .= ';';
                        $install->createDatabase( $str );
                        //execution des requetes
                    }
                }
                $install->commit();
            }catch ( Exception $e){
                echo $e->getMessage();
                $install->rollback();
            }


            $userParams = array(
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "email" => $user->getEmail(),
                "pwd" => $user->getPwd(),
                "token" => $user->getToken() ,
                "tel" => $user->getTel(),
                "changetopwd" => 0,
                "receivePromOffer" => 0,
                "status" => $user->getStatus(),
                "dateInserted" => date( "Y-m-d"),
                "dateUpdated" => date( "Y-m-d" ),
                "lastConnection" => null,
                "picture" => null
            );

            $user->updateTable( $userParams );


            self::setInstalled( "conf.inc.php" );

        }
        else{
            $view = new Views( 'install', 'install_header');
            $view->assign("current", 'install' );
            $view->assign("errors",$errors);
            $view->assign( "config", $form);

        }
    }

    public static function executeQueryFile( $filesql, $dbname ) {
        $query = file_get_contents( $filesql );
        $dbname = str_replace( ' ', '_', $dbname );
        //var_dump( $query ); die;
        $query = str_replace( 'DB_NAME', $dbname, $query );

        $array = explode(";\n", $query);

        return $array;
    }

    public static function changeConfigFile( $filename, $vars ){

        $content = file_get_contents( $filename );

        $bddname = str_replace( ' ', '_', $vars['name'] );
        $content = str_replace( "define('DBNAME','')", "define('DBNAME','".$bddname."')", $content );
        //$content = str_replace( "define('INSTALLED', false )", "define('INSTALLED', true )", $content );

        $content = str_replace( "define('OPENING_HOUR','')", "define('OPENING_HOUR','".$vars['opening']."')", $content );
        $content = str_replace( "define('CLOSING_HOUR','')", "define('CLOSING_HOUR','".$vars['closing']."')", $content );
        $content = str_replace( "define('DURATION','')", "define('DURATION','".$vars['duration']."')", $content );

        file_put_contents( $filename, $content );
    }

    public static function setInstalled( $filename ){

        $content = file_get_contents( $filename );
        $content = str_replace( "define('INSTALLED', false )", "define('INSTALLED', true )", $content );
        file_put_contents( $filename, $content );
    }

}
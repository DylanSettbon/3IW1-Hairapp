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

        $view = new Views( 'install', 'install_header');
        $view->assign("current", 'install' );
        if( !empty( $params['POST'] ) ){
            $view->assign("loading", true );
        }
        unset( $errors );
        /*
         * TODO:
         * 1) vérifications des champs ✓
         * 2) séparation entre infos user et infos site ✓
         * 3) voir comment créer bdd auto avec nom du client ✓
         * 4) intégrer le fichier SQL dedans ✓
         * 5) insérer les données du User dans users en tant qu'admin ✓
         * 6) modifier le conf.inc.php et ajouter les globales pour les horaires du salon si elles n'existent pas ✓
         */

        $install = new Install();


        $form = $install->configForm();


        $errors = Validator::validateInstall( $form, $params['POST'] );

        if( !empty( $_FILES['logo']['name'] ) ){
            $name = "public/img/logo/";
            $file_name = basename($_FILES['logo']['name']);
            $size = $_FILES['logo']['size'];
            $extension = strrchr($_FILES['logo']['name'], '.');


            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            if(move_uploaded_file($_FILES['logo']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $params['POST']['logo'] = $name.$file_name;
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo "An error occured: no file uploaded";
                //echo self::file_upload_error_message($_FILES['picture']['error']);
                //echo 'Echec de l\'upload !';
                //print_r($_FILES);
            }
        }

        if( empty( $errors ) ){

              // Execution du fichier SQL
              /*
               * Debut de la transaction
               * Creation de la base de données
               */

            try{

                $install->beginTransaction();

                self::changeConfigFile( "conf.inc.php", $params['POST'] );
                $sql = self::executeQueryFile( "sql/HairApp.sql", $params['POST']['name'] );

                for ($i=0; $i < count($sql) ; $i++) {
                   $str = $sql[$i];
                   if ($str != '') {
                       $str .= ';';
                       $install->createDatabase( $str );
                       //execution des requetes
                   }
                }
                if( $_POST['data'] == 'on' ){
                    $sql_insert = self::executeQueryFile( "sql/Insert.sql" );

                    for ($i=0; $i < count($sql_insert) ; $i++) {
                        $str_insert = $sql_insert[$i];
                        if ($str_insert != '') {
                            $str_insert .= ';';
                            $str_insert = self::insertUserData( $str_insert, $params );
                            //var_dump( $str_insert );
                            $install->createDatabase( $str_insert );
                            //execution des requetes
                        }
                    }
                   // var_dump( "yes" );die;
                }

                $install->commit();

              }catch ( Exception $e){
                  echo $e->getMessage();
                  $install->rollback();
              }
            self::setInstalled( "conf.inc.php" );
            $view->assign("success", "L'installation s'est déroulée avec succès ! Vous pouvez désormais commencer votre navigation sur Hairapp !");
            $view->assign( "config", $form);
          }
          else{
              $view->assign("errors",$errors);
              $view->assign( "config", $form);
          }


    }

    public static function executeQueryFile( $filesql, $dbname = null ) {
        $query = file_get_contents( $filesql );

        if( $dbname != null ){
          $dbname = str_replace( ' ', '_', $dbname );
          //var_dump( $query ); die;
          $query = str_replace( 'DB_NAME', $dbname, $query );
        }

        $array = explode(";\n", $query);

        return $array;
    }

    public static function changeConfigFile( $filename, $vars ){

        $content = file_get_contents( $filename );

        $bddname = str_replace( ' ', '_', $vars['name'] );
        $content = str_replace( "define('DBNAME','')", "define('DBNAME','".$bddname."')", $content );
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

    public static function insertUserData( $query, $params ){

        $user = new User();
        $config = new Configuration();
        //try{
        $user->setFirstname($params['POST']['prenom']);
        $user->setLastname($params['POST']['nom']);
        $user->setEmail($params['POST']['email']);
        $user->setPwd($params['POST']['pwd']);
        $user->setToken();
        $user->setTel( $params['POST']['tel'] );
        $user->setStatus( 3 );

        $config->setEmailPwd( $params['POST']['application_pwd'] );
        $config->setEmailAddress( $params['POST']['application_mail'] );
        $config->setPostalAddress( $params['POST']['address'] );
        $config->setFacebookLink( $params['POST']['facebook'] );
        $config->setTwitterLink( $params['POST']['twitter'] );
        $config->setInstagramLink( $params['POST']['instagram'] );
        $config->setPinterestLink( $params['POST']['pinterest'] );

        $query = str_replace( "FN_TOCHANGE", $user->getFirstname(), $query );
        $query = str_replace( "LN_TOCHANGE", $user->getLastname(), $query );
        $query = str_replace( "MAIL_TOCHANGE", $user->getEmail(), $query );
        $query = str_replace( "PWD_TOCHANGE", $user->getPwd(), $query );
        $query = str_replace( "TOKEN_TOCHANGE", $user->getToken(), $query );
        $query = str_replace( "TEL_TOCHANGE", $user->getTel(), $query );
        $query = str_replace( "STATUS_TOCHANGE", 3, $query );
        $query = str_replace( "DATE_TOCHANGE", date( "Y-m-d"), $query );


        $query = str_replace( "LOGO_TOCHANGE", $params['POST']['logo'], $query );
        $query = str_replace( "EMAILADDRESS_TOCHANGE", $config->getEmailAddress(), $query );
        $query = str_replace( "EMAILPWD_TO_CHANGE", $config->getEmailPwd(), $query );
        $query = str_replace( "POSTAL_TOCHANGE", $config->getPostalAddress(), $query );
        $query = str_replace( "STATUSCONFIG_TOCHANGE", 1, $query );
        $query = str_replace( "FACEBOOK", $config->getFacebookLink(), $query );
        $query = str_replace( "TWITTER", $config->getTwitterLink(), $query );
        $query = str_replace( "INSTAGRAM", $config->getInstagramLink(), $query );
        $query = str_replace( "PINTEREST", $config->getPinterestLink(), $query );

        return $query;


    }

}

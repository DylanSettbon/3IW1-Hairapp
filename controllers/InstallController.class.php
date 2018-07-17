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

    public function getInstall( $params ){

        $view = new Views( 'install', 'install_header');
        $view->assign("current", 'install' );
        $install = new Install();
        $form = $install->configForm();

        if( !empty( $params['POST'] ) ){
            $view->assign("loading", true );
        }
        else{
            $view->assign( "config", $form);
        }



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
         * 2) séparation entre infos user et infos site
         * 5) voir comment créer bdd auto avec nom du client ✓
         * 6) intégrer le fichier SQL dedans ✓
         * 7) insérer les données du User dans users en tant qu'admin
         * 8) modifier le conf.inc.php et ajouter les globales pour les horaires du salon si elles n'existent pas ✓
         */

        $install = new Install();
        $user = new User();
        $config = new Configuration();

        $form = $install->configForm();

        //var_dump( $params['POST'] ); die;
        $user->setFirstname($params['POST']['prenom']);
        $user->setLastname($params['POST']['nom']);
        $user->setEmail($params['POST']['email']);
        $user->setPwd($params['POST']['pwd']);
        $user->setToken();
        $user->setTel( $params['POST']['tel'] );
        $user->setStatus( 3 );

        $config->setEmailPwd( $_POST['application_pwd'] );
        $config->setEmailAddress( $_POST['application_mail'] );
        $config->setPostalAddress( $_POST['address'] );

        $config_params = array(
            "email_address" => $config->getEmailAddress(),
            "email_pwd" => $config->getEmailPwd(),
            "postal_address" => $config->getPostalAddress()
        );

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

        if( !empty( $_FILES['logo']['name'] ) ){
            $name = "public/img/logo/";
            $file_name = basename($_FILES['logo']['name']);
            $size = $_FILES['logo']['size'];
            $extension = strrchr($_FILES['logo']['name'], '.');


            $file_name = strtr($file_name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            if(move_uploaded_file($_FILES['logo']['tmp_name'], $name.$file_name)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $config_params['logo'] = $name.$file_name;
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo "An error occured: no file uploaded";
                //echo self::file_upload_error_message($_FILES['picture']['error']);
                //echo 'Echec de l\'upload !';
                //print_r($_FILES);
            }
        }

        $errors = Validator::validateInstall( $form, $params['POST'] );

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

                if( $_POST['data'] == 'on' ){
                  $sql_insert = self::executeQueryFile( "sql/Insert.sql" );

                  for ($i=0; $i < count($sql_insert) ; $i++) {
                      $str_insert = $sql_insert[$i];
                      if ($str_insert != '') {
                          $str_insert .= ';';
                          $install->createDatabase( $str_insert );
                          //execution des requetes
                      }
                  }
                }

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


              $config->updateTable( $config_params );
              $user->updateTable( $userParams );

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

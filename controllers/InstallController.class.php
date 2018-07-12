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
         * 3) générer un nouveau dossier dans /var/www avec le nom du client
         * 4) automatiser git pull depuis master
         * 5) voir comment créer bdd auto avec nom du client
         * 6) intégrer le fichier SQL dedans
         * 7) insérer les données du User dans users en tant qu'admin
         * 8) modifier le conf.inc.php et ajouter les globales pour les horaires du salon si elles n'existent pas
         */

        $install = new Install();
        $form = $install->configForm();

        $errors = Validator::validateInstall( $form, $params['POST'] );

        if( empty( $errors ) ){

            //var_dump( $params['POST']['name'] ) ; die;

            $install->createDatabase( $params['POST']['name'] );
        }
        else{
            $view = new Views( 'install', 'install_header');
            $view->assign("current", 'install' );
            $view->assign("errors",$errors);
            $view->assign( "config", $form);

        }
    }
}
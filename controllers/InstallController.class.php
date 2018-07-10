<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:11
 */

class InstallController{


    public function __construct($opts = array()) {
        if( '3ce5e903315a66057c73a4d7d4105c4a' !== md5('gjdhgk5675'.$_SERVER['PHP_AUTH_USER'].$_SERVER['PHP_AUTH_PW'])) {
            header('WWW-Authenticate: Basic realm="Identification"');
            header('HTTP/1.0 401 Unauthorized');
            die('access denied');
        }
    }

    public function checkConfig() {
        $tab_errors = array();
        $tab_warnings = array();

        if(version_compare(PHP_VERSION, '5.3.0') < 0) {
            $tab_errors[] = 'Your PHP version is too old ('.PHP_VERSION.'). It must be at least 5.3.';
        }
        if(!extension_loaded('zip')) {
            $tab_errors[] = 'Php zip extension must be installed.';
        }
        if(!extension_loaded('pdo')) {
            $tab_errors[] = 'Php pdo extension must be installed.';
        }
        if(!extension_loaded('imap')) {
            $tab_errors[] = 'Php imap extension must be installed.';
        }
        if(!extension_loaded('phar')) {
            $tab_errors[] = 'Php phar extension must be installed.';
        }
        if(!extension_loaded('mbstring')) {
            $tab_errors[] = 'Php mbstring extension must be installed.';
        }
        if(!extension_loaded('dom')) {
            $tab_errors[] = 'Dom extension must be installed (http://fr.php.net/manual/en/book.dom.php).';
        }
        if('1'==ini_get('phar.readonly')) {
            $tab_errors[] = 'phar.readonly must be disabled';
        }

        $upload_dir = ini_get('upload_tmp_dir');
        if(!empty($upload_dir) && !@is_writeable($upload_dir)) {
            $tab_errors[] = 'upload_tmp_dir is not writeable ('.$upload_dir.')';
        }

        $this->setParam('server_info', $this->url->getUrl('srv-infos'));

        $this->navigation(1);

        $this->setParam('errors', $tab_errors);
        $this->setParam('warnings', $tab_warnings);
        $this->render('page_install_check_config.html');
    }

    public function getInstall(){

        $view = new Views( 'install', 'install_header');
        $view->assign("current", 'install' );

    }


    public function navigation( $step ){

    }
}
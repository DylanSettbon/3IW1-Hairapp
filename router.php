<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 06/02/2018
 * Time: 07:05
 */

session_start();

require "conf.inc.php";

require "core/BaseSql.class.php";

function myAutoloader($class){
    if(file_exists("core/".$class.".class.php")){
        include "core/".$class.".class.php";
    }else if(file_exists("models/".$class.".class.php")){
        include "models/".$class.".class.php";
    }
}

spl_autoload_register("myAutoloader");


$uri = substr(urldecode($_SERVER["REQUEST_URI"]), strlen(dirname($_SERVER["SCRIPT_NAME"]))); // on enlève le chemin du dossier de l'url demandée

$uri = ltrim($uri, "/"); // on retire le /

if( $uri === 'admin'){
    $uri = 'admin/getAdmin';
}
if( $uri === 'home' ){
    $uri = "home/getHome";
}


 // =============== cette partie redirige vers la bonne vue si l'url est bonne ================

    //TODO Faire la partie action dans l'url

    $uri = explode("?", $uri);

    $uriExploded = explode("/", $uri[0]);

    $page = new Pages();

    $createdPages = $page->getAllBy();

    $urlCreated = [];

    foreach ( $createdPages as $pages ){
    $urlCreated[] = $pages->getUrl();

    }

    $c = (empty($uriExploded[0]))?"index":$uriExploded[0];
    $a = (empty($uriExploded[1]))?"index":$uriExploded[1];

    $urlBase = $c;


    $c = ucfirst(strtolower($c))."Controller";
    $a = strtolower($a);

    unset($uriExploded[0]);
    unset($uriExploded[1]);

    $uriExploded = array_values($uriExploded);

    $params = array(
        "POST"=>$_POST,
        "GET"=>$_GET,
        "URL"=>$uriExploded
    );

    //echo $c; die;

    if( $c == 'AdminController' ) {

        if (!Security::isConnected()) {

            //include "controllers/LoginController.class.php";

            //$objC = new LoginController();
            //$objC->getLogin();

            include "controllers/ErrorsController.class.php";

            $objC = new ErrorsController();
            $objC->get401();

        } else {
            if (!Security::isAdmin()) {

                include "controllers/ErrorsController.class.php";

                $objC = new ErrorsController();
                $objC->get403();
            } elseif (file_exists("controllers/" . $c . ".class.php")) {
                include "controllers/" . $c . ".class.php";
                if (class_exists($c)) {

                    $objC = new $c();

                    if (method_exists($objC, $a)) {
                        $objC->$a($params);
                    } else {
                        die("L'action " . $a . " n'existe pas");
                    }
                } else {
                    die("Le controller " . $c . " n'existe pas");
                }
            } elseif (in_array($urlBase, $urlCreated)) {

                include "controllers/PageController.class.php";

                $params['URL'] = $urlBase;
                $objC = new Page();
                $objC->getPage($params);

            } else {
                //die("Le fichier ".$c." n'existe pas");
                //header("HTTP/1.0 404 Not Found", true, 404);
                include "controllers/ErrorsController.class.php";

                $objC = new ErrorsController();
                $objC->get404();

                //$v = new Views( "errors/404", "header");
                //var_dump( $v);

            }
        }
    }
    else{
        if (file_exists("controllers/" . $c . ".class.php")) {
            include "controllers/" . $c . ".class.php";
            if (class_exists($c)) {

                $objC = new $c();

                if (method_exists($objC, $a)) {
                    $objC->$a($params);
                } else {
                    die("L'action " . $a . " n'existe pas");
                }
            } else {
                die("Le controller " . $c . " n'existe pas");
            }
        } elseif (in_array($urlBase, $urlCreated)) {

            include "controllers/PageController.class.php";

            $params['URL'] = $urlBase;
            $objC = new Page();
            $objC->getPage($params);

        } else {
            //die("Le fichier ".$c." n'existe pas");
            //header("HTTP/1.0 404 Not Found", true, 404);
            include "controllers/ErrorsController.class.php";

            $objC = new ErrorsController();
            $objC->get404();

            //$v = new Views( "errors/404", "header");
            //var_dump( $v);

        }
    }

<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 06/02/2018
 * Time: 07:05
 */

session_start();

require "conf.inc.php";

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

if( file_exists( "views/".$uri.".view.php") ){
    include "views/".$uri.".view.php";
}
else {
    include "views/index.view.php";
    //echo "file views/" . $uri . ".view.php doesn't exist";
}

 // =============== cette partie redirige vers la bonne vue si l'url est bonne ================

    //TODO
    // Faire la partie action dans l'url



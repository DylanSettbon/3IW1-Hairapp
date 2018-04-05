<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 03/02/2018
 * Time: 15:06
 */


define("DBUSER","root");
define("DBHOST","127.0.0.1");
define("DBNAME","projet_annuel");
define("DBPWD","root");
define("DBPORT","3306");
define("DBDRIVER","mysql");


define("DS", "/");
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);

define("DIRNAME", $scriptName.DS);



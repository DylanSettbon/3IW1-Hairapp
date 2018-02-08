<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 03/02/2018
 * Time: 15:06
 */


define("DBUSER","");
define("DBHOST","");
define("DBNAME","");
define("DBPWD","");
define("DBPORT","3306");
define("DBDRIVER","mysql");


define("DS", "/");
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);

define("DIRNAME", $scriptName.DS);



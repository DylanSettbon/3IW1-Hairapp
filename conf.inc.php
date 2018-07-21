<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 03/02/2018
 * Time: 15:06
 */


define("DBUSER","root");
define("DBHOST","localhost");
define('DBNAME','');
define("DBPWD","root");
define("DBPORT","3306");
define("DBDRIVER","mysql");
define('INSTALLED', false );
define("DS", "/");
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
define("PICTURES_DIR", DIRNAME."public/img/" );

$list_of_extensions = ['.png', '.gif', '.jpg', '.jpeg'];

define('OPENING_HOUR','');
define('CLOSING_HOUR','');
define('DURATION','');


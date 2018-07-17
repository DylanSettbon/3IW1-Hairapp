<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 03/02/2018
 * Time: 15:06
 */


define("DBUSER","root");
define("DBHOST","localhost");
define('DBNAME','azertyu');
define("DBPWD","root");
define("DBPORT","8889");
define("DBDRIVER","mysql");
define('INSTALLED', true );
define("DS", "/");
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
define("PICTURES_DIR", DIRNAME."public/img/" );

$list_of_extensions = ['.png', '.gif', '.jpg', '.jpeg'];

define('OPENING_HOUR','09:30');
define('CLOSING_HOUR','18:30');
define('DURATION','00:30');

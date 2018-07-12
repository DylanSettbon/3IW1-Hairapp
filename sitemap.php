<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 10/07/2018
 * Time: 14:16
 */

header("Content-Type: text/xml"); // On déclare un fichier XML
echo'<'.'?xml version="1.0" encoding="UTF-8"?'.'>
<urlset xmlns="https://www.google.com/schemas/sitemap/0.84">
';
foreach(glob("/cheminabsolu/sitemaps/*.*") as $filename) {
    $filename = str_replace("/cheminabsolu/","",$filename);
    include ($filename);
}

echo "</urlset>";
?>
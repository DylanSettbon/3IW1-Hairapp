<?php

include "../../conf.inc.php";

?>


<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href= '../public/css/style.css'>
  <title>Hair'App : Le site à votre image.</title>
</head>

<body>

  <header class='header'>
      <div class='container2'>
        <div class='logo'>
          <a href='admin'>LOGO</a>
        </div>

        <div id='burger'>
            <span class='bar'>&nbsp;</span>
            <span class='bar'>&nbsp;</span>
            <span class='bar'>&nbsp;</span>
         </div>

        <nav class='nav'>
          <ul>
            <li class='active'><a href='admin'>Back-Office</a></li>
            <li><a href='index'>Vers le site</a></li>
            <li><a href='signin'>Mon Compte</a></li>
          </ul>
        </nav>
      </div>
  </header>
  
  <main class='container'>
      
    
  
    <aside class='sidebar col-s-12 col-m-2 col-l-1'>  <!-- col-s-3 col-m-2 col-l-2  sidebar col-s-3 col-m-2 col-l-2-->
        <ul id='sidebar_ul'>
            <li class='active sidebar_buttons'><a href='admin'>Dashboard</a></li>
            <li class='sidebar_buttons'><a href='userAdmin'>User Manager</a></li>
            <li class='sidebar_buttons'><a href='siteManager'>Website Manager</a> </li>
        </ul>
   </aside>


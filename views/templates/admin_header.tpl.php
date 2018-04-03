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

          <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
          </div>

        <nav class='nav'>
          <ul>
            <li class='li-navbar'><a href='admin'>Back-Office</a></li>
            <li class="li-navbar"><a href='index'>Vers le site</a></li>
            <li class="li-navbar"><a href='signin'>Mon Compte</a></li>
          </ul>
        </nav>
      </div>
  </header>

  <div class="sidenav">
      <ul>
          <a href="index">LOGO</a>
          <li class='active sidebar_buttons'><a href="admin">Dashboard</a></li>
          <li class='sidebar_buttons'><a href="userAdmin">Gestion des utilisateurs</a></li>
          <li class='sidebar_buttons'><a href="#about">Gestion du contenu</a></li>
      </ul>
  </div>




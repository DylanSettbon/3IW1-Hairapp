<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href= '../public/css/style.css'>
  <title>Hair'App : Le site à votre image.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <header class='header'>
      <div class='container2'>
        <div class='logo'>
          <a href='<?php echo DIRNAME;?>admin/getAdmin'>LOGO</a>
        </div>

          <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
          </div>

          <div class="nav-left">
              <ul>
                  <li class='active li-navbar'><a href="<?php echo DIRNAME;?>admin/getAdmin">Dashboard</a></li>
                  <li class='li-navbar'><a href="<?php echo DIRNAME;?>admin/getUserAdmin">Gestion des utilisateurs</a></li>
                  <li class='li-navbar'><a href="<?php echo DIRNAME;?>admin/getPagesAdmin">Gestion du contenu</a></li>
              </ul>
          </div>

        <nav class='nav'>
          <ul>
            <li class='li-navbar'><a href='<?php echo DIRNAME;?>admin/getAdmin'>Back-Office</a></li>
            <li class="li-navbar"><a href='<?php echo DIRNAME;?>home/getHome'>Vers le site</a></li>
            <li class="li-navbar"><a href='<?php echo DIRNAME;?>account/myaccount'>Mon Compte</a></li>
          </ul>
        </nav>
      </div>
  </header>





  <?php

  include "views/".$this->v;?>




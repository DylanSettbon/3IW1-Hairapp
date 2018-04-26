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
          <a href='<?php echo DIRNAME;?>admin/getAdmin'>LOGO</a>
        </div>

          <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
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

  <div class="sidenav">
      <ul>
          <a href="<?php echo DIRNAME;?>admin/getAdmin">LOGO</a>
          <li class='active sidebar_buttons'><a href="<?php echo DIRNAME;?>admin/getAdmin">Dashboard</a></li>
          <li class='sidebar_buttons'><a href="<?php echo DIRNAME;?>admin/getUserAdmin">Gestion des utilisateurs</a></li>
          <li class='sidebar_buttons'><a href="#about">Gestion du contenu</a></li>
      </ul>
  </div>



  <?php include "views/".$this->v;?>




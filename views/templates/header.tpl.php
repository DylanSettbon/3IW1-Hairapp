<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href="../public/css/style.css">
  <title>Hair'App : Le site à votre image.</title>
</head>


<body>

  <header class='header'>
      <div class='container2'>
        <div class='logo'>
          <a href='<?php echo DIRNAME;?>home/getHome'>LOGO</a>
        </div>

          <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
          </div>

        <nav class='nav'>
          <ul id="sidebar_ul">
            <li class='li-navbar'><a href='<?php echo DIRNAME;?>home/getHome'>Accueil</a></li>
            <li class="li-navbar"><a href='<?php echo DIRNAME;?>appointment/getAppointment'>Rendez-vous</a></li>
            <li class="li-navbar"><a href='<?php echo DIRNAME;?>package/getPackage'>Forfait</a></li>
            <li class="li-navbar"><a href='#'>Vitrine</a></li>
            <li class="li-navbar"><a href='#'>Salon</a></li>
            <li class="li-navbar"><a href='<?php echo DIRNAME;?>login/getLogin'>Mon Compte</a></li>
          </ul>
        </nav>
      </div>
  </header>

<?php
    include "views/".$this->v;
?>

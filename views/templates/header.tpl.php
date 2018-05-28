<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href="<?php echo DIRNAME;?>public/css/style.css">
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
              <li <?php if ( $this->data['current'] == 'home') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                  <a href='<?php echo DIRNAME;?>home/getHome'>Accueil</a>
              </li>
              <?php

              foreach ( $this->data['navbar'] as $nav ){

                  if( $nav->getActive() == 1 ){
                      echo "<li ";
                      if ( $this->data['current'] == $nav->getUrl() ) {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';

                      echo "> 
                            <a href=' ".DIRNAME . $nav->getUrl() . "'>". $nav->getTitle()."</a>
                        </li>";
                  }


              }


              ?>

            <li <?php if ( $this->data['current'] == 'appointment') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='<?php echo DIRNAME;?>appointment/getAppointment'>Rendez-vous</a>
            </li>
            <li <?php if ( $this->data['current'] == 'packages') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='<?php echo DIRNAME;?>package/getPackage'>Forfait</a>
            </li>
            <li <?php if ( $this->data['current'] == 'products') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='#'>Vitrine</a>
            </li>
            <li <?php if ( $this->data['current'] == 'store') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='#'>Salon</a>
            </li>
              <?php
                if( Security::isConnected() ){
                    ?>
                    <li class="li-navbar"><a href='<?php echo DIRNAME;?>account/getAccount'>Mon Compte</a></li>
              <?php
                }
                else{
                    ?>
                    <li class="li-navbar"><a href='<?php echo DIRNAME;?>login/getLogin'>Se Connecter</a></li>
                    <?php
                }



              ?>

          </ul>
        </nav>
      </div>
  </header>

<?php
    include "views/".$this->v;
?>

<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href="<?php echo DIRNAME;?>public/css/style.css">
  <title>Hair'App : Le site à votre image.</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script type="text/javascript" src="<?php echo DIRNAME."public/js/index.js";?>"></script>
    <link rel="icon" href="<?php echo DIRNAME;?>public/img/logo/favicon.ico" />
    <?php if( !empty( $configuration->getName() ) ): ?>
        <title><?php echo $configuration->getName(); ?></title>
    <?php else: ?>
        <title>Hair'App</title>
    <?php endif; ?>
</head>

<body>

  <header class='header'>
      <div class='container2'>


          <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
          </div>

          <div class="nav-left" id="nav-left">
              <div class='logo'>

                  <a href='<?php echo DIRNAME;?>admin/getAdmin' style="padding: 0;">
                      <?php if( !empty( $configuration->getLogo() ) ): ?>
                          <img src="<?php echo DIRNAME.$configuration->getLogo();?>" alt="logo" class="logo">
                      <?php endif; ?>
                  </a>

              </div>
              <?php if( !empty( $configuration->getName() ) ): ?>
                  <div style="display: inline-block; margin: 10px 10px;">
                      <a href='<?php echo DIRNAME;?>admin/getAdmin' style="color: #FFF;
    font-weight: 400;
    padding: 10px;
    text-decoration: none;"><?php echo $configuration->getName(); ?></a>
                  </div>

              <?php endif; ?>
              <ul>
                  <li <?php if ( $current == 'dashboard') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                    <a href="<?php echo DIRNAME;?>admin/getAdmin">Dashboard</a>
                  </li>
                  <li <?php if ( $current == 'users') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                      <a href="<?php echo DIRNAME;?>admin/getUserAdmin">Gestion des utilisateurs</a>
                  </li>
                  <li <?php if ( $current == 'content') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                      <a href="<?php echo DIRNAME;?>admin/getTemplateAdmin">Gestion du contenu</a>
                  </li>
                  <?php if ( Security::isConnected() && ( Security::isCoiffeur() || Security::isAdmin() ) ): ?>
                      <li <?php if ($current == 'planning'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif; ?> >
                          <a href="<?php echo DIRNAME;?>planning/getPlanning?h=admin">Planning</a>
                      </li>
                  <?php endif; ?>
              </ul>
          </div>

        <nav class='nav' id="nav">
          <ul>
            <li class='li-navbar'>
                <a href='<?php echo DIRNAME;?>admin/getAdmin'>Back-Office</a>
            </li>
            <li class="li-navbar">
                <a href='<?php echo DIRNAME;?>home/getHome'>Vers le site</a>
            </li>
            <li class="li-navbar">
                <a href='<?php echo DIRNAME;?>account/getAccount'>Mon Compte</a>
            </li>
          </ul>
        </nav>
      </div>
  </header>





  <?php

  include "views/".$this->v;

  include $this->f;

  ?>




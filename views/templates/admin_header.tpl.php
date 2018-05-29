<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href= '../public/css/style.css'>
  <title>Hair'App : Le site à votre image.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script type="text/javascript" src="../public/js/index.js"></script>

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

          <div class="nav-left" id="nav-left">
              <ul>
                  <li <?php if ( $this->data['current'] == 'dashboard') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                    <a href="<?php echo DIRNAME;?>admin/getAdmin">Dashboard</a>
                  </li>
                  <li <?php if ( $this->data['current'] == 'users') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                      <a href="<?php echo DIRNAME;?>admin/getUserAdmin">Gestion des utilisateurs</a>
                  </li>
                  <li <?php if ( $this->data['current'] == 'content') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                      <a href="<?php echo DIRNAME;?>admin/getContentAdmin">Gestion du contenu</a>
                  </li>
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

  <script>

      var dropdown = document.getElementsByClassName("dropdown");

      var i;

      for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
              this.classList.toggle("active", true);
              var dropdownContent = this.nextElementSibling;
              dropdownContent.style.display = "block";
          });
      }
  </script>




<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href="<?php echo DIRNAME;?>public/css/style.css">
  <title>Hair'App : Le site à votre image.</title>
</head>

<script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script type="text/javascript" src="../public/js/index.js"></script>


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
              <li <?php if ( $current == 'home'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif; ?> >
                  <a href=<?php echo DIRNAME ?>home/getHome>Accueil</a>
              </li>
              <?php foreach ( $navbar as $nav ): ?>

                  <?php if( $nav->getActive() == 1 ): ?>
                      <li <?php if ( $current == $nav->getUrl() ): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif; ?> >
                            <a href=' <?php echo DIRNAME . $nav->getUrl(); ?>'> <?php echo $nav->getTitle(); ?> </a>
                      </li>
                  <?php endif; ?>
              <?php endforeach; ?>

              <?php if ( Security::isConnected() && Security::isCoiffeur() ): ?>
                  <li <?php if ($current == 'account'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif; ?> >
                      <a href="<?php echo DIRNAME;?>planning/getPlanning">Planning</a>
                  </li>
              <?php endif; ?>

            <li <?php if ( $current == 'appointment'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif?>>
                <a href='<?php echo DIRNAME;?>appointment/getAppointment'>Rendez-vous</a>
            </li>
            <li <?php if ( $current == 'packages'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif?>>
                <a href='<?php echo DIRNAME;?>package/getPackage'>Forfait</a>
            </li>
            <li <?php if ( $current == 'products'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif?>>
                <a href='#'>Vitrine</a>
            </li>
            <li <?php if ( $current == 'store'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif?>>
                <a href='#'>Salon</a>
            </li>
              <?php if( Security::isConnected() ): ?>
                    <li <?php if ( $current == 'account'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif;?>>
                        <a href='<?php echo DIRNAME;?>account/getAccount'>Mon Compte</a>
                    </li>
              <?php else: ?>
                    <li <?php if ( $current == 'login'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif;?> >
                        <a href='<?php echo DIRNAME;?>login/getLogin'>Se Connecter</a>
                    </li>
              <?php endif; ?>

          </ul>
        </nav>
      </div>
  </header>

<?php
    include "views/".$this->v;


    include $this->f;
?>

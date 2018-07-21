<?php
//$urldemandee=$_SERVER['REQUEST_URI']; // on récupère l'url de la page courante
//// on met cette url en forme pour en faire un nom de fichier valide
//$urldemandee=str_replace("/",'-',$urldemandee);
//if($urldemandee=="-") $urldemandee="-index.html";
//$fichierSitemaps="sitemaps".$urldemandee;
//$fichierSitemaps=str_replace('sitemaps-','',$fichierSitemaps);
//// on teste si le fichier existe déjà
//if(!file_exists(DIRNAME."/sitemaps/".$fichierSitemaps)!==false) {
//    $fd = fopen("sitemaps/".$fichierSitemaps,"w"); //on ouvre le fichier
//    if ($fd) {
//        if($_SERVER['REQUEST_URI']=="/") $filtrePage="/index.html";else $filtrePage=$_SERVER['REQUEST_URI']; //on evite de dupliquer domaine.com et domaine.com/index.html
//        $sitemapsContent="<url>\n\t<loc>http://www.grandprix4.org".$filtrePage."</loc>\n\t<lastmod>".date('Y-m-d')."T".date('H:m:s+00:00')."</lastmod>\n</url>\n"; //on formate les infos pour le XML
//        fwrite($fd,$sitemapsContent); //on ecrit le fichier
//        fclose($fd); //on ferme le fichier
//    }
//}
?>
<!DOCTYPE html>
<html lang='fr' >

<head>
  <meta charset='UTF-8'>
    <meta name="description" content="Hairapp est un CMS destiné aux professionnels de la coiffure afin de créer un site professionnel rapidement, de le maintenir facilement et de manière intuitive!">
    <meta name="keywords" content="hairapp, coiffeur, coiffure,salon,prise,rendez-vous,cms,forfaits,cheveux,coupe,homme,femme,enfant,barbe,prix">
    <meta name="robots" content="index, nofollow">
    <meta name="language" content="french">
    <link rel='stylesheet' type='text/css' href="<?php echo DIRNAME;?>public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="<?php echo DIRNAME;?>public/img/logo/favicon.ico" />
    <?php if( !empty( $configuration->getName() ) ): ?>
        <title><?php echo $configuration->getName(); ?></title>
    <?php else: ?>
        <title>Hair'App</title>
    <?php endif; ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script type="text/javascript" src="<?php echo DIRNAME;?>public/js/index.js"></script>


<body>

  <header class='header'>
      <div class='container2'>

          <div>
              <a href='<?php echo DIRNAME;?>home/getHome'>
                  <?php if( !empty( $configuration->getLogo() ) ): ?>
                      <img src="<?php echo DIRNAME.$configuration->getLogo();?>" alt="logo" class="logo">
                  <?php endif; ?>
              </a>
          </div>
          <?php if( !empty( $configuration->getName() ) ): ?>
              <div style="display: inline-block; margin: 18px 10px;">
                  <a href='<?php echo DIRNAME;?>home/getHome' style="color: #FFF;
    font-weight: 400;
    padding: 10px;
    text-decoration: none;"><?php echo $configuration->getName(); ?></a>
              </div>

          <?php endif; ?>

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

              <?php if ( Security::isConnected() && ( Security::isCoiffeur() || Security::isAdmin() ) ): ?>
                  <li <?php if ($current == 'planning'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif; ?> >
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

            <li <?php if ( $current == 'contact') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='<?php echo DIRNAME;?>contact/getContact'>Contact</a>

            </li>
            <li <?php if ( $current == 'category') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                <a href='<?php echo DIRNAME;?>category/getCategory'>Article</a>
            </li>
              <?php if( Security::isConnected() ): ?>
                    <li <?php if ( $current == 'account'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif;?>>
                        <a href='<?php echo DIRNAME;?>account/getAccount'>Mon Compte</a>
                    </li>
                      <li <?php if ( $current == 'logout'): echo ' class="li-navbar active" '; else: echo ' class="li-navbar"'; endif;?>>
                          <a href='<?php echo DIRNAME;?>login/logout'>Se déconnecter</a>
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

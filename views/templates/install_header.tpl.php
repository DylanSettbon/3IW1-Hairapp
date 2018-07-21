<!DOCTYPE html>
<html lang='fr' >

<head>
    <meta charset='UTF-8'>
    <meta name="description" content="Hairapp est un CMS destiné aux professionnels de la coiffure afin de créer un site professionnel rapidement, de le maintenir facilement et de manière intuitive!">
    <meta name="keywords" content="hairapp, coiffeur, coiffure,salon,prise,rendez-vous,cms,forfaits,cheveux,coupe,homme,femme,enfant,barbe,prix">
    <meta name="robots" content="index, nofollow">
    <meta name="language" content="french">
    <link rel='stylesheet' type='text/css' href="<?php echo DIRNAME;?>public/css/style.css">
    <title>Hair'App : Le site à votre image.</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<body>

    <header class='header'>
        <div class='container2'>
            <div class='logo'>
                <a href='<?php echo DIRNAME;?>install/getInstall'>
                    <img src="<?php echo DIRNAME."public/img/logo-last.png"; ?> " class="logo" alt="logo hairapp">
                </a>
            </div>

            <div id="burger" class="toggleAnimated" onclick="toggleAnimated(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <nav class='nav'>

                <ul id="sidebar_ul">

                    <li <?php if ( $current == 'install') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                        <a href='<?php echo DIRNAME;?>install/getInstall'>Installation</a>
                    </li>
                    <li <?php if ( $current == 'home') {echo ' class="li-navbar active" ';} else echo ' class="li-navbar"';?>>
                        <a href='<?php echo DIRNAME;?>home/getHome'>Vers le site</a>
                    </li>


                </ul>
            </nav>
        </div>
    </header>

    <?php
    include "views/".$this->v;


    include $this->f;
    ?>

<?php

include "templates/sidebar.view.php";
?>

<div class="content">
    <article class="arriere_plan">

        <div class="col-s-12 col-m-8 col-l-12 form_register_admin">
            <h1 class="packageAdmin-title">Personnaliser la couleur principale du site </h1>


        <div class="col-s-12 col-l-6 col-m-6 form_register_admin">
Choisir sa propre couleur :
<form method="post" action="<?php echo DIRNAME;?>admin/colorChange"> <input type="color" name="customColor"/>
<input type="submit" id="colorChoose" class="btnForfait" value="Valider" href="colorChange" />
</form>
</div>

        <div class="col-s-12 col-l-6 col-m-12 form_register_admin">
Choisir une couleur : 
<form method="post" action="<?php echo DIRNAME;?>admin/colorChange">
<div class="color-wrapper">
    <input type="text" name="customColor" placeholder="#FFFFFF" id="pickcolor" class="call-picker" style="display: none">
  <div class="color-holder call-picker"></div>
  <div class="color-picker" id="color-picker" ></div>
</div>
<input type="submit" id="colorChoose" class="btnForfait" value="Valider" href="colorChange" />
<a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/colorStandard">Couleur Standard </a>
</form>
</div>


    <script  src="<?php echo DIRNAME."public/js/index.js"; ?>"></script>





        </div>
    </div>

    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script type="text/javascript" src="<?php echo DIRNAME."public/js/color.js" ;?>"></script>


    </main>


      <style>
    .color-wrapper {
        position: relative;
        width: 250px;
        margin: 20px auto;
    }

    .color-picker {
        width: 350px;
        background: #F3F3F3;
        height: 200px;
        padding: 5px;
        border: 5px solid #fff;
        box-shadow: 0px 0px 3px 1px #DDD;
        position: absolute;
        right: 261px;
        border-radius:15px;
    }

    .color-holder {
    background: #fff;
        cursor: pointer;
        border: 1px solid #AAA;
        width: 200px;
        height: 200px;
        float: left;
        margin-left: 5px;
    border-radius:15px;
    }

    .color-picker .color-item {
        cursor: pointer;
        width: 30px;
        height: 30px;
        list-style-type: none;
        float: left;
        margin: 2px;
        border: 1px solid #DDD;
    border-radius:15px;
    }

    .color-picker .color-item:hover {
        border: 1px solid #666;
        opacity: 0.8;
        -moz-opacity: 0.8;
        filter:alpha(opacity=8);
    }
    </style>

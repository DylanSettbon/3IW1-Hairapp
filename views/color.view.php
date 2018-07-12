<?php

include "templates/sidebar.view.php";
?>
<main class='container'>
    <div class="content">
        <div class="col-s-12 col-l-12 col-m-9 packageContent-admin">
            <h1 class="packageAdmin-title">Personnaliser la couleur principale du site </h1>


<form method="post" action="<?php echo DIRNAME;?>admin/colorChange">
<div class="color-wrapper">
  <input type="text" name="customColor" placeholder="#FFFFFF" id="pickcolor" class="call-picker" style="display: none">
  <div class="color-holder call-picker"></div>
  <div class="color-picker" id="color-picker" ></div>
</div>
<input type="submit" id="colorChoose" class="btnForfait" value="Valider" href="colorChange" />
<a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/colorStandard">Couleur Standard </a>
</form>


    <script  src="js/index.js"></script>





        </div>
    </div>
    <?php //include 'templates/footer.tpl.php' ?>
    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script type="text/javascript" src="../public/js/color.js"></script>


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

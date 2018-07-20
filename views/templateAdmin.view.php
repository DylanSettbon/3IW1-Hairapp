<?php
/**
 * Created by PhpStorm.
 * User: antoine

 * Date: 04/02/2018
 * Time: 11:27
 */
include "templates/sidebar.view.php";
?>
<main class='container'>
    <div class="content">
        <div class="col-s-12 col-l-12 col-m-9 packageContent-admin">
            <h1 class="packageAdmin-title">Gestion du contenu</h1>
            <div class="row">
            </div>
            
<form method="post" action="<?php echo DIRNAME;?>admin/colorHomeChange"> 
Changer la couleur de l'écriture du caroussel : <input type="color" name="customColor"/>
<input type="submit" id="colorChoose" class="btnForfait" value="Valider" href="colorHomeChange" />
<a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/colorHomeStandard">Couleur Standard </a>
</form>
        <div style="display:inline-block;">
        <p>Première photo actuelle du caroussel d'accueil : </p>
    <form method="post" action="<?php echo DIRNAME;?>admin/pictureFirstChange" enctype="multipart/form-data"> 
        <div>
            <img src="../public/img/barber1.jpg" alt="Image d'accueil 1" width="300" height="200">
        </div><br>
            <div>
            <label for="homePic1">Première photo d'accueil :</label>
            <input type="file"
               id="newFirstPicture" name="newFirstPicture"
               accept="image/png, image/jpeg" />
        </div>  
        <input type="submit" id="pictureChoose" class="btnForfait" value="Valider" name="submit" />
        <a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/pictureFirstStandard">Photo Standard </a>
    </form>
        </div>
        
        <div style="display:inline-block;">
        <p>Deuxième photo actuelle du caroussel d'accueil : </p>
    <form method="post" action="<?php echo DIRNAME;?>admin/pictureSecondChange" enctype="multipart/form-data">
        <div>
            <img src="../public/img/barber2.jpg" alt="Image d'accueil 2" width="300" height="200">
        </div><br>
            <div>
            <label for="homePic2">Deuxième photo d'accueil :</label>
            <input type="file" 
               id="newSecondPicture" name="newSecondPicture"
               accept="image/png, image/jpeg" />
        </div>  
        <input type="submit" id="pictureChoose" class="btnForfait" value="Valider" />
        <a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/pictureSecondStandard">Photo Standard </a>
    </form>
        </div>

        <div style="display:inline-block; margin-bottom : 50px;">
        <p>Troisième photo actuelle du caroussel d'accueil : </p>
    <form method="post" action="<?php echo DIRNAME;?>admin/pictureThirdChange" enctype="multipart/form-data">
        <div>
            <img src="../public/img/barber3.jpg" alt="Image d'accueil 3" width="300" height="200">
        </div><br>
            <div>
            <label for="homePic3">Troisième photo d'accueil :</label>
            <input type="file"
               id="newThirdPicture" name="newThirdPicture"
               accept="image/png, image/jpeg" />
        </div> 
        <input type="submit" id="pictureChoose" class="btnForfait" value="Valider" />
        <a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/pictureThirdStandard">Photo Standard </a>
    </form>
    </div> 

        <div style="display:inline-block; margin-bottom : 50px;">
        <p>Fond d'écran actuel : </p>
    <form method="post" action="<?php echo DIRNAME;?>admin/pictureAccChange" enctype="multipart/form-data">
        <div>
            <img src="../public/img/salon coiffure.jpeg" alt="Image de fond" width="300" height="200">
        </div><br>
            <div>
            <label for="homePic2">Deuxième photo d'accueil :</label>
            <input type="file"
               id="newAccPicture" name="newAccPicture"
               accept="image/png, image/jpeg" />
        </div>  
        <input type="submit" id="pictureChoose" class="btnForfait" value="Valider" />
        <a type="button" id="colorStandard" class="btnForfait" href="<?php echo DIRNAME;?>admin/pictureAccStandard">Photo Standard </a>
    </form>
    </div>
           
    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>


    </main>

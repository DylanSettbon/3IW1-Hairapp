<body id="body-rdv">
  <main id="main-forfait" class="col-s-11 col-l-8">
        <div class="row">
            <div>
                <h4 style='margin: 0;'>
                  Publié le <?php echo substr($article->getDateParution(), 8).' '.$month[substr($article->getDateParution(), 5, 2)].' '.substr($article->getDateParution(), 0,4); ?>  
                </h4>
            </div>
            <div style="width: 100%;">
                <h1 id="titre-article" class="col-l-4"><?php echo $article->getName();?></h1>
            </div>
        </div>
    <div class="col-s-12 col-l-12 partie-droite">
      <div class="categorie1 container">
        <?php if( !empty( $article->getImage() ) ): ?>
                     <img class='img-art' src='<?php echo DIRNAME. $article->getImage();?>' style='width:25%; height:25% ;display: block;
                margin-left: auto;
                margin-right: auto; min-width: 200px'>
                  <?php else: ?>
                      <img src='/public/img/barber.jpg' style='width:25%; height:25% ;display: block;
                margin-left: auto;
                margin-right: auto; min-width: 200px; margin-top:10px;'>
        <?php endif; ?>
        <p><?php echo $article->getDescription();?></p>
            <hr class="col-s-12">
          </div>
      </div>
      <div class="container">
            <h2>Commentaire</h2>
        <!-- Example row of columns -->
        <div class="row">
     <div class="col-md-6">
              <?php foreach($comments as $comment):?>
                <?php foreach($users as $user):?>
                  <?php if($comment["statut"]==2):?>
                    <?php if($comment["id_user"]==$user["id"]):?>

                    <!-- <div style="border: 1.5px groove #e6e6e6; border-radius:5px;"><?php echo $item["idUser"];?> -->
                      <div style="position: relative;max-width: 300px;height: auto;margin: 10px 10px;padding: 2px;background-color: #DADADA;
                                border-radius: 3px;border: 5px solid #ccc;"><?php echo $user["firstname"]." ".$user["lastname"]." a dit :"; ?>
                      <br>
                      <div style="margin:4px;font-size:14px;"><?php echo $comment["content"];?></div></div>
                      <div style="font-style:italic; font-size:10px;"><?php echo "Publié le ". $comment["date"]?></div>

                    <?php endif;?>
                  <?php endif;?>
                <?php endforeach;?>
              <?php endforeach;?>

            <?php if(Security::isConnected()){
             $this->addModal("com", $config, $errors, $comments);} ?>

          </div>
        <hr>

      </div>

    </div>
  </main>
</body>

<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script src="../public/js/index.js"></script>
<?php include "templates/footer.tpl.php"; ?>
</html>












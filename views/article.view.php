<body id="body-rdv">
  <main id="main-forfait" class="col-s-11 col-l-8">
        <div class="row">
            <h1 id="title-rdv" class="title col-l-4">Article</h1>
        </div>
    <div class="col-s-12 col-l-12 partie-droite">
      <div class="categorie1 container">
      	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <hr class="col-s-12">
          </div>
      </div>
      <div class="container">
            <h2>Commentaire</h2>
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-6">
              <?php foreach($all as $item):?>
              	<?php foreach($theUser as $user):?>
                    <?php if($item["statut"]==2):?>
                  <!-- <div style="border: 1.5px groove #e6e6e6; border-radius:5px;"><?php echo $item["idUser"];?> -->
                  <div style="position: relative;max-width: 300px;height: auto;margin: 10px 10px;padding: 2px;background-color: #DADADA;
                              border-radius: 3px;border: 5px solid #ccc;"><?php echo $user["firstname"]." ".$user["lastname"]." a dit :"; ?>
                    <br>
                    <div style="margin:4px;font-size:14px;"><?php echo $item["content"];?></div></div>
                    <div style="font-style:italic; font-size:10px;"><?php echo "Publié le ". $item["date"]?></div>

              <?php endif;?>
              <?php endforeach;?>
              <?php endforeach;?>

            <?php if(Security::isConnected()){
             $this->addModal("com", $config, $errors, $all);} ?>

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












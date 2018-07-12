<body id="body-art">

  <main id="main-rdv" class="col-s-11 col-l-8 ">
        <div class="row">
            <h1 id="title-art" class="title col-l-12">Choisir une categorie</h1>
      </div>

     <form method="post" action="<?php echo DIRNAME;?>category/getArticle" >
      
        <div class="container-artcat liste-art">
          <select name='category' class='input input_sign-in' >
                   <option value=" ">Tous</option>
                           <?php
                                foreach($u as $category):
                                        
                                          echo"<option value=" . $category->getId(). ">". $category->getDescription() . "</option>";
                                        endforeach;
                                        ?>
          </select>
        </div>
      </section>
      <input type="submit" class="input center" id="valider" value="Valider" />

    </form>
  </main>
</body>
<?php include "templates/footer.tpl.php"; ?>
</html>

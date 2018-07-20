<body id="body-art">

  <main id="main-rdv" class="col-s-11 col-l-8 ">
        <div class="row">
            <h1 id="title-art" class="title col-s-12 col-m-12 col-l-12">Choisir une categorie d'article</h1>
      </div>
      
        <div class="container-artcat liste-art" id="selectCategory" >
          <select name='category' class='input input_sign-in' onchange="filterSelection(this.value)">
              <option class="btn-articles" value="all">Tous</option>
               <?php
                    foreach($u as $category):
                            
                      echo"<option class='btn-articles' value=" . $category->getDescription(). ">". $category->getDescription() . "</option>";

                    endforeach;
                    ?>
          </select>
          <div class="row">
          <?php foreach ($a as $article): ?>
            <div class='col-s-12 col-m-6 col-l-4 column-articles <?php echo $article->getDescription_category(); ?>'>
              <div class="article-accueil content-articles" style="display: flex; flex-direction: column;">

                <div style="height: 20vh; overflow: hidden; width: 100%;
                  <?php if( !empty( $article->getImage() ) ): ?>
                      background-image: url('<?php echo DIRNAME.$article->getImage();?>');
                      background-size: 100% auto; background-repeat: no-repeat;

                  <?php else: ?>
                    background-image: url('<?php echo DIRNAME . "public/img/barber.jpg";?>');
                      background-size: 100% auto; background-repeat: no-repeat;
                
                  <?php endif; ?>     
                    ">
                </div>
                <div>
                    
                    <span>
                        <h3 class='titre-article'><?php echo $article->getName(); ?></h3>
                        <p class='content-art'>
                          <img class='' src='/public/img/quote.svg'/><?php echo $article->getMiniDescription(); ?> </p>
                    </span>
                    <a class='button-title' href="<?php echo DIRNAME; ?>article/getArticle/<?php echo $article->getId(); ?>">Voir plus...</a>

                </div>
               </div>   
             </div>  
            
          <?php endforeach; ?>
        </div>
        </div>
      

    <!--</form>-->




    <script type="text/javascript" src="<?php echo DIRNAME . "public/js/article.js";?>" >
    </script>

    
  </main>
</body>
<?php include "templates/footer.tpl.php"; ?>
</html>

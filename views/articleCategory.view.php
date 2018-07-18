<body id="body-art">
<main id="main-rdv" class="col-s-11 col-l-8 ">
<div class="container">
    <div class="row">
        <h1 class="title col-s-12 col-m-12 col-l-12">Articles</h1>
    </div>

  <div class="row">
   <?php foreach ($u as $article): ?>
    <div style="padding:0 0.5vw;" class='col-s-12 col-m-6 col-l-6'>
      <div class="article-accueil" style="display: flex; flex-direction: column;">

        <div>
          <img style="width: 100%;overflow: hidden;" src='<?php echo DIRNAME.$article->getImage(); ?>'/>
        </div>
        <div>
            
            <span>
                <h3 class='titre-article'><?php echo $article->getName(); ?></h3>
                <p class='content-art'>
                  <img src="<?php echo DIRNAME . "public/img/quote.svg"; ?>"/><?php echo $article->getMiniDescription(); ?> </p>
            </span>
            <a class='button-title' href="<?php echo DIRNAME; ?>article/getArticle/<?php echo $article->getId(); ?>">Voir plus...</a>

        </div>
       </div>   
       </div>  
            
     <?php endforeach; ?>
  </div>  
</main>
</body>

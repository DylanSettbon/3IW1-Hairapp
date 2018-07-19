
<main>
    <div class="row slideshow-container">

        <div class="mySlides fade">
            <img class="contain-img" alt="Hairapp" src="../public/img/barber1.jpg" style="width:100%">
            <diV class="text-image">
                <h1 class="text-image-h1">Prendre rendez-vous</h1>
                <h2 class="text-image-h2">Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="<?php echo DIRNAME; ?>appointment/getAppointment">Cliquez ici</a>
            </div>
        </div>

        <div class="mySlides fade">
            <img class="contain-img" alt="Voir les forfaits" src="../public/img/barber2.jpg" style="width:100%">
            <diV class="text-image">
                <h1 class="text-image-h1">Prendre rendez-vous</h1>
                <h2 class="text-image-h2">Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="<?php echo DIRNAME; ?>appointment/getAppointment">Cliquez ici</a>
            </div>
        </div>

        <div class="mySlides fade">
            <img class="contain-img" alt="Prendre rendez-vous" src="../public/img/barber3.jpg" style="width:100%">
            <diV class="text-image">
                <h1 class="text-image-h1">Prendre rendez-vous</h1>
                <h2 class="text-image-h2">Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="<?php echo DIRNAME; ?>appointment/getAppointment">Cliquez ici</a>
            </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>

    <div class="acc-dot">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

</main>
<main class="container">

    <section id="acc-articles" class="col-s-12 col-m-12 col-l-4">
        <div class="container">
            <div class="row">

                <h1 class="title col-s-12 col-m-12 col-l-12">Articles</h1>
            </div>

            <div class="row">
            <?php if (count($articles) > 3 ) : ?>
             <?php while ($i < 3): ?>
                 <div class="col-s-12 col-m-12 col-l-12">
                    <div class="article-accueil">
                        <img class="img-art" src="../public/img/quote.svg"/>
                        <span>
                            <h3 class="titre-article"><?php echo $articles[$i]->getName(); ?></h3>
                            <p class="content-art"><?php echo $articles[$i]->getMiniDescription(); ?></p>
                        </span>

                        <a class='button-title' href="<?php echo DIRNAME.'article/getArticle/'. $articles[$i]->getId().''; ?>" >Voir plus...</a>
                     </div>
                </div>
            <?php $i++; ?>
        <?php endwhile ?>
            <?php elseif (count($articles) == 0) : ?>
                         <h3 style="margin: auto;">Bientôt ici, les actualités de votre salon !</h3>
             <?php else : ?>
                <?php foreach( $articles as $article) : ?>
                     <div class="col-s-12 col-m-12 col-l-12">
                        <div class="article-accueil">
                            <img class="img-art" src="../public/img/quote.svg"/>
                            <span>
                                <h3 class="titre-article"><?php echo $article->getName(); ?></h3>
                                <p class="content-art"><?php echo $article->getMiniDescription(); ?></p>
                            </span>
                            <a class='button-title' href="<?php echo DIRNAME.'article/getArticle/'. $article->getId().''; ?>" >Voir plus...</a>
                        </div>
                     </div>
                <?php endforeach ?>
            <?php endif ?>
            
        </div>
           
    </section>

    <section class="col-s-12 col-m-12 col-l-4 forfait-accueil">
        <h2 class="title-carte" style="margin-right: 35px;">Découvrez notre carte</h2>
         
                
                <span>
                    <h3 class="carte">Notre carte</h3>
                    <p class="content-carte">Decouvrez nos forfaits Homme Femme sur notre carte</p>
                    <img alt="barber" class="contain-img" src="../public/img/barber2.jpg" style="width:100%; padding:10px">
                </span>
           
        <a href="forfait" class="btnForfait col-l-10">Cliquez ici</a>
    </section>

    


    </section>
    <section id="" class="col-s-12 col-m-12 col-l-4">
        <h2 class="title-carte center" style="margin-right: 30px;">Flux RSS</h2>
        <div class="col-s-3 col-m-6 col-l-12 side-accueil" style="overflow:scroll;">
            <a class="twitter-timeline" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Flux RSS</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </section>


</main>
</body>

<script src="../public/js/home.js"></script>

<section>
    <div class="row slideshow-container">

        <div class="mySlides fade">
            <img class="contain-img" src="../public/img/barber1.jpg" style="width:100%">
            <diV class="text-image">
                <h1>Prendre rendez-vous</h1>
                <h2>Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="rendezvous">Cliquez ici</a>
            </div>
        </div>

        <div class="mySlides fade">
            <img class="contain-img" src="../public/img/barber2.jpg" style="width:100%">
            <diV class="text-image">
                <h1>Prendre rendez-vous</h1>
                <h2>Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="rendezvous">Cliquez ici</a>
            </div>
        </div>

        <div class="mySlides fade">
            <img class="contain-img" src="../public/img/barber3.jpg" style="width:100%">
            <diV class="text-image">
                <h1>Prendre rendez-vous</h1>
                <h2>Prenez directement rendez-vous avec votre salon en ligne</h2>
                <a href="rendezvous">Cliquez ici</a>
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

</section>
<main class="container">

    <section id="acc-articles" class="col-s-3 col-m-12 col-l-4">
        <div class="container">
            <div class="row">
                <h1 class="title col-s-8 col-m-8 col-l-12">Articles</h1>
            </div>


            <div class="col-s-3 col-m-6 col-l-12 article-accueil">
                <img class="img-art" src="../public/img/quote.svg"/>
                <span>
                    <h3 class="titre-article">Nouvelle Promotion pour 2018 !!</h3>
                    <p class="content-art">-15% sur différentes coupes</p>
                </span>
            </div>


            <div class="col-s-3 col-m-6 col-l-12 article-accueil">
                <img class="img-art" src="../public/img/quote.svg"/>
                <span>
                    <h3 class="titre-article">Changement de numéro de téléphone</h3>
                    <p class="content-art">Notre nouveau numero de téléphone est le 0101010101</p>
                </span>
            </div>


            <div class="col-s-3 col-m-6 col-l-12 article-accueil">
                <img class="img-art" src="../public/img/quote.svg"/>
                <span>
                    <h3 class="titre-article">Nouveau produit en stock</h3>
                    <p class="content-art">C’est un soin restructurant élaboré par L’OREAL PROFESSIONNEL qui agit directement dans le cheveu pour étirer sa texture. Des polymères pénètrent au cœur des fibres pour les galber progressivement, donnant ainsi un aspect subtilement épaissi à votre chevelure. </p>
                </span>
            </div>
    </section>

    <section class="col-s-12 col-m-12 col-l-4 forfait-accueil">
        <h1 class="title center" style="margin-right: 30px;">Découvrez notre carte</h1>
        <a href="forfait" class="btnForfait col-l-10">Cliquez ici</a>
    </section>

    </section>
    <section id="" class="col-s-12 col-m-12 col-l-4">
        <h1 class="title center" style="margin-right: 30px;">Flux RSS</h1>
        <div class="col-s-3 col-m-6 col-l-12 side-accueil" style="overflow:scroll;">
            <a class="twitter-timeline" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Flux RSS</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </section>


</main>
</body>

<script src="../public/js/home.js"></script>
<?php include "templates/footer.tpl.php"; ?>

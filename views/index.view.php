<?php include "templates/header.tpl.php";?>

  <section>
    <div class="row slideshow-container">

      <div class="mySlides fade">
        <img class="contain-img" src="public/img/barber1.jpg" style="width:100%">
          <div class="text-image">
              <h1">Prendre rendez-vous</h1>
              <a href="rendezvous">cliquez ici</a>
          </div>

      </div>

      <div class="mySlides fade">
        <img class="contain-img" src="public/img/barber2.jpg" style="width:100%">
          <div class="text-image" style="left: 15%;">
              <h1">Voir la carte des forfaits</h1>
              <a href="forfait">cliquez ici</a>
          </div>
      </div>

      <div class="mySlides fade">
        <img class="contain-img" src="public/img/barber3.jpg" style="width:100%">
          <div class="text-image">
              <h1">Vitrine</h1>
              <a href="vitrine">cliquez ici</a>
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
      <div class="row">
          <section id="acc-articles" class="col-s-3 col-m-12 col-l-9">
              <div class="container">
                  <div class="row">
                      <h1 class="title col-s-8 col-m-8 col-l-3" style="margin-left: 44px;">Articles</h1>
                  </div>

                  <div class="row">
                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Nouvelle Promotion pour 2018 !!</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>

                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Article</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Article</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>

                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Article</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Article</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>

                      <div class="col-s-3 col-m-6 col-l-5 article-accueil">
                          <img class="img-art" src="public/img/quote.svg"/>
                          <h2 class="titre-article">Article</h2>
                          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
                      </div>
                  </div>
              </div>
          </section>

          <section id="" class="col-s-12 col-m-12 col-l-3">
              <h1 class="title center" style="margin-right: 30px;">Flux RSS</h1>
              <div class="col-s-3 col-m-6 col-l-6 side-accueil" style="overflow:scroll;">
                  <a class="twitter-timeline" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Flux RSS</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
              </div>
          </section>
      </div>

  </main>
</body>

<script src="public/js/home.js"></script>
<?php include "templates/footer.tpl.php"; ?>

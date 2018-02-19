<?php include "templates/header.tpl.php";?>

<body>
  <section>
    <div class="row slideshow-container">

      <div class="mySlides fade">
        <img class="contain-img" src="../public/img/barber1.jpg" style="width:100%">
      </div>

      <div class="mySlides fade">
        <img class="contain-img" src="../public/img/barber2.jpg" style="width:100%">
      </div>

      <div class="mySlides fade">
        <img class="contain-img" src="../public/img/barber3.jpg" style="width:100%">
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
    <section id="acc-articles" class="col-s-3 col-m-12 col-l-9">
      <article class="col-s-3 col-m-12 col-l-10">
        <h1 class="title col-s-8 col-m-8 col-l-4" style="font-size:26px">Article</h1>
      </article>
        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>

        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>

        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>

        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>

        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>

        <div class="col-s-3 col-m-6 col-l-6 row article-accueil">
          <img class="img-art" src="../public/img/quote.svg"></img>
          <h2 class="titre-article">Article</h2>
          <p class="content-art">Bienvenue sur l'espace étudiants de myGES. Cet espace vous permet d'accèder aux services réservés à nos étudiants.</p>
        </div>
    </section>
     <section id="" class="col-s-12 col-m-12 col-l-3">
          <center><h2 class="title">Flux RSS</h2></center>
        <div class="col-s-3 col-m-6 col-l-6 row side-accueil" style="overflow:scroll;">
          <a class="twitter-timeline" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Flux RSS</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
      </section>
  </main>
</body>

<script src="../public/js/home.js"></script>
<?php include "templates/footer.tpl.php"; ?>

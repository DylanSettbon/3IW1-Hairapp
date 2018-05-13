<body id="body-rdv">
	<main id="main-forfait" class="col-s-11 col-l-8">
        <div class="row">
            <h1 id="title-rdv" class="title col-l-4">Notre Carte</h1>
        </div>

        <div class="col-s-12 col-l-5 partie-droite">

            <?php
                $categories = Category::getCategoriesWithPackage($categories);

                foreach($categories as $i=>$category) {
                    $package = new Package();
                    $packages = $package->getAllBy(['id_Category' => $category->getId()], null, 2);
                    if ($i % 2 == 0) {
                        echo '<div class="categorie1 container">
                                <h2 class="title-categorie">' . $category->getDescription() . ' </h2>';
                        foreach ($packages as $package) {
                            echo '<div class="row">
                                    <p class="description">' . $package->getDescription() . '</p>
                                    <p class="prix">' . $package->getPrice() . '</p>
                                  </div>';
                        }
                        echo '<div class="row">
                                     <hr class="col-s-8">
                                  </div>';
                        echo '</div>';
                    }
                }?>
        </div>

        <div class="col-l-2"></div>

        <div class="col-s-12 col-l-5 partie-gauche">
            <?php
            foreach($categories as $i=>$category) {
                if ($i % 2 != 0) {

                    echo '<div class="categorie1 container">
                            <h2 class="title-categorie">' . $category->getDescription() . ' </h2>';
                            foreach ($packages as $package) {
                                echo '<div class="row">
                                        <p class="description">' . $package->getDescription() . '</p>
                                        <p class="prix">' . $package->getPrice() . '</p>
                                    </div>';
                            }
                                echo '<div class="row">
                                        <hr class="col-s-8">
                                      </div>';
                    echo '</div>';
                    }
                }
            ?>
        </div>
    </main>
</body>

<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script src="../public/js/index.js"></script>
<?php include "templates/footer.tpl.php"; ?>
</html>
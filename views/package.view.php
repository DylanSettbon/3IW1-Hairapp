<body id="body-rdv">
	<main id="main-forfait" class="col-s-11 col-l-8">
        <div class="row">
            <h1 id="title-rdv" class="title col-l-4">Notre Carte</h1>
        </div>

        <?php if (empty($categories)):?>
            <h2 class="title-section-rdv">En construction...</h2>

        <?php else: ?>
        <div class="col-s-12 col-l-5 right-side">
            <?php foreach($categories as $i=>$category):?>
                <?php if ($i % 2 == 0):?>
                        <div class="categorie1 container">
                                <h2 class="title-categorie"><?php echo $category->getDescription();?></h2>
                        <?php foreach ($packages[$category->getId()] as $package):?>
                            <div class="row">
                                <p class="description"><?php echo $package->getDescription(); ?></p>
                                <p class="prix"><?php echo $package->getPrice(); ?> €</p>
                                <p class="duree"><?php echo $package->getTextDuration(); ?></p>
                            </div>
                        <?php endforeach; ?>
                            <div class="row">
                                <hr class="col-s-8">
                            </div>
                        </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="col-l-2"></div>

        <div class="col-s-12 col-l-5 left-side">
            <?php foreach($categories as $i=>$category):?>
                <?php if ($i % 2 != 0):?>
                    <div class="categorie container">
                        <h2 class="title-categorie"><?php echo $category->getDescription();?></h2>
                        <?php foreach ($packages[$category->getId()] as $package):?>
                            <div class="row">
                                <p class="description"><?php echo $package->getDescription(); ?></p>
                                <p class="prix"><?php echo $package->getPrice(); ?> €</p>
                                <p class="duree"><?php echo $package->getTextDuration(); ?></p>
                            </div>
                        <?php endforeach; ?>
                        <div class="row">
                            <hr class="col-s-8">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </main>
</body>

<script src="../public/js/index.js"></script>

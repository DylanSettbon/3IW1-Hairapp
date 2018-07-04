<body id="body-rdv">

<main id="main-rdv" class="col-s-11 col-l-8">

    <div class="row">
        <h1 id="title-rdv" class="title col-l-10">Prendre rendez-vous</h1>
    </div>

    <?php if (isset($data)):?>
        <?php foreach ($data as $d):?>
            <?php if(array_key_exists('errors',$data)): ?>
                <ul class="errors">
                <?php for ($i=0;$i<count($d);$i++):?>
                    <li>
                        <div class="div-errors danger">
                            <p><?php echo $d[$i];?></p>
                        </div>
                    </li>
                <?php endfor; ?>
                </ul>
            <?php else: ?>
                <?php for ($i=0;$i<count($d);$i++):?>
                    <p><?php echo $d;?></p>
                <?php endfor; ?>
            <?php endif; ?>
        <?php endforeach;?>
    <?php endif; ?>

    <form method='post' action='saveAppointment'>

        <section id="choix-coiffeur" class="row">
            <h2 class="title-section-rdv">Designez votre coiffeur</h2>
            <div class="container liste-coiffeur">
                <li>
                    <input value="all" name="hairdresser" id="coiffeurTous" type="checkbox" checked>
                    <label for="coiffeurTous" checked>
                        <span class="nom-coiffeur">Tous</span>
                    </label>
                </li>
                <?php foreach($hairdressers as $hairdresser): ?>
                    <li>
                        <input value="<?php echo $hairdresser->getId() ?>" name="hairdresser" id="coiffeur<?php echo $hairdresser->getId(); ?>" type="checkbox">
                        <label for="coiffeur<?php echo $hairdresser->getId(); ?>">
                            <span class="nom-coiffeur"><?php echo $hairdresser->getFirstname();?></span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="choix-forfait" class="row">
            <h2 class="title-section-rdv">Choissisez votre forfait</h2>

            <select name="package" id="package" class="appointmentAttr col-s-12 liste_deroulante">
                <option selected disabled>Choisir un forfait</option>
                <?php foreach($categories as $i=>$category):?>
                    <optgroup label="-- <?php echo $category->getDescription()?> --">
                        <?php foreach($packages[$category->getId()]  as $package): ?>
                            <option value="<?php echo $package->getId()?>"> <?php echo $package->getDescription();?> </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
        </section>

        <section id="selection-date" class="row">
            <h2 class="title-section-rdv">Selectionnez une date</h2>
            <div class="container date">

                <select name="jour" id="jour" class="appointmentAttr liste_deroulante">
                    <option selected disabled>Jour</option>
                </select>

                <select name="mois" id="mois" class="appointmentAttr liste_deroulante">
                    <option selected disabled>Mois</option>
                </select>

                <select name="annee" id="annee" class="appointmentAttr liste_deroulante">
                    <option selected>2018</option>
                    <option value="2019">2019</option>
                </select>
            </div>


            <ul id="appointmentHour" class="container checkbox-heure-rdv">
            </ul>

            <select name="heure" id="heure" class="col-s-3 liste_deroulante">
                <option selected disabled>Heure</option>
            </select>
        </section>
        <input class="btn-Valider col-s-12 col-l-12" type="submit" value="Valider" name="btn-Valider">
    </form>
</main>
</body>
<script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script type="text/javascript" src="../public/js/appointment.js"></script>
</html>




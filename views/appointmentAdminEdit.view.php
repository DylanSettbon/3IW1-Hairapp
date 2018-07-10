<body id="body-rdv">

<main id="main-rdv" class="col-s-11 col-l-8">

    <div class="row">
        <h1 id="title-rdv" class="title col-l-10"><?php echo $titleEdit?></h1>
    </div>

    <form method='post' action='/admin/saveAppointment'>
        <section id="choix-coiffeur" class="row">
            <div class="container liste-coiffeur">
                <select name="hairdresser" id="hairdresser" class="appointmentAttr col-s-12 liste_deroulante">
                    <option selected disabled><?php echo isset($currentAppointment)? $currentAppointment->getIdHairdresser():'Coiffeur';?></option>
                </select>
            </div>
        </section>

        <section id="choix-forfait" class="row">
            <select name="package" id="package" class="appointmentAttr col-s-12 liste_deroulante">
                <option selected disabled><?php echo isset($currentAppointment)? $currentAppointment->getIdPackage():'Choisir un forfait';?></option>
            </select>
        </section>

        <section id="selection-date" class="row">
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

                 <select name="appointmentHour" id="appointmentHour" class="appointmentAttr-3 liste_deroulante" style="margin-left: 40px;">
                    <option selected disabled><?php echo isset($currentAppointment)? substr($currentAppointment->getHourAppointment(),0,5):'Heure';?></option>
                     <?php foreach ($hours as $hour): ?>
                        <option value='<?php echo $hour ?>'><?php echo $hour?></option>
                     <?php endforeach;?>
                 </select>

            </div>
        <input class="btn-Valider col-s-12 col-l-12" type="submit" value="Valider" name="btn-Valider">
    </form>
</main>
</body>

<script type="text/javascript" src="/public/js/appointment.js"></script>
</html>
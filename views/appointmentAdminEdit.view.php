<body id="body-rdv">

<main id="main-rdv" class="col-s-11 col-l-8">
    <div class="row">
        <h1 id="title-rdv" class="title col-l-10"><?php echo $titleEdit?></h1>
    </div>
    <?php if (isset($data)):?>
        <?php foreach ($data as $d):?>
            <ul class="errors">
                <?php if(array_key_exists('errors',$data)): ?>
                    <?php for ($i=0;$i<count($d);$i++):?>
                        <li>
                            <div class="div-errors danger">
                                <p><?php echo $d[$i];?></p>
                            </div>
                        </li>
                    <?php endfor; ?>

                <?php else: ?>
                    <?php for ($i=0;$i<count($d);$i++):?>
                        <div class="div-errors success">
                            <p><?php echo $d;?></p>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </ul>
        <?php endforeach;?>
    <?php endif; ?>

    <?php if(empty($users) && $mode == 'add'):?>
        <ul class="errors">
            <li>
                <div class="div-errors information">
                    <p><strong>Aucun utilisateur enregistrès</strong>
                        <br><br>Pour pouvoir enregistrer un rendez-vous, il vous faut avoir des utilisateurs enregistrés.
                        <br>Vous pouvez en enregistrer depuis <a href="/admin/getUserAdmin">ici</a></p>
                </div>
            </li>
        </ul>
    <?php else:?>

    <form method='post' action='/admin/saveAppointment<?php echo isset($currentAppointment)? '/'.$currentAppointment->getId():'';?>'>
        <section id="choix-coiffeur" class="row">
                <select name="hairdresser" id="hairdresser" class="appointmentAttr col-s-12 liste_deroulante">
                    <option selected disabled><?php echo isset($currentAppointment)? $currentAppointment->getIdHairdresser():'Choisir un coiffeur';?></option>
                        <?php foreach ($hairdressers as $hairdresser): ?>
                            <?php if (isset($currentAppointment)): ?>
                                <?php if($currentAppointment->getIdHairdresser() != $hairdresser->getFullName()):?>
                                    <option value='<?php echo $hairdresser->getId() ?>'><?php echo Security::setHtmlEntitiesForData($hairdresser->getFullName());?></option>
                                <?php endif; ?>
                            <?php else: ?>
                                <option value='<?php echo $hairdresser->getId() ?>'><?php echo Security::setHtmlEntitiesForData($hairdresser->getFullName());?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                </select>
        </section>

        <section id="choix-forfait" class="row">
            <select name="package" id="package" class="appointmentAttr col-s-12 liste_deroulante">
                <option selected disabled><?php echo isset($currentAppointment)? $currentAppointment->getIdPackage():'Choisir un forfait';?></option>
                <?php foreach($categories as $i=>$category):?>
                    <optgroup label="-- <?php echo $category->getDescription()?> --">
                            <?php foreach($packages[$category->getId()]  as $package): ?>
                                <?php if (isset($currentAppointment)): ?>
                                    <?php if ($package->getDescription() != $currentAppointment->getIdPackage()): ?>
                                        <option value="<?php echo $package->getId()?>"> <?php echo Security::setHtmlEntitiesForData($package->getDescription());?> </option>
                                    <?php endif;?>
                                <?php else:?>
                                        <option value="<?php echo $package->getId()?>"> <?php echo Security::setHtmlEntitiesForData($package->getDescription());?> </option>
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
        </section>

        <?php if(!empty($users)):?>
        <section id="choix-coiffeur" class="row">
            <select name="user" id="user" class="appointmentAttr col-s-12 liste_deroulante">
                <option selected disabled>Choisir un utilisateur</option>
                <?php foreach ($users as $user): ?>
                    <option value='<?php echo $user->getId() ?>'><?php echo Security::setHtmlEntitiesForData($user->getFullName());?></option>
                <?php endforeach;?>
            </select>
        </section>
        <?php endif; ?>

        <section id="selection-date" class="row">
            <div class="container date">
                <select name="jour" id="jour" class="appointmentAttr liste_deroulante">
                    <option selected value="<?php echo isset($day) ? $day: date('j');?>"><?php echo isset($day) ? $day < 10 ? '0'.$day : $day: date('d');?></option>
                </select>

                <select name="mois" id="mois" class="appointmentAttr liste_deroulante">
                    <option selected value="<?php echo isset($month) ? $month: date('n');; ?>"><?php echo isset($month) ? $month < 10 ? '0'.$month : $month : date('m');; ?></option>
                </select>

                <select name="annee" id="annee" class="appointmentAttr liste_deroulante">
                    <option selected><?php echo isset($year) ? $year: date("Y");?></option>
                    <option value="<?php echo date("Y") +1;?>"><?php echo date("Y") +1;?></option>
                </select>

                 <select name="selectHour" id="appointmentHour" class="appointmentAttr-3 liste_deroulante" style="margin-left: 40px;">
                    <option selected disabled><?php echo isset($currentAppointment)? substr($currentAppointment->getHourAppointment(),0,5):'Heure';?></option>
                     <?php foreach ($hours as $hour): ?>
                        <option value='<?php echo $hour ?>'><?php echo $hour?></option>
                     <?php endforeach;?>
                 </select>
            </div>
        <input class="btn-Valider col-s-12 col-l-12" type="submit" value="Valider" name="btn-Valider">
    </form>
    <?php endif; ?>
</main>
</body>

<script type="text/javascript" src="<?php echo DIRNAME ."public/js/appointmentAdmin.js"; ?>" ></script>
</html>
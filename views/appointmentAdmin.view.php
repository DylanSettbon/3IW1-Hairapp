<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 28/06/2018
 * Time: 22:44
 */
include "templates/sidebar.view.php";
?>


<div class="content">
    <article class="arriere_plan">
        <h1 class="packageAdmin-title">Gestion des rendez-vous</h1>
        <div class="row">
            <a id='add' href="/admin/updateAppointment" class='buttonUserAdd' style="margin-bottom: 0px;">Ajouter un rendez-vous</a>
        </div>
        <input id="search" class="input col-l-2" placeholder="Recherchez...">
        <a id='getPastAppointment' href="/admin/getAppointmentAdmin/<?php echo $filter == 'past'? 'futur':'past'?>" class='buttonUserModify buttonSecondary row'>Afficher les rendez-vous <?php echo $filter == 'past'? 'à venir':'passé(s)'?></a>
        <div class="col-s-12 col-m-8 col-l-12 form_register_admin">
            <div class="col-l-4">
                <h2 class="center title">Gestion des rendez-vous</h2>
            </div>
        </div>
        <div class="col-s-12 col-l-12 col-m-9 tab-admin">
            <?php if(empty($appointments)):?>
                <ul class="errors">
                    <li>
                        <div class="div-errors information">
                            <p><strong>Aucun rendez-vous</strong>
                                <br><br>Vous pouvez ajouter de nouveaux rendez-vous ou attendre que de nouveaux rendez-vous soient enregistrés</p>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
            <table class="userManagerTab col-l-12">
                <tr>
                    <th id="date">Date</th>
                    <th id="hour">Heure</th>
                    <th id="user">Client</th>
                    <th id="hairdresser">Coiffeur</th>
                    <th id="package">Forfaits</th>
                </tr>
                <tbody id="searchList">
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo Security::setHtmlEntitiesForData($appointment->getFormatedDateAppointment()); ?></td>
                        <td><?php echo Security::setHtmlEntitiesForData($appointment->getHourAppointment()); ?> </td>
                        <td><?php echo Security::setHtmlEntitiesForData($appointment->getIdUser()); ?></td>
                        <td><?php echo Security::setHtmlEntitiesForData($appointment->getIdHairdresser()); ?></td>
                        <td><?php echo Security::setHtmlEntitiesForData($appointment->getIdPackage()); ?></td>
                        <?php if($filter != 'past'): ?>
                            <td><a id='modify' href="/admin/updateAppointment/<?php echo $appointment->getId() ?>" class='buttonUserModify'>Modifier</a></td>
                            <td><a id='delete' href="/admin/deleteAppointment/<?php echo $appointment->getId() ?>" class='buttonUserDelete'>Supprimer</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </article>

</div>
</main>

<script type="text/javascript" src="/public/js/searchBar.js"></script>


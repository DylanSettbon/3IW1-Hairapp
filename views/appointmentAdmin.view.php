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
        <select name="appointmentFieldsSearch" id="appointmentFieldsSearch" class="col-l-2 col-s-12 liste_deroulante">
            <option value="date">Date</option>
            <option value="hour">Heure</option>
            <option value="user">Client</option>
            <option value="hairdresser">Coiffeur</option>
            <option value="package">Forfaits</option>
        </select>

        <input id="searchAppointment" name="searchAppointment" class="input col-l-2">

        <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

            <div class="col-l-4">
                <h2 class="center title">Gestion des rendez-vous</h2>
            </div>
        </div>

        <div class="col-s-12 col-l-12 col-m-9 tab-admin">
            <table class="userManagerTab col-l-12">
                <tr>
                    <th id="date"><a href="">Date</a></th>
                    <th id="hour">Heure</th>
                    <th id="user">Client</th>
                    <th id="hairdresser">Coiffeur</th>
                    <th id="package">Forfaits</th>
                </tr>

                <?php foreach ( $appointments as $appointment ): ?>
                    <tr>
                                
                        <td><?php echo $appointment->getFormatedDateAppointment(); ?></td>
                        <td><?php echo $appointment->getHourAppointment(); ?> </td>
                        <td><?php echo $appointment->getIdUser(); ?></td>
                        <td><?php echo $appointment->getIdHairdresser(); ?></td>
                        <td><?php echo $appointment->getIdPackage(); ?></td>
                        <td><a id='modify' href='#' class='buttonUserModify'>Modifier</a></td>
                        <td><a id='delete' href='#' class='buttonUserDelete'>Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>

                <nav aria-label="navigation">
                    <tr class="page">
                        <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                        <td class="page center" colspan="5">1/104</td>
                        <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                    </tr>
                </nav>
            </table>
        </div>
    </article>
</div>

</main>


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
        <input id="search" class="input col-l-2" placeholder="Recherchez...">
        <div class="col-s-12 col-m-8 col-l-12 form_register_admin">
            <div class="col-l-4">
                <h2 class="center title">Gestion des rendez-vous</h2>
            </div>
        </div>

        <div class="col-s-12 col-l-12 col-m-9 tab-admin">
            <table class="userManagerTab col-l-12">
                <tr>
                    <th id="date">Date</th>
                    <th id="hour">Heure</th>
                    <th id="user">Client</th>
                    <th id="hairdresser">Coiffeur</th>
                    <th id="package">Forfaits</th>
                </tr>
                <tbody id="appointmentList">
                <?php foreach ( $appointments as $appointment ): ?>
                    <tr>
                        <td><?php echo $appointment->getFormatedDateAppointment(); ?></td>
                        <td><?php echo $appointment->getHourAppointment(); ?> </td>
                        <td><?php echo $appointment->getIdUser(); ?></td>
                        <td><?php echo $appointment->getIdHairdresser(); ?></td>
                        <td><?php echo $appointment->getIdPackage(); ?></td>
                        <td><a id='modify' href="/admin/updateAppointment/<?php echo $appointment->getId() ?>" class='buttonUserModify'>Modifier</a></td>
                        <td><a id='delete' href="/admin/deleteAppointment/<?php echo $appointment->getId() ?>" class='buttonUserDelete'>Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
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
    <a id='add' href="updateAppointment" class='buttonUserAdd'>Ajouter un rendez-vous</a>


</div>

</main>

<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#appointmentList tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


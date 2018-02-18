<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/02/2018
 * Time: 11:27
 */

include "templates/admin_header.tpl.php";
?>

    <section class="col-l-10 col-m-9 col-s-12">
        <article class="title col-l-4 col-s-8 col-m-4">
            <h1>
                Nombre de visites
            </h1>
        </article>
        &nbsp;
        <img src="../public/img/activity.png" class="col-l-12 col-s-12 center">

    </section>
    &nbsp;
    <section class="col-l-10 col-s-12 col-m-9">
        <article class="title col-l-4 col-s-8 col-m-3">
            <h1>
                Planning
            </h1>
        </article>
    </section>
&nbsp;
    <aside class="col-l-2 col-s-12 col-m-2 column-direction center">

        <button class="col-l-8 col-s-3 col-m-9 center hairdresser1 button">
            Coiffeur 1
        </button>
        &nbsp;
        <button class="col-l-8 col-s-3 col-m-9 center hairdresser2 button">
            Coiffeur 2
        </button>
        &nbsp;
        <button class="col-l-8 col-s-3 col-m-9 center hairdresser3 button">
            Coiffeur 3
        </button>
        &nbsp;
        <button class="col-l-8 col-s-3 col-m-9 center all button">
            Tous
        </button>
        &nbsp;
    </aside>
&nbsp;
    <article class="col-l-7 col-s-12 col-m-7 center">
    <table class="col-l-12 col-s-12 center" id="planning">
        <tr>
            <th>Mardi</th>

            <th>Mercredi</th>

            <th>Jeudi</th>

            <th>Vendredi</th>

            <th>Samedi</th>
        </tr>
        <tr class="planning">
            <td class="hairdresser1">9:30 Durand  </td>
            <td class="hairdresser2">9:30 Carpentier </td>
            <td > - </td>
            <td class="hairdresser3">9:30 Salomon </td>
            <td > - </td>
        </tr>
        <tr class="planning">
            <td> - </td>
            <td class="hairdresser3">11:00 Fernandez </td>
            <td class="hairdresser2">11:00 Durand  </td>
            <td> - </td>
            <td> - </td>
        </tr>
        <tr class="planning">
            <td > - </td>
            <td class="hairdresser1">11:30 Carpentier  </td>
            <td > - </td>
            <td > - </td>
            <td > - </td>
        </tr>
        <tr class="planning">
            <td class="hairdresser2"> 14:00 Durand</td>
            <td > - </td>
            <td class="hairdresser3"> 14:00 Fernandez</td>
            <td class="hairdresser2"> 14:00 Carpentier</td>
            <td class="hairdresser1"> 14:00 Fernandez </td>
        </tr>
        <tr class="planning">
            <td class="hairdresser3">15:00 Carpentier</td>
            <td > - </td>
            <td class="hairdresser1">15:00 Fernandez</td>
            <td > - </td>
            <td class="hairdresser2">15:00 Delamare </td>
        </tr>
        <tr class="planning">
            <td class="hairdresser1"> 15:30 Canabady</td>
            <td class="hairdresser3">15:30 Fernadez</td>
            <td > - </td>
            <td class="hairdresser2"> 15:30 Delhoume</td>
            <td > _ </td>
        </tr>
        <tr class="planning">
            <td > - </td>
            <td class="hairdresser1">11:30 Carpentier  </td>
            <td > - </td>
            <td > - </td>
            <td > - </td>
        </tr>
        <tr class="planning">
            <td class="hairdresser1">9:30 Durand  </td>
            <td class="hairdresser2">9:30 Carpentier </td>
            <td > - </td>
            <td class="hairdresser3">9:30 Salomon </td>
            <td > - </td>
        </tr>
        <tr class="planning">
            <td > - </td>
            <td class="hairdresser1">11:30 Carpentier  </td>
            <td > - </td>
            <td > - </td>
            <td > - </td>
        </tr>

    </table>
    &nbsp;
</article>
</main>

<?php

include "templates/footer.tpl.php";
?>



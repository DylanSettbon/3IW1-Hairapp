<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/02/2018
 * Time: 11:27
 */
?>
<main class='container'>

        <div>
            <section class="col-l-12 col-m-9 col-s-12">
                <h1 id="title-rdv" class="title col-l-4">Nombre de visites </h1>
                <img src="../public/img/activity.png" class="col-l-12 col-s-12 center">

            </section>
            <section class="col-l-10 col-s-12 col-m-9">
                <h1 id="title-rdv" class="title col-l-4">Planning</h1>
            </section>

            <aside class="col-l-3 col-s-12 col-m-2 column-direction center">

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

            <article class="col-l-9 col-s-12 col-m-7 center">
                <div style="overflow-x: auto">
                    <!--

                    - sortir les heures du tableau
                    - pour le planning par coiffeur on affiche le nom du client
                    - lorsque "tous" est coché, on split la colone du jour en 3 ( ou nombre de coiffeur )
                        et on colorie seulement la case en fonction de si le coiffeur a un rdv ou pas
                        opt "draggable = true" permet de drag les elements ailleurs

                    -->
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
                </div>

                &nbsp;
            </article>

        </div>


</main>


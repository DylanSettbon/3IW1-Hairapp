<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 01/06/2018
 * Time: 11:55
 */

?>
<div class="row">
    <!--<aside class="col-l-12 col-s-12 col-m-12 center">-->

        <button class="col-l-2 col-s-3 col-m-9 center hairdresser1 button">Coiffeur 1</button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center hairdresser2 button">Coiffeur 2</button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center hairdresser3 button">
            Coiffeur 3
        </button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center all button">
            Tous
        </button>
        &nbsp;
    <!--</aside>-->
</div>
&nbsp;
<div class="row">
    <div class="col-l-2">
        <table class=" col-l-12 center">
            <th>Horaires</th>
            <?php for( $i = 9; $i < 19; $i += 0.5 ): ?>

                <?php if( preg_match( '#[0-9]{1,2}[.]#', $i) ): ?>
                    <tr>
                        <td>
                            <?php $time = str_replace( '.5', ':30', $i) ; echo $time;?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endfor; ?>
        </table>
    </div>
    <article class="col-l-9 col-s-12 col-m-1é center">
        <div style="overflow-x: auto">
            <!--

            - sortir les heures du tableau
            - pour le planning par coiffeur on affiche le nom du client
            - lorsque "tous" est coché, on split la colone du jour en 3 ( ou nombre de coiffeur )
                et on colorie seulement la case en fonction de si le coiffeur a un rdv ou pas
                opt "draggable = true" permet de drag les elements ailleurs

            -->
            <table class="col-l-12 col-s-12 center" id="planning">
                <?php foreach ( $vars as $day => $date): ?>
                    <th> <?php echo $day; ?></th>
                <?php endforeach; ?>
                <tr class="planning">
                    <td class="hairdresser1"> Durand  </td>
                    <td class="hairdresser2"> Carpentier </td>
                    <td > - </td>
                    <td class="hairdresser3"> Salomon </td>
                    <td > - </td>
                </tr>
                <tr class="planning">
                    <td> - </td>
                    <td class="hairdresser3"> Fernandez </td>
                    <td class="hairdresser2"> Durand  </td>
                    <td> - </td>
                    <td> - </td>
                </tr>
                <tr class="planning">
                    <td > - </td>
                    <td class="hairdresser1"> Carpentier  </td>
                    <td > - </td>
                    <td > - </td>
                    <td > - </td>
                </tr>
                <tr class="planning">
                    <td class="hairdresser2">  Durand</td>
                    <td > - </td>
                    <td class="hairdresser3">  Fernandez</td>
                    <td class="hairdresser2">  Carpentier</td>
                    <td class="hairdresser1">  Fernandez </td>
                </tr>
                <tr class="planning">
                    <td class="hairdresser3"> Carpentier</td>
                    <td > - </td>
                    <td class="hairdresser1"> Fernandez</td>
                    <td > - </td>
                    <td class="hairdresser2"> Delamare </td>
                </tr>
                <tr class="planning">
                    <td class="hairdresser1">  Canabady</td>
                    <td class="hairdresser3"> Fernadez</td>
                    <td > - </td>
                    <td class="hairdresser2">  Delhoume</td>
                    <td > _ </td>
                </tr>
                <tr class="planning">
                    <td > - </td>
                    <td class="hairdresser1"> Carpentier  </td>
                    <td > - </td>
                    <td > - </td>
                    <td > - </td>
                </tr>
                <tr class="planning">
                    <td class="hairdresser1"> Durand  </td>
                    <td class="hairdresser2"> Carpentier </td>
                    <td > - </td>
                    <td class="hairdresser3"> Salomon </td>
                    <td > - </td>
                </tr>
                <tr class="planning">
                    <td > - </td>
                    <td class="hairdresser1"> Carpentier  </td>
                    <td > - </td>
                    <td > - </td>
                    <td > - </td>
                </tr>

            </table>
        </div>

        &nbsp;
    </article>
</div>





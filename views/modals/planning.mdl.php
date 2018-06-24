<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 01/06/2018
 * Time: 11:55
 */
$week = $vars['week'];
$appointments = $vars['appointments'];

?>
<div class="row">
    <!--<aside class="col-l-12 col-s-12 col-m-12 center">-->

        <button class="col-l-2 col-s-3 col-m-9 center hairdresser1 button" onclick="hairdresser(1)">Coiffeur 1</button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center hairdresser2 button" onclick="hairdresser(2)">Coiffeur 2</button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center hairdresser3 button" onclick="hairdresser(3)">
            Coiffeur 3
        </button>
        &nbsp;
        <button class="col-l-2 col-s-3 col-m-9 center all button" onclick="hairdresser('all')">
            Tous
        </button>
        &nbsp;
    <!--</aside>-->
</div>
&nbsp;
<div class="row">
    <article class="col-l-12 col-s-12 col-m-12 center">
        <div style="overflow-x: auto">
            <!--

            - sortir les heures du tableau
            - pour le planning par coiffeur on affiche le nom du client
            - lorsque "tous" est coché, on split la colone du jour en 3 ( ou nombre de coiffeur )
                et on colorie seulement la case en fonction de si le coiffeur a un rdv ou pas
                opt "draggable = true" permet de drag les elements ailleurs

            -->
            <table class="col-l-2 col-s-2 center" id="planning">
                <th>Horaires</th>
                <?php for( $i = 9; $i < 19; $i += 0.5 ): ?>

                    <?php if( preg_match( '#[0-9]{1,2}[.]#', $i) ): ?>
                        <tr>
                            <td>
                                <?php $i < 10? $k = "0".$i: $k = $i;?>
                                <?php $time = str_replace( '.5', ':30', $k);echo $time;?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>
                                <?php $i < 10?$k = "0". $i: $k = $i; ?>
                                <?php echo $k.':00'; ?>
                            </td>
                        </tr>
                    <?php endif; ?>


                <?php endfor; ?>
            </table>

            <?php foreach ( $week as $day => $date): ?>
                <table class="col-l-2 col-s-2 center" id="planning">
                    <th> <?php echo $day; ?></th>

                    <?php
                        //TODO: changer les valeurs de i par les valeurs ouverture/fermeture choisies à l'install
                    ?>
                    <?php for( $i = 9; $i < 19; $i += 0.5 ): ?>
                        <?php $exist = 0; ?>

                        <?php if( preg_match( '#[0-9]{1,2}[.]#', $i) ): ?>

                            <?php $i < 10? $k = "0".$i: $k = $i;?>
                            <?php $time = str_replace( '.5', ':30', $k);?>

                                <?php foreach ( $appointments as $appointment  ): ?>

                                    <?php if ( $appointment->getHourAppointment() == $time .":00" && $appointment->getDateAppointment() == $date ): ?>
                                        <tr>
                                            <td class="coiffeur-<?php echo $appointment->getIdHairdresser(); ?>">
                                                <span> <?php echo $appointment->getFirstname(); ?></span>
                                            </td>
                                        </tr>
                                    <?php $exist = 1; ?>
                                    <?php endif; ?>

                                <?php endforeach; ?>

                        <?php else: ?>

                            <?php $i < 10?$k = "0". $i: $k = $i; ?>

                                <?php foreach ( $appointments as $appointment  ): ?>

                                    <?php if ( $appointment->getHourAppointment() == $k .":00:00" && $appointment->getDateAppointment() == $date ): ?>

                                        <tr>
                                            <td class="coiffeur-<?php echo $appointment->getIdHairdresser(); ?>">
                                                <span> <?php echo $appointment->getFirstname(); ?></span>
                                            </td>
                                        </tr>
                                        <?php $exist = 1; ?>
                                <?php endif; ?>

                                <?php endforeach; ?>

                        <?php endif; ?>

                        <?php if( $exist == 0 ): ?>
                            <tr>
                                <td>-</td>
                            </tr>
                        <?php endif; ?>

                    <?php endfor; ?>

                </table>
            <?php endforeach; ?>


        </div>

        &nbsp;
    </article>
</div>

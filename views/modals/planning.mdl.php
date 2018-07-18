<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 01/06/2018
 * Time: 11:55
 */
$week = $vars['week'];
$appointments = $vars['appointments'];
$hairdressers = $vars['hairdressers'];

$hairdresser_class = [];

$haidresserCounter = 1;

?>
<div class="row">

    <?php foreach ( $hairdressers as $hairdresser ): ?>

    <button class="col-l-2 col-s-3 col-m-9 center <?php echo "hairdresser".$haidresserCounter; ?> button"
            onclick="hairdresser(<?php echo $haidresserCounter; ?>)">
        <?php echo $hairdresser->getFirstname();  ?>
        <?php $hairdresser_class[$hairdresser->getId()] = "coiffeur-".$haidresserCounter ; ?>
        <?php $haidresserCounter += 1; ?>
    </button>
    &nbsp;

    <?php endforeach; ?>

    <button class="col-l-2 col-s-3 col-m-9 center all button" onclick="hairdresser('all')">Tous</button>

</div>
&nbsp;
<div class="row">
    <article class="col-l-12 col-s-12 col-m-12 center">
        <div style="overflow-x: auto">
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
                                            <td

                                            <?php foreach ( $hairdresser_class as $hairdresser => $value ): ?>

                                                <?php if ( $appointment->getIdHairdresser()  == $hairdresser ): ?>
                                                    class="<?php echo $value; ?>">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
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
                                            <td
                                                <?php foreach ( $hairdresser_class as $hairdresser => $value ): ?>
                                                    <?php if ( $appointment->getIdHairdresser()  == $hairdresser ): ?>
                                                        class="<?php echo $value; ?>">
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
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

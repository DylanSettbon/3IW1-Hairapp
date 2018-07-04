<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 28/05/2018
 * Time: 12:33
 */
?>

<div class="container">
    <div class="account">
        <div class="row">
            <div class="col-l-12">
                <h1> <?php echo "Bonjour " . $account['prenom']; ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-l-5 center">
            </div>
            <div class="col-l-7 col-s-7 col-m-7 left">

                <?php if( !empty( $account['picture'] ) ): ?>

                    <img src="<?php echo DIRNAME.$account['picture']; ?>" id="profilePicture" alt="Avatar">

                <?php endif; ?>
            </div>
        </div>

        <div class="row">

            <div class="col-l-6 center">
                <h2> Modifier vos informations personnelles :</h2>

                <?php $this->addModal("form", $config, [], $account ); ?>

                <ul class="errors">
                    <?php if( isset( $errors ) ): ?>
                        <?php foreach ( $errors as $error ): ?>
                            <li>
                                <div class="div-errors danger">
                                    <p><strong> Warning ! </strong><?php echo $error;?></p>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

            </div>


        </div>

        <div class="row">
            <div class="col-l-6 center"><hr></div>
        </div>

        <div class="row">
            <div class="col-l-6 center">
                <h2> Changer votre mot de passe :</h2>
                <?php $this->addModal("form", $config_pwd, [], $account ); ?>
            </div>
        </div>
        &nbsp;
        <div class="row">
            <div class="col-l-6 center"><hr></div>
        </div>
        <div class="row">
            <div class="col-l-6 center">
                <h2> Rendez-vous à venir : </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-l-6 center">

                <div class="col-l-6 center">
                    <?php $i = 0; ?>
                    <?php foreach ( $appointments as $appointment ):?>
                        <ul>
                        <?php if( $i < ( count( $appointments) / 2 ) ):?>

                                <li><?php echo "Le " . $appointment->getDateAppointment() . " à " . $appointment->getHourAppointment() . " avec " . $appointment->getFirstname() ;?>
                                </li>

                         <?php $i++; endif; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
                <div class="col-l-6 center">

                    <?php $i = 0 ; ?>
                    <?php foreach ( $appointments as $appointment ):?>
                        <ul>
                            <?php if( $i < ( count( $appointments) / 2 ) ):?>

                            <?php $i++; else: ?>
                                <li>
                                    <?php echo "Le " . $appointment->getDateAppointment() . " à " . $appointment->getHourAppointment() . " avec " . $appointment->getFirstname() ;?>
                                </li>
                            <?php $i++; endif; ?>
                        </ul>
                    <?php endforeach; ?>

                </div>


            </div>
        </div>
    </div>



</div>
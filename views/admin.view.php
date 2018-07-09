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

            <section class="col-l-12 col-s-12 col-m-9">
                <?php $this->addModal('planning', null, null, array( 'week' => $week, 'appointments' => $appointments) )?>
            </section>


        </div>


</main>


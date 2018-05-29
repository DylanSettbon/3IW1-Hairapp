<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 28/05/2018
 * Time: 12:33
 */
?>

<div class="container">

    <div class="row">
        <div class="col-l-12">
            <h1> My account </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-l-6 center">

            <?php foreach ( $account as $info ): ?>

                <?php var_dump( $account ); die; ?>

            <?php endforeach; ?>

            <?php $this->addModal("form", $config ); ?>

        </div>
    </div>

</div>

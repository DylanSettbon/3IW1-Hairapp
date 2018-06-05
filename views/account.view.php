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

</div>

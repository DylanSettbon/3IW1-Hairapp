<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-4">S'inscrire</h1>
                            </div>

                            <?php $this->addModal("form", $config ); ?>

                           <?php if( isset( $errors ) ): ?>
                            <ul class="errors">

                                <?php foreach ( $errors as $error ): ?>
                                    <li>
                                        <div class="div-errors danger">
                                            <p><strong> Warning ! </strong><?php echo $error;?></p>
                                        </div>

                                    </li>
                                <?php endforeach; ?>

                            </ul>
                            <?php endif; ?>

                            <?php if( isset( $success ) ): ?>
                                <ul class="errors">
                                    <li>
                                        <div class="div-errors success">
                                            <p><strong> Success ! </strong><?php echo $success;?></p>
                                        </div>

                                    </li>
                                </ul>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>

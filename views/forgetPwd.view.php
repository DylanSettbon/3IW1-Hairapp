<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-12">Saisie de l'email</h1>
                            </div>
                           <?php

                            $this->addModal( "forgetPwdForm", $config, []); ?>
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
                            <ul class="errors col-l-12">
                                  <?php if( isset( $success ) ): ?>
                                           <li>
                                                <div class="div-errors success col-l-12">
                                                    <p><strong> Success ! </strong><?php echo $success;?></p>
                                                </div>

                                            </li>
                                    <?php endif; ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>


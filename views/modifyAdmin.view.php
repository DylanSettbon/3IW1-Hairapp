<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-4">Modifier l'utilisateur</h1>
                            </div>
                            <?php
                             $this->addModal( "updateUserForm", $config, [], $options ); ?>
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
                    <?php if( isset( $errorsUnique ) ): ?>
                        
                        <?php foreach ( $errorsUnique as $errorU ): ?>
                            <li>
                                <div class="div-errors danger">
                                    <p><strong> Warning ! </strong><?php echo $errorU;?></p>
                                </div>

                            </li>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                </ul>

                    
                
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>

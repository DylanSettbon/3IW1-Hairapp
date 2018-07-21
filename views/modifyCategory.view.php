<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">
            
                    <div class="col-s-12 col-m-6 col-l-6 center">

                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="col-l-8 title"  style="padding: 0px;" >Modifier la categorie</h1>
                                <div class="col-l-2" style="text-align: right">
                                   <p><a href="<?php echo DIRNAME."admin/getCategoryAdmin"; ?>">Retour</a></p>
                                </div>
                                
                            </div>
                            <?php
                             $this->addModal( "updateCategoryForm", $config, [], $options ); ?>
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
                         <ul class="errors">
                            <?php if( isset( $errorsUnique ) ): ?>
                                <?php foreach ( $errorsUnique as $error ): ?>
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
            </div>
        </article>
    </main>
</body>


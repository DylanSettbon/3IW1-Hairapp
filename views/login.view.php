<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-s-12 col-m-6 col-l-8 center" id="background_connexion"> -->
                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-12">Se Connecter</h1>
                            </div>
                            <div class="row">

                                <?php $this->addModal("login", $config ); ?>

                                <ul class="errors col-l-12">
                                    <?php if( isset( $errors ) ): ?>
                                        <?php foreach ( $errors as $error ): ?>
                                            <li>
                                                <div class="div-errors danger col-l-12">
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
                            <a class="mdp" href="#">Mot de passe oublié?</a>
                            <hr>

                           <div class="row">

                               <div class="col-l-12"><p class="center">
                                       <span class="span"> Vous n'avez pas de compte ? </span>
                                       <a  class="mdp" href="<?php echo DIRNAME;?>signin/getSignin">Inscription</a>
                                   </p>
                               </div>

                           </div>



                        </div>

                        <!-- </div> -->
                    </div>
                </div>
        </article>
    </main>
</body>

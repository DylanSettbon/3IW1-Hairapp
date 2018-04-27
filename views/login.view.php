<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-s-12 col-m-6 col-l-8 center" id="background_connexion"> -->
                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-6">Se Connecter</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>login/getVerify">
                                <input type="email" name="email" class="mail input" placeholder="Adresse e-mail"   />
                                <input type="password" name="pwd" class="input" id="pwd" placeholder="Mot de passe"   />
                                <input type="submit" id="connecter" class="center input" value="Me connecter" />
                                <a class="mdp" href="#">Mot de passe oublié?</a>
                                <hr>
                                <p class="center"><span class="span"> Vous n'avez pas de compte ? </span><a  class="mdp" href="<?php echo DIRNAME;?>signin/getSignin">Inscription</a><p>
                            </form>
                        </div>

                        <!-- </div> -->
                    </div>
                </div>
        </article>
    </main>
</body>



<?php
    include "templates/footer.tpl.php";
?>

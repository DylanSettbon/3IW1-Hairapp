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
                            <form method="post" action="<?php echo DIRNAME;?>signin/validate">
                                <input class="input input_sign-in" type="text" name="nom" placeholder="Nom"   />
                                <input class="input input_sign-in" type="text" name="prenom" placeholder="Prenom"   />
                                <input class="input input_sign-in" type="email" name="email" placeholder="Adresse e-mail"   />
                                <input class="input input_sign-in" type="email" name="emailConfirm" placeholder="Confirmation de l'email">
                                <input class="input input_sign-in" type="password" name="pwd" placeholder="Mot de passe"   />
                                <input class="input input_sign-in" type="password" name="pwdConfirm" placeholder="Confirmation du mot de passe">
                                <input class="input input_sign-in" type="tel" name="tel" placeholder="Téléphone"   />
                                <input id="checkBox" type="checkbox" name="offers"><span>Je souhaite recevoir par e-mail des offres promotionnelles</span>

                                <input type="submit" class="input center" id="valider" value="Valider" />

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>


<?php
    include "templates/footer.tpl.php";
?>

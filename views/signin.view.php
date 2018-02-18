<?php
    include "templates/header.tpl.php";
?>

  <main class="background_login">
      
      <article>
          <div class="container">
              <div class="row">
                  
                  <div class="col-s-12 col-m-6 col-l-6 center">
                      <div class="form_register">
                          <h2 class="center"> S'inscrire </h2>
                          <form method="post" action="">
                              <select name="civilite" class="default_civilite select-sign-in">
                                  <option value="" selected disabled>Civilité</option>
                                  <option value="monsieur">Monsieur</option>
                                  <option value="madame">Madame</option>
                              </select>
                              <input class="input_sign-in" type="text" name="nom" placeholder="Nom complet"   />
                              <input class="input_sign-in" type="email" name="email" placeholder="Adresse e-mail"   />
                              <input class="input_sign-in" type="password" name="pwd" placeholder="Mot de passe"   />
                              <input class="input_sign-in" type="tel" name="tel" placeholder="Téléphone"   />
                              <input id="checkBox" type="checkbox"><span>Je souhaite recevoir par e-mail des offres promotionnelles</span>

                              <input type="submit" class="center" id="valider" value="Valider" />

                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </article>
  </main>

<?php
    include "templates/footer.tpl.php";
?>

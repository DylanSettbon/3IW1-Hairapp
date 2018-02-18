<?php
    include "templates/header.tpl.php";
?>

  <main class="background_login">
      
      <article>
          <div class="container">
              <div class="row">
                  <!-- <div class="col-s-12 col-m-6 col-l-8 center" id="background_connexion"> -->
                      <div class="col-s-12 col-m-6 col-l-6 center">
                          <div class="form_register">
                              <h2 class="center"> Me connecter </h2>
                              <form method="post" action="">
                                  <input type="email" name="email" class="mail" placeholder="Adresse e-mail"   />
                                  <input type="password" name="pwd" id="pwd" placeholder="Mot de passe"   />
                                  <input type="submit" id="connecter" class="center" value="Me connecter" />
                                  <a class="mdp" href="#">Mot de passe oublié?</a>
                                  <hr>
                                  <p class="center"><span class="span"> Vous n'avez pas de compte ? </span><a  class="mdp" href="signin">Inscription</a><p>
                              </form>
                          </div>

                  <!-- </div> -->
              </div>
          </div>
      </article>
  </main>



<?php
    include "templates/footer.tpl.php";
?>

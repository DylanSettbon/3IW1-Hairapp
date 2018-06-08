<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-12">Ajouter un utilisateur</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>admin/add">
                                <input class="input input_sign-in" type="text" name="nom" placeholder="Nom"   />
                                <input class="input input_sign-in" type="text" name="prenom" placeholder="Prenom"   />
                                <input class="input input_sign-in" type="email" name="email" placeholder="Adresse e-mail"   />
                               <?php echo "<label>Status</label>
                                <select name='status' class='input input_sign-in' >
                                ";
                                foreach($array as $key => $value)
                                        {
                                          echo"<option value=" . $key . ">". $value . "</option>";
                                        }
                                        echo"
                                </select> ";
                               ?>
                                
                                <input class="input input_sign-in" type="tel" name="tel" placeholder="Téléphone"   />

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

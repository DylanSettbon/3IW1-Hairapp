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
                            <form method="post" action="<?php echo DIRNAME;?>admin/modify" >
                            <?php
                             echo "
                                <label>Nom</label>
                                <input type='hidden' value=" .$u[0]->getId() ." name='id' />
                                <input class='input input_sign-in' type='text' name='lastname' value=" . $u[0]->getLastname() ."   />
                                <label>Prenom</label>
                                <input class='input input_sign-in' type='text' name='prenom' value=".  $u[0]->getFirstname() . "   />
                                <label>Email</label>
                                <input class='input input_sign-in' type='email' name='email' value=". $u[0]->getEmail() ."   />
                                <label>Status</label>
                                <select name='status' class='input input_sign-in' >
                                <option value=".$u[0]->getStatus().">".$array[$u[0]->getStatus()]."</option>
                                ";
                                foreach($array as $key => $value)
                                        {
                                          echo"<option value=" . $key . ">". $value . "</option>";
                                        }
                                        echo"
                                </select>
                                <label>Telephone</label>
                                <input class='input input_sign-in' type='tel' name='tel' value=". $u[0]->getTel() ."   />
                             "; ?>   

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

<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-10">Contactez-Nous</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>contact/validate" >
                            <?php
                             echo "
                                <label>Nom</label>
                                <input class='input input_sign-in' type='text' name='nom' />
                                <label>Email</label>
                                <input class='input input_sign-in' type='text' name='email' />
                                <label>Objet</label>
                                <input class='input input_sign-in' type='text' name='objet' />
                                <label>Message</label>
                                <textarea class='input input_sign-in' rows=5 cols=50 name='message'>
                                </textarea>
                                
                             "; ?>   

                                <input type="submit" class="input center" name="valider" id="valider" value="Valider" />

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

<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-4">Modifier la categorie</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>admin/modifyAdminCategory" >
                            <?php
                             echo "
                                <label>Nom</label>
                                <input type='hidden' value=" .$a[0]->getId() ." name='id' />
                                <input class='input input_sign-in' name='description' value=".$a[0]->getDescription()." />
                                
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

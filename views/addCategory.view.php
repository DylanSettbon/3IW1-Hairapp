<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-4">Ajouter la categorie</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>admin/addAdminCategory" >
                                <label>Nom</label>
                                <input class='input input_sign-in' type='text' name='description' />
                               
                     

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

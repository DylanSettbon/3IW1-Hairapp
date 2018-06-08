<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-4">Modifier l'article</h1>
                            </div>
                            <form method="post" action="<?php echo DIRNAME;?>admin/modifyAdminArticle" >
                            <?php
                             echo "
                                <label>Nom</label>
                                <input type='hidden' value=" .$a[0]->getId() ." name='id' />
                                <input class='input input_sign-in' type='text' name='name' value=" . $a[0]->getName() ."   />
                                <label>Image</label>
                                 <input class='input input_sign-in' type='text' name='image' "; 
                                 if ($a[0]->getImage() != null) {
                                    echo "value=" . $a[0]->getImage() ." ";
                                     } echo "  />
                                <label>Date</label>
                                <input class='input input_sign-in' type='date' name='dateparution' value=".  $a[0]->getDateParution() . "   />
                                <label>Description</label>
                                <textarea class='input input_sign-in' rows=4 cols=40 name='description'>".$a[0]->getDescription()."</textarea>
                                <select name='category' class='input input_sign-in' >
                                ";
                                
                                foreach($b as $category)
                                        {
                                            
                                          echo"<option value='" . $category->getId()."' 
                                          ";
                                          if($a[0]->getCategory()==$category->getId()){
                                            echo "selected";
                                          } echo">". $category->getDescription() . "</option>";
                                        }
                                        echo"
                                </select>
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

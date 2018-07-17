<?php


include "templates/sidebar.view.php";
?>
    <div class="content">
        <article class="arriere_plan">

            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des categories</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                    <tr>
                        
                        <th id="nom">Nom</th>
                        <th colspan="3">Modifier</th>
                        <th >Supprimer</th>
                        

                    </tr>
                    <?php   
                    
                            foreach ($u as $category):

                                
                                echo "
                                 <tr>
                                    <td> ".  $category->getDescription() . " 
                                    </td>
                                    <td colspan='3'><a href='/admin/modifyCategory/" . $category->getId() ."' class='buttonUserModify'>Modifier</a></td>
                                    <td><a href='/admin/deleteCategory/" . $category->getId() ."' class='buttonUserDelete'>Supprimer</a></td>
                                </tr>
                                ";
                            endforeach;
                    
                    ?>
                    
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="3">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                       
                    </nav>
                </table>
                
            </div>
        </article>
         <a href=" <?php echo DIRNAME;?>admin/addCategory"  class="buttonUserAdd">Ajouter une categorie</a>
    </div>

  </main>

<?php

include "templates/footer.tpl.php";
?>


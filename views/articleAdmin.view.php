
    <div>
        <article class="arriere_plan">

            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des articles</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                    <tr>
                        
                        <th >Nom Article</th>
                        <th >Date</th>
                        <th >Catégorie</th>
                        <th >Status</th> 
                        <th >Détail</th>
                        <th >Modifier</th>
                        <th >Supprimer</th>
                        
                        

                    </tr>
                    <?php   
                    
                            foreach ($a as $article) {
                                

                                
                                echo "
                                 <tr>
                                    <td> ".  $article->getName() . " 
                                    </td>
                                    <td> ".  $article->getDateParution() . " 
                                    </td>"; 
                                    foreach($b as $category){
                                        if($article->getCategory()==$category->getId()){
                                        echo"<td> ". $category->getDescription()." </td>";
                                    }
                                }echo"
                                    <td> ". $array[$article->getStatus()] ."</td>
                                    <td><a href='".DIRNAME."article/getArticle?id=".$article->getId()."' class='buttonUserModify'>Voir plus</a></td>
                                    <td><a href='modifyArticle?id=" . $article->getId() ."' class='buttonUserModify'>Modifier</a></td>
                                    <td><a href='deleteArticle?id=" . $article->getId() ."' class='buttonUserDelete'>Supprimer</a></td>
                                    ";
                                    if($article->getStatus()==0){echo"
                                    <td><a href='parutionArticle?id=" . $article->getId() ."' class='buttonUserModify'>Publier</a></td>
                                    ";}echo "
                                </tr>
                                ";
                            }
                    
                    ?>
                    
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="6">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                        <tr>
                            <td colspan="8"><a href=" <?php echo DIRNAME;?>admin/addArticle"  class="buttonUserAdd">Ajouter un article</a></td>
                        </tr>
                    </nav>
                </table>
                
            </div>
        </article>
    </div>

  </main>

<?php

include "templates/footer.tpl.php";
?>

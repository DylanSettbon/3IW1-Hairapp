<?php


include "templates/sidebar.view.php";
?>
    <div class="content">
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
                        <th >Publication</th>
                        
                        

                    </tr>
                    <?php  foreach ($a as $article): ?>
                                
    
                                 <tr>
                                    <td> <?php echo $article->getName(); ?> 
                                    </td>
                                    <td> <?php echo $article->getDateParution(); ?> 
                                    </td>

                                    <?php foreach($b as $category): ?>

                                        <?php if($article->getCategory()==$category->getId()): ?>
                                        <td><?php echo $category->getDescription();?> </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                    <td> <?php echo $array[$article->getStatus()] ?></td>
                                    <td><a href="<?php echo DIRNAME; ?>article/getArticle/<?php echo $article->getId(); ?>" class='buttonUserModify'>Voir plus</a></td>
                                    <td><a href="/admin/modifyArticle/<?php echo $article->getId(); ?>" class='buttonUserModify'>Modifier</a></td>
                                    <td><a href="/admin/deleteArticle/<?php echo $article->getId(); ?>" class='buttonUserDelete'>Supprimer</a></td>
                                    <?php if($article->getStatus()==0):?>
                                    <td><a href="/admin/parutionArticle/<?php echo $article->getId(); ?>" class='buttonUserModify'>Activer</a></td>
                                    <?php endif; ?>
                                    <?php if($article->getStatus()==1): ?>
                                    <td><a href="/admin/parutionArticle/<?php echo $article->getId() ; ?>" class='buttonUserDelete'>Désactiver</a></td>
                                <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                    
                    
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="6">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                        
                    </nav>
                </table>
                
            </div>
        </article>
         <a href=" <?php echo DIRNAME;?>admin/addArticle"  class="buttonUserAdd">Ajouter un article</a>
    </div>

  </main>


<?php

include "templates/footer.tpl.php";
?>

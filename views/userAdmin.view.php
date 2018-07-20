
    <div>
        <article class="arriere_plan">
            <input id="search" class="input col-l-2" placeholder="Recherchez...">
            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des utilisateurs</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                    <tr>
                        
                        <th id="nom">Nom Complet</th>
                        <th id="email">Email</th>
                        <th id="tel">Téléphone</th>
                        <th id="status">Status</th>
                        <th >Modifier</th>
                        <th >Supprimer</th>
                        <th >Supprimer en base</th>

                    </tr>

                    <tbody id="searchList">

                    <?php foreach ($u as $user) : ?>
                                 <tr>
                                    <td> <?php echo $user->getFirstname().' '.$user->getLastname(); ?>
                                    </td>
                                    <td><?php echo $user->getEmail(); ?></td>
                                    <td><?php echo $user->getTel(); ?></td>
                                    <td> <?php echo $arrayStatus[$user->getStatus()]; ?></td>
                                    <td><a href="<?php echo DIRNAME . "admin/modifyUser/". $user->getId(); ?>" class='buttonUserModify'>Modifier</a></td>
                                    <td><a href="<?php echo DIRNAME . "admin/deleteUser/".$user->getId(); ?>" class='buttonUserDelete'>Supprimer</a></td>
                                    <td><a href="<?php echo DIRNAME . "admin/delete/".$user->getId(); ?>" class='buttonUserDeleteBd'>Droit a l'oubli</a></td>
                                </tr>

                                
                    <?php endforeach; ?>
                    </tbody>

                    
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="5">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                       
                    </nav>
                </table>
                
            </div>
        </article>
        <a href=" <?php echo DIRNAME;?>admin/addUser"  class="buttonUserAdd">Ajouter un utilisateur</a>
    </div>

  </main>
     <script type="text/javascript" src="<?php echo DIRNAME . "public/js/searchBar.js" ; ?> "></script>


<?php

include "templates/footer.tpl.php";
?>



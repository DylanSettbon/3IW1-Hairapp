<?php
include "templates/sidebar.view.php";
?>

    <div class="content">
        <article class="arriere_plan">

            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des Pages</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                        <th id="nom">Nom Complet</th>
                        <th id="contenu">Contenu</th>
                        <th id="status">Status</th>
                        <th id="date">Date</th>
                        <th >Accepter</th>
                        <th >Decliner</th>
                        <th >Supprimer</th>

                    </tr>
                          <?php foreach($comments as $comment):?>
                            <?php foreach($u as $user):?>
                                <?php if($user["id"]==$comment["id_user"]):?>

                                 <tr>
                                    <td><?php echo $user["firstname"]." ".$user["lastname"] ?>
                                    </td>
                                    <td><?php echo $comment["content"];?></td>
                                    <td><?php echo $comment["statut"];?></td>
                                    <td><?php echo $comment["date"];?></td>
                                    <?php if($comment["statut"]==1):?>
                                        <td><a href='acceptComment?id=<?php echo $comment["id"];?>' class='buttonUserModify'>Accepter</a></td>
                                        <td><a href='declineComment?id=<?php echo $comment["id"];?>' class='buttonUserDelete'>Decliner</a></td>
                                    <?php elseif($comment["statut"]==0):?>
                                        <td><a href='acceptComment?id=<?php echo $comment["id"];?>' class='buttonUserModify'>Accepter</a></td>
                                        <td></td>
                                    <?php elseif($comment["statut"]==2):?>
                                        <td></td>
                                        <td><a href='declineComment?id=<?php echo $comment["id"];?>' class='buttonUserDelete'>Decliner</a></td>
                                    <?php endif;?>
                                    <td><a href='deleteComment?id=<?php echo $comment["id"];?>' class='buttonUserDelete'>Supprimer</a></td>
                                </tr>

                              <?php endif;?>
                            <?php endforeach;?>
                          <?php endforeach;?>

                </table>

            </div>
        </article>
    </div>

  </main>


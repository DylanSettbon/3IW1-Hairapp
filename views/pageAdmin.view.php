<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 24/04/2018
 * Time: 16:29
 */

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
                    <tr>
                        <th id="nom">Titre</th>
                        <th id="email">Url</th>
                        <th id="tel">Navbar</th>
                        <th> Activée </th>
                        <th> Modifier</th>
                        <th> Supprimer</th>

                    </tr>

                    <?php


                    foreach ( $this->data['pages'] as $page ) {
                        echo "<tr>
                                
                                <td> " . $page->getTitle() . " </td>
                                <td> " . $page->getUrl() . " </td>";
                        if ( $page->getisNavbar() ) {
                            echo "<td> Oui </td>";

                        }
                        else{
                            echo "<td> Non </td>";
                        }

                        if ( $page->getActive() ) {
                            echo "<td> Oui </td>";

                        }
                        else{
                            echo "<td> Non </td>";
                        }

                          echo "

                        <td><a href='modifyPages?id=". $page->getId() ."' class='buttonUserModify'>Modifier</a></td>";

                        if( $page->getActive() == 1 ){
                            echo "<td><a href='deletePages?id=". $page->getId() ."' class='buttonUserDelete'>Supprimer</a></td>";
                        }
                        else{
                            echo "<td><a href='activatePages?id=". $page->getId() ."' class='buttonUserDelete'>Activer</a></td>";
                        }

                        echo "</tr>";
                    }
                    ?>

                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="4">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
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


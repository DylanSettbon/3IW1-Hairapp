<?php
/**
 * Created by PhpStorm.
 * User: antoine
<<<<<<< HEAD
 * Date: 04/02/2018
 * Time: 11:27
 */
include "templates/sidebar.view.php";
?>
    <main class='container'>
        <div class="content">
            <div class="col-s-12 col-l-12 col-m-9 packageContent-admin">

                <h1>Personnaliser la carte du salon</h1>
                <div class="row">
                    <input method="post" class="btnCreatePackage col-l-3" type="button" onclick ="testForm('package_content','3','div','contentManagerTest')" value="Ajouter une catégorie">
                </div>

                <div id="package_content">
                    <?php

                    $category = new Category();
                    $categories = $category->getAllBy();

                    foreach($categories as $category){
                        echo '<table id="packageCategory'.$category->getId().'" class="PackageManagerTab col-l-6">
                                  <caption class="packageCategory-title" id="'.$category->getId().'">' . $category->getDescription(). '</caption>
                                    <tr>
                                        <th id="desc">Description</th>
                                        <th id="price">Prix</th>
                                        <th id="modify">Modifier</th>
                                        <th id="delete">Supprimer</a></th>';

                        $package = new Package();
                        $packages = $package->getAllBy(['id_Category' => $category->getId()],null,2);

                        foreach ($packages as $package) {
                            echo '<tr>
                                                  <td style="width:50%">' . $package->getDescription() . '</td> 
                                                  <td>' . $package->getPrice() . '</td>
                                                  <td><input type="button" class="buttonUpdatePackage" id = "' . $package->getId() . '"></td> 
                                                  <td style="width:5%"><input id="checkBox" type="checkbox"></td>
                                              </tr>
                                              ';
                        }

                        echo'
                                   <tr>
                                   <td colspan="4"><input class="createPackage" id ="'.$category->getId().'" type="button" action="savePackage" onclick ="addRow(document.getElementById(\'packageCategory'.$category->getId().'\'))" value="Creer un forfait"></td>
                                   </tr>
                                  </table>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../public/js/packageAdmin.js"></script>

    </main>
<?php

include "templates/footer.tpl.php";
?>
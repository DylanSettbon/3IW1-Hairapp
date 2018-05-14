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

            <h1 class="packageAdmin-title">Personnaliser la carte du salon</h1>
            <div class="row">
                <input method="post" class="btnCreateCategory col-l-3" type="button" onclick ="createCategoryPackageForm_show()" value="Ajouter une catégorie">
            </div>

            <div id="package_content">
                <?php
                foreach($categories as $category){
                    $jCategory = ['id' => $category->getId(),
                                  'description' => $category->getDescription(),];

                    echo '<table id="packageCategory" class="PackageTab col-l-6">
                                  <caption class="packageCategory-title">
								  <h5>' . $category->getDescription(). '</h5>
								  <input class="btnDeleteCategory" type="submit" value="Supprimer" name="deleteCategory" style="float:right;">
								  <input class="btnUpdateCategory" type="submit" value="Modifier" name="updateCategory" onclick="updateCategoryPackageForm_show([\'' .$category->getId().'\',\''.$category->getDescription().'\'])" style="float:right";>
								  </caption>
                                    <tr>
                                        <th id="desc">Description</th>
                                        <th id="price">Prix</th>
                                        <th id="modify">Modifier</th>
                                        <th id="delete">Supprimer</a></th>';

                    $package = new Package();
                    $packages = $package->getAllBy(['id_Category' => $category->getId()],null,2);
                    if(empty($packages)){
                        echo'
                                   <tr>
                                   <td colspan="4"><input class="createPackage" type="button" onclick ="createPackageForm_show([\'' .$category->getId().'\',\''.$category->getDescription().'\'])" value="Creer un forfait"></td>
                                   </tr>
                                  </table>';
                    } else{
                        foreach ($packages as $package) {
                            echo '<tr>
													  <td style="width:50%">' . $package->getDescription() . '</td> 
													  <td>' . $package->getPrice() . '</td>
													  <td><input class="updatePackage" type="submit" value="Modifier" name="updatePackage" onclick="updatePackageForm_show([\'' .$category->getId().'\',\''.$category->getDescription().'\'],[\'' .$package->getId().'\',\''.$package->getDescription().'\',\''.$package->getPrice().'\'])"></td>
													  <td style="width:5%"><input id="test" type="submit"></td>
												  </tr>
												  ';
                        }


                        echo'
									   <tr>
									   <td colspan="3"><input class="createPackage" type="button" onclick ="createPackageForm_show([\''.$category->getId().'\',\''.$category->getDescription().'\'])" value="Creer un forfait"></td>
									   <td><input class="deletePackage" type="button" value="Confirmer"></td>
									   </tr>
									  </table>';
                    }
                }?>
            </div>
        </div>

        <!-- Formulaire de création de catégorie -->
        <div id="categoryPackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <form class="formPackage createCategoryPackage" action=saveCategoryPackage method="post">
                    <h2>Ajouter une catégorie</h2>
                    <hr>
                    <input id="categoryDesc" type="text" name="categoryDesc" placeholder="Entrez le nom de la categorie">
                    <input class="btnFormCategory" type="submit" value="Valider" name="categoryPackageSubmit">
                    <input class="btnFormCategory" type="submit" value="Annuler" name="categoryPackageSubmit">
                </form>
            </div>
        </div>

        <!-- Formulaire de modification de catégorie -->
        <div id="updateCategoryPackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <form class="formPackage updateCategoryPackage" action=saveCategoryPackage method="post">
                    <h2>Modifier le nom de la catégorie</h2>
                    <hr>
                    <input id="categoryIdUpdate" type="hidden" name="categoryId">
                    <input id="categoryDescUpdate" type="text" name="categoryDesc">
                    <input class="btnFormCategory" type="submit" value="Valider" name="categoryPackageSubmit">
                    <input class="btnFormCategory" type="submit" value="Annuler" name="categoryPackageSubmit">
                </form>
            </div>
        </div>

        <!-- Formulaire de création de forfaits -->
        <div id="packageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <form class="formPackage createCategoryPackage" action=savePackage method="post">
                    <h2 class="categoryTitleForm">Ajouter un forfait à </h2>
                    <hr>
                    <input id="pCategoryId" type="hidden" name="categoryId">
                    <input id="packageDesc" type="text" name="description" placeholder="Entrez une description">
                    <input id="packagePrice" type="text" name="price" placeholder="Entrez un prix">
                    <input class="btnFormCategory" type="submit" value="Valider" name="packageSubmit">
                    <input class="btnFormCategory" type="submit" value="Cancel" name="packageSubmit" onclick=div_hide()>
                </form>
            </div>
        </div>

        <!-- Formulaire de modification de forfaits -->
        <div id="updatePackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <form class="formPackage createCategoryPackage" action=savePackage method="post">
                    <h2 class="categoryTitleForm">Modifier un forfait</h2>
                    <hr>
                    <input id="packageId" type="hidden" name="packageId">
                    <input id="pCategoryIdUpdate" type="hidden" name="categoryId">
                    <input id="packageDescUpdate" type="text" name="description">
                    <input id="packagePriceUpdate" type="text" name="price">
                    <input class="btnFormCategory" type="submit" value="Valider" name="packageSubmit">
                    <input class="btnFormCategory" type="submit" value="Annuler" name="packageSubmit" onclick=div_hide()>
                </form>
            </div>
        </div>



    </div>
    <?php include "templates/footer.tpl.php";  ?>
    <script type="text/javascript" src="../public/js/packageAdmin.js"></script>

    </main>
<?php

include "templates/footer.tpl.php";
?>
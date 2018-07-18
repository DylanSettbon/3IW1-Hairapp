<?php
/**
 * Created by PhpStorm.
 * User: antoine

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
                <a href='#' method="post" class="buttonUserAdd" type="button" onclick ="createCategoryPackageForm_show()" style="margin-bottom: 0px;">Ajouter une catégorie</a>
            </div>
            <div class="row">
                <input id="search" class="input col-l-2" placeholder="Recherchez...">
            </div>
            <?php if (isset($errors)): ?>
                <ul class="errors">
                            <?php foreach ($errors as $error):?>
                            <li>
                                <div class="div-errors danger">
                                    <p><?php echo $error;?></p>
                                </div>
                            </li>
                            <?php endforeach;?>
                </ul>
            <?php endif; ?>

            <div id="package_content">
                <?php if(empty($categories)):?>
                    <ul class="errors">
                            <li>
                                <div class="div-errors information">
                                    <p><strong>Commencer à creer la carte du salon !</strong>
                                        <br><br>Ajouter une categorie ainsi que ces forfaits associès
                                        <br><br>Ils apparaitront automatiquement sur la carte du salon une fois qu'une catégorie contiendra au moins un forfait</p>
                                </div>
                            </li>
                    </ul>
                <?php endif; ?>
                <?php
                foreach($categories as $key=>$category):?>
                    <?php if($key%2 == 0):?>
                        <div class="row">
                    <?php endif; ?>
                    <table id="packageCategory" class="PackageTab">
                        <caption class="packageCategory-title">
                                <h5 class="categoryTitle"><?php echo Security::setHtmlEntitiesForData($category->getDescription()); ?></h5>
                                <span style="float:left; margin-left:2%"><?php echo Security::setHtmlEntitiesForData($category->getDisplayOrder());?></span>
                            <a href="/admin/deleteCategoryPackage/<?php echo $category->getId() ?>" name="categoryPackageSubmit" class="buttonUserDelete"style="float:right;">Supprimer</a>
                            <a href="#" class="buttonUser" type="submit" name="updateCategory" onclick="updateCategoryPackageForm_show(['<?php echo $category->getId(). '\',\'' . $category->getDescription() . '\',\'' . $category->getDisplayOrder()?>'])" style="float:right";>Modifier</a>

                        </caption>
                                    <tr>
                                        <th id="tablePackageDesc">Description</th>
                                        <th id="tablePackagePrice">Prix</th>
                                        <th id="tablePackageDuration">Durée</th>
                                        <th id="tablePackageModify">Modifier</th>
                                        <th id="tablePackageDelete">Supprimer</a></th>

                    <?php if(empty($packages[$category->getId()])):?>
                            <tr>
                                <td colspan="5"><input class="createPackage" type="button" onclick ="createPackageForm_show(['<?php echo $category->getId(). '\',\'' . $category->getDescription()?>'])" value="Creer un forfait"></td>
                            </tr>
                        </table>
                    <?php else: ?>
                    <tbody id="searchList">
                        <?php foreach ($packages[$category->getId()] as $package): ?>

                            <tr class="tdPackage" id="<?php echo $package->getId();?>">
                                <td style="width:50%"><?php echo Security::setHtmlEntitiesForData($package->getDescription()) ?></td>
                                <td><?php echo Security::setHtmlEntitiesForData($package->getPrice()) ?></td>
                                <td><?php echo Security::setHtmlEntitiesForData($package->getDuration()) ?></td>
                                <td><a href="#" class="buttonUser" type="submit" name="updatePackage" onclick="updatePackageForm_show(['<?php echo $category->getId() .'\',\''. $category->getDescription() ?>'],['<?php echo $package->getId().'\',\''.$package->getDescription().'\',\''.$package->getPrice() .'\',\''. $package->getDuration()?>'])">Modifier</a></td>
                                <td style="width:5%"><input id="cbDeletePackage" value="<?php echo $package->getId() ?>" class="cbDeletePackage<?php echo $category->getDescription()?>" type="checkbox" value="Supprimer" name="deletePackage"</td>
                            </tr>

                        <?php endforeach; ?>

									   <tr>
									   <td colspan="4"><a href="#" class="createPackage" type="button" onclick ="createPackageForm_show(['<?php echo $category->getId().'\',\''.$category->getDescription() ?>'])">Creer un forfait</a></td>
									   <td><a href="#" class="buttonUserDelete" id='deletePackage' onclick= "deletePackage('<?php echo $category->getDescription(); ?>')" type="button" value="Supprimer">Supprimer</a></td>
									   </tr>
                    </tbody>
									  </table>
                    <?php endif; ?>
                    <?php if($key%2 != 0):?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>


        <div id="categoryPackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <?php $this->addModal("formPackageAdmin", $configAddCategory, []); ?>
            </div>
        </div>


        <div id="updateCategoryPackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <?php $this->addModal("formPackageAdmin", $configUpdateCategory, []); ?>
            </div>
        </div>


        <div id="packageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <?php $this->addModal("formPackageAdmin", $configAddPackage, []); ?>
            </div>
        </div>

        <div id="updatePackageForm" style="overflow:hidden;">
            <div id="popUpForm">
                <?php $this->addModal("formPackageAdmin", $configUpdatePackage, []); ?>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="/public/js/searchBar.js"></script>
    <script type="text/javascript" src="/public/js/packageAdmin.js"></script>


    </main>

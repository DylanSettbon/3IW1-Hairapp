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
                <a href='#' method="post" class="buttonUserAdd" type="button" onclick ="createCategoryPackageForm_show()">Ajouter une catégorie</a>
            </div>

            <div id="package_content">
                <?php
                foreach($categories as $key=>$category):?>
                    <?php if($key%2 == 0):?>
                        <div class="row">
                    <?php endif; ?>
                    <table id="packageCategory" class="PackageTab">
                        <caption class="packageCategory-title">
                                <h5 class="categoryTitle"><?php echo $category->getDescription(); ?></h5>
                                <span style="float:left; margin-left:2%">1</span>
                            <a href="/admin/deleteCategoryPackage/<?php echo $category->getId() ?>" name="categoryPackageSubmit" class="buttonUserDelete"style="float:right;">Supprimer</a>
                            <a href="#" class="buttonUser" type="submit" name="updateCategory" onclick="updateCategoryPackageForm_show(['<?php echo $category->getId(). '\',\'' . $category->getDescription()?>'])" style="float:right";>Modifier</a>

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
                        <?php foreach ($packages[$category->getId()] as $package): ?>
                            <tr class="tdPackage" id="<?php echo $package->getId();?>">
                                <td style="width:50%"><?php echo $package->getDescription() ?></td>
                                <td><?php echo $package->getPrice() ?></td>
                                <td><?php echo $package->getDuration() ?></td>
                                <td><a href="#" class="buttonUser" type="submit" name="updatePackage" onclick="updatePackageForm_show(['<?php echo $category->getId() .'\',\''. $category->getDescription() ?>'],['<?php echo $package->getId().'\',\''.$package->getDescription().'\',\''.$package->getPrice() .'\',\''. $package->getDuration()?>'])">Modifier</a></td>
                                <td style="width:5%"><input id="cbDeletePackage" value="<?php echo $package->getId() ?>" class="cbDeletePackage<?php echo $category->getDescription()?>" type="checkbox" value="Supprimer" name="deletePackage"</td>
                            </tr>
                        <?php endforeach; ?>

									   <tr>
									   <td colspan="4"><a href="#" class="createPackage" type="button" onclick ="createPackageForm_show(['<?php echo $category->getId().'\',\''.$category->getDescription() ?>'])">Creer un forfait</a></td>
									   <td><a href="#" class="buttonUserDelete" id='deletePackage' onclick= "deletePackage('<?php echo $category->getDescription(); ?>')" type="button" value="Supprimer">Supprimer</a></td>
									   </tr>
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
    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script type="text/javascript" src="/public/js/packageAdmin.js"></script>


    </main>

<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:11
 */

class PackageController{

    public function getPackage(){

        $v = new Views( "package", "header" );
        $category = new Category();
        $categories = $category->getAllBy(['id_CategoryType' => '3','status' => '1'],null,3);
        $categories = Category::getCategoriesWithPackage($categories);

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $v->assign("categories", $categories);
        $v->assign("packages",$packages);
        $v->assign("current", 'packages');
    }
}
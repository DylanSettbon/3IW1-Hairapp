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
        $categories = $category->getAllBy(['id_CategoryType' => '3'],null,2);
        $v->assign("categories", $categories);
        $v->assign("current", 'packages');
    }
}
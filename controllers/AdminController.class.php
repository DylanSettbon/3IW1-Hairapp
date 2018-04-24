<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:10
 */

class AdminController{


    public function getAdmin(){
        $v = new Views( "admin", "admin_header" );
    }

    public function getUserAdmin(){
        $v = new Views( "userAdmin", "admin_header" );
    }

    public function getContentAdmin(){
        $v = new Views( 'contentAdmin', "admin_header" );
    }

    public function modifyUser(){

    }

    public function deleteUser(){

    }

    public function addUser(){

    }
}
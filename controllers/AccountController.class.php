<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:10
 */

class AccountController{

    public function getAccount(){
        $v = new Views( "admin", "admin_header" );
        $v->assign("current", 'dashboard');
    }
}
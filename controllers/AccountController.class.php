<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:10
 */

class AccountController{

    public function getAccount(){

        $user = new User();
        $form = $user->AccountForm();

        $account = $user->populate( ['email' => $_SESSION['email'] ] );

        $v = new Views( "account", "header" );
        $v->assign("config",$form);
        $v->assign("current", 'account');

        $v->assign( "account", $account );


    }
}
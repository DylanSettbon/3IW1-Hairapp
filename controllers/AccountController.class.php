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
        $infos = array(
            "email"=> $account->getEmail(),
            "nom" => $account->getFirstname(),
            "prenom" => $account->getLastname(),
            "pwd" => $account->getPwd(),
            "tel" => $account->getTel(),
            "offers" => $account->getReceivePromOffer()
        );

        $v->assign( "account", $infos );

        $v->assign("config",$form);
        $v->assign("current", 'account');
    }

    public function saveAccount( $params ){


        $user = new User();
        $form = $user->AccountForm();

        $errors = Validator::validate( $form, $params['POST'] );

        $v = new Views( "account", "header" );
        $v->assign( "current", "account" );
        $v->assign( "account", $_POST );
        $v->assign("config",$form);
        $v->assign("errors",$errors);


    }
}
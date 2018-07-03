<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 26/04/2018
 * Time: 23:08
 */

class Page{


    public function getPage( $params ){

        $v = new Views( "page", "header" );
        $v->assign("data", $params );
        $v->assign("current", $params['URL']);
    }
}
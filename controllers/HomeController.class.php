<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class HomeController {


    public function getHome(){


        $v = new Views();
        $v->assign("current", 'home');
    }
}
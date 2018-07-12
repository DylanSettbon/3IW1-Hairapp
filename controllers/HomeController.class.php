<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class HomeController {


    public function getHome(){

    	$article = new Article();
    	$a= $article->getAllBy(["status" => "1"] , ["id,name, minidescription,dateparution"], 2,'',"ORDER BY dateparution DESC");
    	$i=0;
        $v = new Views();
        $v->assign("articles", $a);
        $v->assign("i", $i);
        $v->assign("current", 'home');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/05/2018
 * Time: 10:55
 */

class PlanningController{

    public function getPlanning(){

        $v = new Views( "planning", "header" );

        $v->assign("current", 'planning');

    }
}
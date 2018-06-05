<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/05/2018
 * Time: 10:55
 */

class PlanningController{

    public function getPlanning(){

        /*
         *
         * une fois la prise de rdv faite,
         * Ajouter la récupération des rdvs
         *
         */

        $week = self::getWeek();

        $v = new Views( "planning", "header" );
        $v->assign("current", 'Planning.class');

        $v->assign("week", $week );


    }

    public static function getWeek(){
        $week = [];

        for ( $i = 0; $i < 7; $i++ ){

            $today =  mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y") );
            $day = date('D', $today);

            if( $day != 'Sun' && $day != 'Mon' ){
                switch ( $day ){
                    case 'Fri': $day .= "day"; break;
                    case 'Tue': $day .= "sday"; break;
                    case 'Wed': $day .= "nesday"; break;
                    case 'Thu': $day .= "rsday"; break;
                    case 'Sat': $day .= "urday"; break;
                }
                $week[$day] = date("Y-m-d", $today);
            }

        }

        return $week;
    }
}
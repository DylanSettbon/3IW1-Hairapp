<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/05/2018
 * Time: 10:55
 */

class PlanningController{


    public function getPlanning($params){

        /*
         *
         * une fois la prise de rdv faite,
         * Ajouter la récupération des rdvs
         *
         */

        $week = self::getWeek();
        $extremums = self::getExtemum();

        $planning = new Appointment();
        $user = new User();

        $haidressers = $user->getAllBy( ["status" => 2] , null, 2);

        $between = [
            //"dateAppointment >= :min AND dateAppointment <= :max ",
            "min" => $extremums[0],
            'max' => $extremums[4],
        ];

        $inner = array(
            'inner_table' => ['user u'],
            'inner_column' => ['id_user'],
            'inner_ref_to' => ['u.id']
        );


        $appointments = $planning->getAllBy( $between,
            ['dateAppointment', 'hourAppointment', 'id_user', 'id_Hairdresser', 'id_Package', 'u.firstname' , 'u.lastname'], 5, $inner);

        if( isset( $params['GET']["h"] ) ){
            if( $params['GET']['h'] == 'admin' ){
                $v = new Views( "planning", "admin_header" );
            }

        }
        else{
            $v = new Views( "planning", "header" );
        }



        if( preg_match( '#[0-9]{1,2}[:][0]{1,2}#', OPENING_HOUR ) ){

                $opening = (int)str_replace( ':00', '', OPENING_HOUR);

        }
        elseif ( preg_match( '#[0-9]{1,2}[:][30]{1}#', OPENING_HOUR )  ){
            $opening = (float)str_replace( ':30', '.5', OPENING_HOUR);
        }

        if( preg_match( '#[0-9]{1,2}[:][0]{1,2}#', CLOSING_HOUR ) ){

            $closing = (int)str_replace( ':00', '', CLOSING_HOUR);

        }
        elseif ( preg_match( '#[0-9]{1,2}[:][30]{1}#', CLOSING_HOUR )  ){
            $closing = (float)str_replace( ':30', '.5', CLOSING_HOUR);
        }


        $v->assign("opening", $opening );
        $v->assign("closing", $closing );

        $v->assign("hairdressers", $haidressers );
        $v->assign("current", 'planning');
        $v->assign("appointments", $appointments );
        $v->assign("week", $week );


    }

    public static function getWeek(){
      // ==================== Récupération de la semaine dynamiquement pour le planning =======================

        $week = [];

        for ( $i = 0; $i < 7; $i++ ){

            $today =  mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y") );
            $day = date('l', $today);

            if( $day != 'Sunday' && $day != 'Monday' ){
                switch ( $day ){
                    case 'Friday': $day = "Vendredi"; break;
                    case 'Tuesday': $day = "Mardi"; break;
                    case 'Wednesday': $day = "Mercredi"; break;
                    case 'Thursday': $day = "Jeudi"; break;
                    case 'Saturday': $day = "Samedi"; break;
                }


                $date = date( "d F Y", $today );
                //$date = date( "d F Y", $today );
                $day = $day . " " . self::changeMonth( $date );
                $week[$day] = date("Y-m-d", $today);
            }

        }

        return $week;
    }

    public static function getExtemum(){
        $week = [];

        $k = 0;
        for ( $i = 0; $i < 7; $i++ ){

            $today =  mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y") );
            $day = date('D', $today);

            if( $day != 'Sun' && $day != 'Mon' ){
                $week[$k] = date("Y-m-d", $today);
                $k++;
            }

        }

        return $week;
    }

    public static  function changeMonth( $date ){
        $month = date( "F", strtotime($date) );

        switch ( $month ){
            case 'January' : $res = str_replace( 'January', 'Janvier', $date ); break;
            case 'February': $res = str_replace( 'February', 'Février', $date ); break;
            case 'March': $res = str_replace( 'March', 'Mars', $date ); break;
            case 'April': $res = str_replace( 'April', 'Avril', $date ); break;
            case 'May': $res = str_replace( 'May', 'Mai', $date ); break;
            case 'June': $res = str_replace( 'June', 'Juin', $date ); break;
            case 'July': $res = str_replace( 'July', 'Juillet', $date ); break;
            case 'August': $res = str_replace( 'August', 'Août', $date ); break;
            case 'September': $res = str_replace( 'September', 'Septembre', $date ); break;
            case 'October': $res = str_replace( 'October', 'Octobre', $date ); break;
            case 'November': $res = str_replace( 'November', 'Novembre', $date ); break;
            case 'December': $res = str_replace( 'December', 'Décembre', $date ); break;
        }

        return $res;
    }
}

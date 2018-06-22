<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:20
 */

class Hairdresser extends User  {
            /*Recoit:
         * La durée du forfait
         * La journée concerné
         * l'id du coiffeur (0 si tous les coiffeur)
         */

            /*
             * Etape 1 :
             * Appeler une fonction getPlage qui prend en paramètres : durée du forfait,idCoiffeur et la date et retourne un tableau associatif des heures avec la durée demandé sous la forme heure => minute:
             * exemple : { "15h" => "45" }
             * Mettre la priorité sur les écart se rapprochant le plus de la durée
             * retourner un tableau des clés (heure)
             */
    public function __construct()
    {
        parent::__construct();
        parent::setStatus(2);
    }

    public function getTimeRangeAvailable($idPackage,$day){
        //Si resultat nul: renvoyer toutes les horaires pour le package
        $appointment= new Appointment();
        $appointments = $appointment->getAllBy(['dateAppointment' => $day],['hourAppointment'],3);
        $hours = [];
        foreach ($appointments as $appointment){
            $hours[] = $appointment->getHourAppointment();
        }
        //Creer un tableau des rendez-vous de la journée
        $timeRange = $appointment->getAvailableTimeBetweenAppointment($hours);

        $package = new Package();
        $duration = $package->getAllBy(['id' => $idPackage],['duration'],3)[0]->getDuration();
        echo $duration;
    }
}
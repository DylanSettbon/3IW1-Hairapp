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

    public function getTimeRangeAvailable($appointments,$duration){
        //Si resultat nul: renvoyer toutes les horaires pour le package
        $appointmentHours = [];
        $availableHours = [];
        $package = new Package();

        foreach ($appointments as $appointment){
            $appointmentDuration = $package->getAllBy(['id' => $appointment->getIdPackage()],['duration'],3)[0]->getDuration();
            $endAppointment = date('H:i:s',strtotime('+ '.$appointmentDuration.' minutes',strtotime($appointment->getHourAppointment())));
            $appointmentHours[] = ['start' => $appointment->getHourAppointment(),'end' => $endAppointment];
        }

        //Creer un tableau des rendez-vous de la journée
        $timesRange = $appointment->getAvailableTimeBetweenAppointment($appointmentHours);

        //Pour chaque rendez-vous, récupere toutes les heures disponible entre les deux rendez-vous
        foreach ($timesRange as $hour=>$availableTime){
            if($availableTime > $duration){
                for ($i=0;$i<=$availableTime;$i+=$duration){
                    if($availableTime - $i > $duration) {
                        $availableHours[] = date("H:i", strtotime('+' . $i . ' minutes', strtotime($hour)));
                    }
                }
            }
        }
        return $availableHours;
    }



}
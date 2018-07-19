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

        $timeOut = DURATION > $duration ? $duration : DURATION;
        foreach ($timesRange as $hour=>$availableTime){
            $cpt = $availableTime;
            $add = 0;
            if ($availableTime > $duration) {
                do {
                    $cpt = $cpt - $timeOut;
                    $availableHours[] = date("H:i", strtotime('+' . $add . ' minutes', strtotime($hour)));
                    $add += $timeOut;
                } while ($cpt > $duration);
            }
        }
        /*
        //Pour chaque rendez-vous, récupere toutes les heures disponible entre les deux rendez-vous
        foreach ($timesRange as $hour=>$availableTime){
            if($availableTime > $duration){
                for ($i=0;$i<=$availableTime;$i+=$duration){
                    if($availableTime - $i > $duration) {
                        $availableHours[] = date("H:i", strtotime('+' . $i . ' minutes', strtotime($hour)));
                    }
                }
            }
        }*/
        return $availableHours;
    }

    public function getHairdresserAvailableForSelectedHour($hour,$date,$duration){
        $appointment = new Appointment();
        $appointments = $appointment->getAllBy(['dateAppointment' => $date,'planned'=> 1],null,3);
        $hairdressersId = $this->getAllBy(['status' => '2'],['id'],3);
        $associativeHairdresserAndAppointment = $appointment->getAssociativeHaidresserAppointmentPackage($appointments);
        if($this->checkIfTheyAreFreeHairdresser($appointments,$hairdressersId)){
            $freeHairdresser = [];
            foreach ($hairdressersId as $id){
                $availableHairdresser = array_key_exists($id->getId(),$associativeHairdresserAndAppointment) ? false : true;
                if($availableHairdresser){
                    $freeHairdresser[] = $id->getId();
                }
            }
            return $freeHairdresser[array_rand($freeHairdresser)];
        }
        else{
            foreach($associativeHairdresserAndAppointment as $idHairdresser =>$hairdresserAppointments){
                foreach($this->getTimeRangeAvailable($hairdresserAppointments,$duration) as $timesRange){
                    if($timesRange == $hour){
                        return $idHairdresser;
                    }
                }
            }
        }
    }

    public function checkIfTheyAreFreeHairdresser($appointments, $hairdressers){
        $appointment = new Appointment();
        $associativeHairdresserAndAppointment = $appointment->getAssociativeHaidresserAppointmentPackage($appointments);
        foreach ($hairdressers as $id){
            $availableHairdresser = array_key_exists($id->getId(),$associativeHairdresserAndAppointment) ? false : true;
            if($availableHairdresser){
                return true;
            }
        }
        return false;
    }
}
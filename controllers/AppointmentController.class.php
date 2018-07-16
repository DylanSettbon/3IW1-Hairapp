<?php
class AppointmentController{
    public function getAppointment($data){
        $v = new Views( "appointment", "header" );
        $category = new Category(3);
        $categories = $category->getAllBy(['id_CategoryType' => $category->getIdCategoryType(), 'status_category' => '1'],null,3);
        $categories = $category->getCategoriesWithPackage($categories);

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $hairdresser = new Hairdresser();
        $hairdressers = $hairdresser->getAllBy(['status' => '2'],null,3);

        $v->assign("current", 'appointment');
        $v->assign("categories", $categories);
        $v->assign('packages',$packages);
        $v->assign('hairdressers',$hairdressers);
        isset($data)?$v->assign('data',$data):'';
    }

    public function saveAppointment(){
        if (Security::isConnected()){
        $errors = ['errors' => Validator::checkAvailableAppointment()];

        if (!empty($errors['errors'])){
            return $this->getAppointment($errors);
        }
        else {
            $package = new Package();
            $duration = $package->getAllBy(['id' => $_POST['package']],['duration'],3)[0]->getDuration();
            $package->setDuration($duration);
            $month = $_POST['mois'] < 10 ? '0' . $_POST['mois'] : $_POST['mois'];
            $day = $_POST['jour'] < 10 ? '0' . $_POST['jour'] : $_POST['jour'];
            $date = $_POST['annee'] . $month . $day;
            //s'occuper de la gestion de coiffeur = all
            if($_POST['hairdresser'] == 'all'){

                $hairdresser = new Hairdresser();
                $hairdresser =$hairdresser->getHairdresserAvailableForSelectedHour($_POST['cbHeure'],$date,$duration);
            }
            else{
                $hairdresser = $_POST['hairdresser'];
            }

            $appointment = new Appointment();
            $appointment->setDateAppointment($date);
            $appointment->setHourAppointment($_POST['cbHeure']);
            $appointment->setIdPackage($_POST['package']);
            $appointment->setIdUser($_SESSION['id']);
            $appointment->setIdHairdresser($hairdresser);

            $appointment->updateTable([
                "dateAppointment" => $appointment->getDateAppointment(),
                "hourAppointment" => $appointment->getHourAppointment(),
                "id_user" => $appointment->getIdUser(),
                "id_Hairdresser" => $appointment->getIdHairdresser(),
                "id_Package" => $appointment->getIdPackage()
            ]);

            $success = ['success' => 'Votre rendez-vous a bien été pris'];

            $object = 'Confirmation de votre rendez-vous le '.$appointment->getFormatedDateAppointment();
            $appointment->sendAddAppointmentMail([$_SESSION['email']]);
            return $this->getAppointment($success);
            }
        }
        else{
            header("Location: /login/getLogin");
        }
    }

    public function ajaxGetAvailableSchedule(){
        /*
         * Ajouter les exception:
         *      - appointments vide =aucun rendez vous ce jour, retourner toute les horaires possibles pour la durée du forfait
         *      - timeRangeAvailable vide = aucune disponibilité, retourner message d'erreuer
        */
        $hairdresser = new Hairdresser();
        $date = new DateTime();
        $date->setDate($_POST['year'], $_POST['month'], $_POST['day']);
        $idHairDresser = $_POST['hairdresser'] == 'all'? null: $_POST['hairdresser'];
        $package = new Package();
        $duration = $package->getAllBy(['id' => $_POST['package']],['duration'],3)[0]->getDuration();
        $appointment= new Appointment();
        if(is_null($idHairDresser)){

            $appointments = $appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d'),'planned'=> 1],null,3);
            $associativeHairdresserAndAppointment = $appointment->getAssociativeHaidresserAppointmentPackage($appointments);

            //Verifie si il y a un coiffeur n'ayant aucun rendez-vous
            $hairdressersId = $hairdresser->getAllBy(['status' => '2'],['id'],3);
            $availableHairdresser = $hairdresser->checkIfTheyAreFreeHairdresser($appointments,$hairdressersId);
            if($availableHairdresser){
                echo(json_encode($appointment->getAllAvailableTimeRange()));
                return true;
            }

            $timesRange = [];
            foreach ($associativeHairdresserAndAppointment as $haidresser=>$appointments){
                $timesRange = array_merge($timesRange,$hairdresser->getTimeRangeAvailable($appointments,$duration));
            }
            sort($timesRange);
            echo(json_encode(array_values(array_unique($timesRange))));
            return true;
        }
        else{
            $appointments = $appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d'),'id_Hairdresser'=>$idHairDresser,'planned'=> 1],null,3);
            if(empty($appointments)){
                echo(json_encode($appointment->getAllAvailableTimeRange()));
                return true;
            }

            $timesRange = $hairdresser->getTimeRangeAvailable($appointments,$duration);
            if (empty($timesRange)){
                echo(json_encode(['errors' => 'Aucune horaires disponibles']));
                return true;
            }
            echo(json_encode($timesRange));
        }

    }
}
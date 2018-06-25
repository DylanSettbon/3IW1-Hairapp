<?php
class AppointmentController{

    public function getAppointment(){
        $v = new Views( "appointment", "header" );

        $category = new Category();
        $categories = $category->getAllBy(['id_CategoryType' => '3', 'status' => '1'],null,3);
        $categories = $category->getCategoriesWithPackage($categories);

        $package =  new Package();
        $packages = $package->getAssociativeArrayPackage();

        $hairdresser = new Hairdresser();

        $hairdressers = $hairdresser->getAllBy(['status' => '2'],null,3);

        $v->assign("current", 'appointment');
        $v->assign("categories", $categories);
        $v->assign('packages',$packages);
        $v->assign('hairdressers',$hairdressers);
    }

    public function takeAppointment(){
        var_dump($_POST);
    }

    public function ajaxGetAvailableSchedule(){
        /*
         * Ajouter les exception:
         *      - appointments vide =aucun rendez vous ce jour, retourner toute les horaires possibles pour la durée du forfait
         *      - timeRangeAvailable vide = aucune disponibilité, retourner message d'erreuer
        */
        $hairDresser = new Hairdresser();
        $date = new DateTime();
        $date->setDate($_POST['year'], $_POST['month'], $_POST['day']);
        $idHairDresser = $_POST['hairdresser'] == 'all'? null: $_POST['hairdresser'];
        //
        $appointment= new Appointment();
        $appointments = is_null($idHairDresser)?$appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d')],null,3):$appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d'),'id_Hairdresser'=>$idHairDresser],null,3);
        if(empty($appointments)){
            // TO DO : recuperer toutes les durée disponible pour la durée du forfait
            echo(json_encode(['errors' =>'Toutes les heures sont disponibles']));
            return true;
        }
        //Ajouter coiffeur
        $package = new Package();
        $duration = $package->getAllBy(['id' => $_POST['package']],['duration'],3)[0]->getDuration();

        $timesRange = $hairDresser->getTimeRangeAvailable($appointments,$duration);
        if (empty($timesRange)){
            echo(json_encode(['errors' => 'Aucune horaires disponibles']));
            return true;
        }
        echo(json_encode($timesRange));
    }
}
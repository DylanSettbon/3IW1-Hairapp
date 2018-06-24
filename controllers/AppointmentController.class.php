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

    public function test(){
        //Passer ID User
        echo '---------------';
        echo '<pre>'; print_r($_POST); echo '</pre>';
        echo '---------------<br><br>';
        $hairDresser = new Hairdresser();
        $date = new DateTime();
        $date->setDate($_POST['annee'], $_POST['mois'], $_POST['jour']);
        $idHairDresser = $_POST['hairdresser'] == 'all'? null: $_POST['hairdresser'];
        //
        $appointment= new Appointment();
        $appointments = is_null($idHairDresser)?$appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d')],['hourAppointment'],3):$appointment->getAllBy(['dateAppointment' => $date->format('Y-m-d'),'id_Hairdresser'=>$idHairDresser],['hourAppointment'],3);
        //Ajouter coiffeur
        $package = new Package();
        $duration = $package->getAllBy(['id' => $_POST['package']],['duration'],3)[0]->getDuration();

        $hairDresser->getTimeRangeAvailable($appointments,$duration);
    }
}
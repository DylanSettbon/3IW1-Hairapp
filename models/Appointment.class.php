<?php
class Appointment extends BaseSql{
    private $idAppointment = null;
    private $dateAppointment;
    private $hourAppointment;
    private $id_Package;
    private $id_User;
    private $id_Hairdresser;
    private $planned;

    /**
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->idAppointment;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->idAppointment = $id;
    }

    /**
     * @return mixed
     */
    public function getDateAppointment()
    {
        return $this->dateAppointment;
    }

    /**
     * @param mixed $dateAppointment
     */
    public function setDateAppointment($dateAppointment)
    {
        $this->dateAppointment = $dateAppointment;
    }

    /**
     * @return mixed
     */
    public function getHourAppointment()
    {
        return $this->hourAppointment;
    }

    /**
     * @param mixed $hourAppointment
     */
    public function setHourAppointment($hourAppointment)
    {
        $this->hourAppointment = $hourAppointment;
    }

    /**
     * @return mixed
     */
    public function getIdPackage()
    {
        return $this->id_Package;
    }

    /**
     * @param mixed $id_Package
     */
    public function setIdPackage($id_Package)
    {
        $this->id_Package = $id_Package;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_User;
    }

    /**
     * @param mixed $id_User
     */
    public function setIdUser($id_User)
    {
        $this->id_User = $id_User;
    }

    /**
     * @return mixed
     */
    public function getIdHairdresser()
    {
        return $this->id_Hairdresser;
    }

    /**
     * @param mixed $id_Hairdresser
     */
    public function setIdHairdresser($id_Hairdresser)
    {
        $this->id_Hairdresser = $id_Hairdresser;
    }

    public function getPlanned()
    {
        return $this->planned;
    }

    /**
     * @param mixed $id_Hairdresser
     */
    public function setPlanned($planned)
    {
        $this->planned = $planned;
    }

    public function getFormatedDateAppointment(){
        $date=date_create($this->dateAppointment);
        return date_format($date,"d/m/Y");
    }

    public function sortOnDate($appointments){
        usort($appointments, function($a, $b) {
            return ($a->getDateAppointment() < $b->getDateAppointment()) ? -1 : 1;
        });

        return $appointments;
    }

    public function getAvailableTimeBetweenAppointment($hours){
        /*
         * Entrée : tableau des heures de chaques rendez avec date de début et date de fin
         * Ajoute en début de tableau un tableau avec l'heure d'ouverture et en fin un tableau avec heure de fermeture
         * Retourne un tableau avec comme clé l'heure de fin de rendez-vous et en valeur le temps restant jusqu'au prochain début de rendez-vous
         */
        //TO DO : ouverture salon
        $opening = '08:00:00';
        $closing = '18:30:00';
        $timeRange = [];

        sort($hours);
        array_unshift($hours,['start' => $opening,'end' => $opening]);
        $hours[] = ['start' => $closing,'end' => $closing];

        for($i = 0; $i<count($hours)-1;$i++){
            $h2 = new DateTime($hours[$i+1]['start']);
            $h1 = new DateTime($hours[$i]['end']);
            $timeRange[$hours[$i]['end']] = (($h2->getTimestamp() -$h1->getTimestamp())/60) + (($h2->getTimestamp() -$h1->getTimestamp())%60) ;
        }
        return $timeRange;
    }

    public function getAllAvailableTimeRange(){
        /*
         * Refaire la selection pour Tous les coiffeur
         * Tableau d'id avec chaque heure disponible pour chaque coiffeur
         */
        //TO DO : ouverture salon
        $opening = '08:00';
        $closing = '18:30';
        $timeRange = [];
        array_unshift($timeRange,$opening);
        $i = -1;
        $add = 0;
        $timeOut = 10;
        do {
            $add += $timeOut;
            //Remplacer par un temps moyen de rendez-vous
            $timeRange[] = date("H:i", strtotime('+' . $add . ' minutes', strtotime($opening)));
            $i += 1;
        }while(strtotime('+'.$timeOut. 'minutes',strtotime($timeRange[$i])) <  strtotime('-' . $timeOut . ' minutes', strtotime($closing)));

        return $timeRange;

    }

    public function getAssociativeHaidresserAppointmentPackage($appointments){
        $associativeHairdresserAndAppointment = [];
        foreach($appointments as $appointment){
            if(array_key_exists($appointment->getIdHairdresser(),$associativeHairdresserAndAppointment)){
                array_push($associativeHairdresserAndAppointment[$appointment->getIdHairdresser()],$appointment);
            }
            else{
                $associativeHairdresserAndAppointment[$appointment->getIdHairdresser()] = [$appointment];
            }
        }
        return $associativeHairdresserAndAppointment;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    /**
     * @param mixed $firstnam
     */
    public function setFirstname($firstname)
    {
        $this->firstnam = $firstname;
    }
    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public static function changeMonth($date){
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

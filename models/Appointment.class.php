<?php
class Appointment extends BaseSql{
    protected $id = null;
    protected $dateAppointment;
    protected $hourAppointment;
    protected $id_Package;
    protected $id_User;
    protected $id_Hairdresser;

    /**
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
}
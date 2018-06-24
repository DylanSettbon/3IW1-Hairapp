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
        //TO DO : ouverture salon
        $opening = '08:00:00';
        $closing = '18:30:00';
        $timeRange = [];
    //
        sort($hours);
        array_unshift($hours,$opening);
        $hours[] = $closing;
        for($i = 0; $i<count($hours)-1;$i++){
            $h2 = new DateTime($hours[$i+1]);
            $h1 = new DateTime($hours[$i]);
            $timeRange[$hours[$i]] = (($h2->getTimestamp() -$h1->getTimestamp())/60) + (($h2->getTimestamp() -$h1->getTimestamp())%60) ;
        }
        return $timeRange;
        //renvoie les durée disponible entre chaque rendez-vous sous forme de tableau associatif
        //clé : heure de debut ; valeur : temps disponible
    }
}
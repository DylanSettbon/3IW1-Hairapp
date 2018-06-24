<?php
class Appointment extends BaseSql{
    protected $id = null;
    protected $hairdresser;
    protected $date;
    protected $hourAppointment;
    protected $package;
    protected $customer;


    //getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getHairdresser()
    {
        return $this->hairdresser;
    }

    public function setHairdresser($hairdresser)
    {
        $this->hairdresser = $hairdresser;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function gethourAppointment()
    {
        return $this->hourAppointment;
    }

    public function sethourAppointment($hourAppointment)
    {
        $this->hourAppointment = $hourAppointment;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getAvailableTimeBetweenAppointment($hours){
        //TO DO : ouverture salon
        $opening = '08:00:00';
        $closing = '18:30:00';
        $timeRange = [];

        sort($hours);
        array_unshift($hours,$opening);
        $hours[] = $closing;
        for($i = 0; $i<count($hours)-1;$i++){
            $h2 = new DateTime($hours[$i+1]);
            $h1 = new DateTime($hours[$i]);
            $timeRange[$hours[$i]] = (($h2->getTimestamp() -$h1->getTimestamp())/60) + (($h2->getTimestamp() -$h1->getTimestamp())%60) ;
        }
        echo '<br>';


        return $timeRange;
        //renvoie les durée disponible entre chaque rendez-vous sous forme de tableau associatif
        //clé : heure de debut ; valeur : temps disponible
    }
}